<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    //method login
    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        //validasi
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        }
        //if validasi true
        else {
            //validasi success
            $this->_login(); //buat function login private
        }
    }

    private function _login()
    {
        //data input
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        //to check data input in database
        $user = $this->db->get_where('user', ['email' => $email])->row_array(); // row_array() -> return single result row

        //check in database
        //true, ada user
        if ($user) {
            //ji ka user email activated
            if ($user['is_active'] == 1) {
                //check password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin'); // redirect to admin page
                    } else {
                        redirect('user'); // redirect to user page
                    }
                } else {
                    //add error message
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong Password!</div>');
                    redirect('auth'); // redirect to login page
                }
            }
            //jika user email not activated
            else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This email has not been activated!</div>');
                redirect('auth'); // redirect to login page
            }
        } else {
            //tidak ada user
            //add error message
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Email is not registered!</div>');
            redirect('auth'); // redirect to login page
        }
    }

    //method registration
    public function registration()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        //form validation to check the input in register page
        $this->form_validation->set_rules('fullname', 'FullName', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            //to give info about the rules
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            //to give info about the rules
            'matches' => 'Password dont matches!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        //to check if the data input true
        if ($this->form_validation->run() == false) {

            $data['title'] = "Inven-ven User Registration";
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        }
        // if data input true, then... 
        else {
            //buat list database
            $data = [
                //true -> untuk menghindari cross site scripting
                //htmlspecialchars -> untuk untuk sanitasi input                
                'name' => htmlspecialchars($this->input->post('fullname', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2, //role2 = member
                'is_active' => 0, // 1 = sudah aktifasi
                'date_created' => time()
            ];

            // TOKEN
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $this->input->post('email', true),
                'token' => $token,
                'date_created' => time()
            ];


            //masukin data to database
            $this->db->insert('user', $data);
            $this->db->insert('user_token', $user_token);

            // FITUR KIRIM EMAIL
            // email akan mengirim token, yg hanya diketaui oleh system, data token dicocokan k database, klw ada user jadi active
            $this->_sendEmail($token, 'verify');

            //add success message
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Congratulations! your account has been created. Please activated your account</div>');
            redirect('auth'); // redirect to login page
        }
    }


    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol'  => 'ssmtp', // smtp => simple mail transfer protocol
            'smtp_host' => 'ssl://ssmtp.googlemail.com',
            'smtp_user' => 'invenvenHCI2019@gmail.com',
            'smtp_pass' => 'invenvenHCI9102',
            'smtp_port' => 465, //465 => port smtp google
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"

        ];

        // load library email with config
        $this->load->library('email', $config);
        $this->email->initialize($config);

        $this->email->from('invenvenHCI2019@gmail.com', 'Invenven Inventory Website');
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {
            $this->email->subject('Account Verification');
            $this->email->message('Click this link to verify your account : <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate </a>');
        } elseif ($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message('Click this link to reset your password : <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password </a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    // METHOD VERIFY EMAIL 
    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                // waktu validasi check
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    // activate the user
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    // then we delete the token from user_token, cause don't need anymore
                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $email . ' has been activated! Please Login.
            </div>');
                    redirect('auth'); // redirect to login page
                } else {
                    // link expired
                    // hapus data user yg belum verifikasi
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Account activation failed! Link Expired.</div>');
                    redirect('auth'); // redirect to login page
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Account activation failed! Wrong Token.</div>');
                redirect('auth'); // redirect to login page
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Account activation failed! Wrong Email.</div>');
            redirect('auth'); // redirect to login page
        }
    }

    //method logout, untuk membersihkan session
    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            You have been logged out!</div>');
        redirect('homepage'); // redirect to login page
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }

    // METHOD FORGET PASSWORD
    public function forgotpassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Forgot Password Page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/forgot-password');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email'); #ambil email yang ad diform
            $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array(); # cek emailnya ada ga di database

            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('user_token', $user_token); #passwordnya ke insert di database
                $this->_sendEmail($token, 'forgot');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Please check your email! to reset your password!</div>');
                redirect('auth/forgotpassword'); // redirect to forgotpassword

            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Email is not registered or activated!</div>');
                redirect('auth/forgotpassword'); // redirect to forgotpassword
            }
        }
    }


    // METHOD RESET PASSWORD, TO CHECK LINK THAT BEEN SEND TO EMAIL VALID OR NOT
    public function resetpassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array(); #cek ada emailnya ga didatabase pas mau reset

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                $this->session->set_userdata('reset_email', $email); #buat session biar datanya yang tau cuman server, session ini hanya ada keyika kit mau reset email aja
                $this->changepassword();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Reset password failed! Wrong Token.</div>');
                redirect('auth/forgotpassword'); // redirect to forgotpassword
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Reset password failed! Wrong email.</div>');
            redirect('auth/forgotpassword'); // redirect to forgotpassword
        }
    }

    // METHOD CHANGE PASSWORD
    public function changepassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }

        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[6]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[6]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Change Password Page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/change-password');
            $this->load->view('templates/auth_footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password); #set passoword = password
            $this->db->where('email', $email); #where email = email
            $this->db->update('user'); #updaete pass di database user

            $this->session->unset_userdata('reset_email'); #hapus session resetemailnya
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Password has been changed! Please login.</div>');
            redirect('auth'); // redirect to login page
        }
    }
}
