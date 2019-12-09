<!-- Adminisitrator Controller -->

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

  public function __construct()
  {
    // untuk mencegah akses tanpa login atau session
    parent::__construct();
    is_logged_in();
  }

  public function index()
  {

    $data['title'] = 'Dashboard';
    //ambil data dari session
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['alluser'] = $this->db->get('user')->result_array();
    $data['items'] = $this->db->get('items')->result_array();
    //redirect to homepage, set the controller view to..
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('admin/index', $data);
    // footer.php doesn't need $data to passed
    $this->load->view('templates/footer');
  }

  public function role()
  {

    $data['title'] = 'Role';
    //ambil data dari session
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    // Query table user role, to get all the data 
    $data['role'] = $this->db->get('user_role')->result_array();
    //redirect to homepage, set the controller view to..
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('admin/role', $data);
    // footer.php doesn't need $data to passed
    $this->load->view('templates/footer');
  }

  public function roleaccess($role_id)
  {

    $data['title'] = 'Role Access';
    //ambil data dari session
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    // untuk akalin admin ga muncul roleacess page
    $this->db->where('id!=', 1);
    // Query semua menu
    $data['menu'] = $this->db->get('user_menu')->result_array();
    // Query table user role, to get all the data 
    $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

    //redirect to homepage, set the controller view to..
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('admin/role-access', $data);
    // footer.php doesn't need $data to passed
    $this->load->view('templates/footer');
  }

  public function changeAccess()
  {
    // ini dapat dr Jquery di templates/footer
    $menu_id = $this->input->post('menuId');
    $role_id = $this->input->post('roleId');

    // to check later in table user_access_menu
    $data = [
      'role_id' => $role_id,
      'menu_id' => $menu_id
    ];

    $result = $this->db->get_where('user_access_menu', $data);

    // jika ga ada di table
    if ($result->num_rows() < 1) {
      $this->db->insert('user_access_menu', $data);
    } else {
      $this->db->delete('user_access_menu', $data);
    }

    //add success message
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    Access Changed!</div>');
  }

  // ITEM PAGES ADMIN
  public function allitems()
  {
    $data['title'] = 'All Items';

    //ambil data dari session
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $data['items'] = $this->db->get('items')->result_array();

    if ($this->form_validation->run() == false) {
      //redirect to homepage, set the controller view to..
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('admin/allitems', $data);
      // footer.php doesn't need $data to passed
      $this->load->view('templates/footer');
    }
  }
}
