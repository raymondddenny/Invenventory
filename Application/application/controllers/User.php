<!-- Member Controller -->
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

  public function __construct()
  {
    // untuk mencegah akses tanpa login atau session
    parent::__construct();
    is_logged_in();
    // load model
    $this->load->model('Menu_model', 'model');
  }


  // MY PROFILE PAGE
  public function index()
  {

    $data['title'] = 'My Profile';
    //ambil data dari session
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    // // echo 'selamat datang ' . $data['user']['name'];
    //redirect to homepage, set the controller view to..
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('user/index', $data);
    // footer.php doesn't need $data to passed
    $this->load->view('templates/footer');
  }

  // HELP PAGE
  public function help()
  {
    $data['title'] = 'Help Page';

    //ambil data dari session
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    // // echo 'selamat datang ' . $data['user']['name'];
    //redirect to homepage, set the controller view to..
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('user/help', $data);
    // footer.php doesn't need $data to passed
    $this->load->view('templates/footer');
  }

  // METHOD SEARCH ITEMS
  public function searchitems()
  {
    $data['title'] = 'Items';
    $keyword = $this->input->post('keyword');
    //ambil data dari session
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    // QUERY ITEMS using user ID
    $query = 'SELECT `user`.`id`,`user`.`email`,`items`.*
                FROM `user` JOIN `items` 
                ON `user`.`id` = `items`.`user_id`
                WHERE `items`.`user_email` = "' . $this->session->userdata('email') . '"';

    $data['results'] = $this->db->query($query)->result_array();
    $data['results'] = $this->model->search_item($keyword);

    //redirect to homepage, set the controller view to..
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('user/items_view', $data);
    // footer.php doesn't need $data to passed
    $this->load->view('templates/footer');
  }

  // ITEM PAGES
  public function items()
  {
    $data['title'] = 'Items';

    //ambil data dari session
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $data['items'] = $this->db->get('items')->result_array();

    // QUERY ITEMS using user ID
    $query = 'SELECT `user`.`id`,`user`.`email`,`items`.*
                FROM `user` JOIN `items` 
                ON `user`.`id` = `items`.`user_id`
                WHERE `items`.`user_email` = "' . $this->session->userdata('email') . '"';

    $data['test'] = $this->db->query($query)->result_array();
    // var_dump($test);
    // die;

    // check items form
    $this->form_validation->set_rules('item_name', 'Item_name', 'required');
    $this->form_validation->set_rules('type', 'type', 'required');
    $this->form_validation->set_rules('category', 'Category', 'required');
    $this->form_validation->set_rules('location', 'Location', 'required');
    $this->form_validation->set_rules('vendor', 'Vendor', 'required');
    $this->form_validation->set_rules('quantity', 'Quantity', 'required');

    if ($this->form_validation->run() == false) {
      //redirect to homepage, set the controller view to..
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('user/items', $data);
      // footer.php doesn't need $data to passed
      $this->load->view('templates/footer');
    } else {
      $data = [
        'item_name' => htmlspecialchars($this->input->post('item_name', true)),
        'type' => htmlspecialchars($this->input->post('type', true)),
        'category' => htmlspecialchars($this->input->post('category', true)),
        'location' => htmlspecialchars($this->input->post('location', true)),
        'vendor' => htmlspecialchars($this->input->post('vendor', true)),
        'quantity' => htmlspecialchars($this->input->post('quantity', true)),
        'last_modified' => time(),
        'user_id' => htmlspecialchars($this->input->post('user_id', true)),
        'user_email' => htmlspecialchars($this->input->post('user_email', true)),
      ];

      // masukin kedatabase
      $this->db->insert('items', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Item Added Successfully!</div>');
      redirect('user/items');
    }
  }



  public function edit()
  {
    $data['title'] = 'Edit Profile';
    //ambil data dari session
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('user/edit', $data);
      // footer.php doesn't need $data to passed
      $this->load->view('templates/footer');
    } else {
      $name = $this->input->post('name');
      $email = $this->input->post('email');

      // cek jika ada gambar yg mau diupload
      $uploadImage = $_FILES['image']['name'];

      if ($uploadImage) {
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']     = '2048';
        $config['upload_path'] = './assets/img/profile/';

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {

          // biar dapat gambar yg sedang dipakai
          $old_image = $data['user']['image'];
          // untuk cek selain gambar default itu dihapus
          if ($old_image != 'default.jpg') {
            // FCPATH -> untuk mengetahui path ke filenamenya
            unlink(FCPATH . 'assets/img/profile/' . $old_image);
          }
          // isi nama file baru
          $new_image = $this->upload->data('file_name');
          // set to database contain in column image with new_image
          $this->db->set('image', $new_image);
        } else {
          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
          redirect('user');
        }
      }

      $this->db->set('name', $name);
      $this->db->where('email', $email);
      $this->db->update('user');

      //add success message
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
      Your profile has been updated!</div>');
      redirect('user');
    }
  }

  public function edititems($id)
  {
    $data['title'] = 'Items';

    //ambil data dari session
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    // get data from Menu_model
    $data['items'] = $this->model->getItemsById($id);


    // check items form
    $this->form_validation->set_rules('item_name', 'Item_name', 'required');
    $this->form_validation->set_rules('type', 'type', 'required');
    $this->form_validation->set_rules('category', 'Category', 'required');
    $this->form_validation->set_rules('location', 'Location', 'required');
    $this->form_validation->set_rules('vendor', 'Vendor', 'required');
    $this->form_validation->set_rules('quantity', 'Quantity', 'required');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('user/updateitems', $data);
      // footer.php doesn't need $data to passed
      $this->load->view('templates/footer');
    } else {
      $this->model->updateitems();
      // redirect after insert 
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Items Updated!</div>');
      redirect('user/items');
    }
  }

  // DELETE ITEMS METHOD 
  public function deleteitems($id)
  {
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $this->model->deleteitems($id);

    // to check if user are admin or normal user
    if ($data['user']['role_id'] == 1) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Items Deleted!</div>');
      redirect('admin/allitems');
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Items Deleted!</div>');
      redirect('user/items');
    }
  }

  public function updateitems($id)
  {
    $data['title'] = 'Items';

    //ambil data dari session
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    // get data from Menu_model
    $data['items'] = $this->model->getItemsById($id);


    // check items form
    $this->form_validation->set_rules('item_name', 'Item_name', 'required');
    $this->form_validation->set_rules('type', 'type', 'required');
    $this->form_validation->set_rules('category', 'Category', 'required');
    $this->form_validation->set_rules('location', 'Location', 'required');
    $this->form_validation->set_rules('vendor', 'Vendor', 'required');
    $this->form_validation->set_rules('quantity', 'Quantity', 'required');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('user/updateitems', $data);
      // footer.php doesn't need $data to passed
      $this->load->view('templates/footer');
    } else {
      $this->model->updateitems();
      // redirect after insert 
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Items Updated!</div>');
      redirect('user/items');
    }
  }


  // CHANGE PASSWORD METHOD
  public function changepassword()
  {

    $data['title'] = 'Change Password';
    //ambil data dari session
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    // RULES
    // check change password form
    $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
    $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[6]|matches[new_password2]');
    $this->form_validation->set_rules('new_password2', 'Repeat Password', 'required|trim|min_length[6]|matches[new_password1]');


    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('user/changepassword', $data);
      // footer.php doesn't need $data to passed
      $this->load->view('templates/footer');
    } else {
      // save the input from current password and new password
      $current_password = $this->input->post('current_password');
      $new_password = $this->input->post('new_password1');

      // verify the current password with the one in database
      if (!password_verify($current_password, $data['user']['password'])) {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong Current Password!</div>');
        redirect('user/changepassword');
      } else {
        if ($current_password == $new_password) {
          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New Password cannot be the same as current password!</div>');
          redirect('user/changepassword');
        }
        // new password ok
        else {

          // we first hash the new password using php password hash
          $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

          // input new password to database

          $this->db->set('password', $password_hash);
          $this->db->where('email', $data['user']['email']);
          $this->db->update('user');

          // IF SUCCESS, SHOW THIS
          $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password Changed!</div>');
          redirect('user/changepassword');
        }
      }
    }
  }
}
