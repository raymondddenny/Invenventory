<!-- Menu Access Controller -->

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model', 'menu');

        // $this->template->load('template', 'menu/user_menu', $data);
        // jika belum login
        is_logged_in();
    }
    
    //untuk mengelola menu
    public function index()
    {
        $data['title'] = 'Menu Management';

        //ambil data dari session
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


        // query data menu
        $data['menu'] = $this->db->get('user_menu')->result_array();


        $this->form_validation->set_rules('menu', 'Menu', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            // footer.php doesn't need $data to passed
            $this->load->view('templates/footer');
        }
        // add menu to database
        else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            //add success message
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Menu Add!</div>');
            redirect('menu');
        }
    }

    public function submenu()
    {
        $data['title'] = 'Submenu Management';

        //ambil data dari session
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // get data from Menu_model
        $data['submenu'] = $this->menu->getSubMenu();
        // $data['submenu'] = $this->menu->getSubMenuById($id);

        // get data from table user_menu
        $data['menu'] = $this->db->get('user_menu')->result_array();


        // check submenu form
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            // footer.php doesn't need $data to passed
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title_submenu' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            // insert to db
            $this->db->insert('user_sub_menu', $data);
            // redirect after insert 
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sub Menu Added successfully!</div>');
            redirect('menu/submenu');
        }
    }

    public function menuDel($id)
    {
        // add model
        $this->menu->menuDelete($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Menu deleted successfully!</div>');
        redirect('menu');
    }

    public function subMenuDel($id)
    {
        // add model
        $this->menu->subMenuDelete($id);
        //add success message
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Sub Menu Deleted</div>');
        redirect('menu/submenu');
    }

    public function updatesubmenu($id)
    {
        $data['title'] = 'Submenu Management';

        //ambil data dari session
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // get data from Menu_model
        // $data['subMenu'] = $this->menu->getSubMenu($id);
        $data['submenu'] = $this->menu->getSubMenuById($id);

        // get data from table user_menu
        $data['menu'] = $this->db->get('user_menu')->result_array();


        // check submenu form
        $this->form_validation->set_rules('title_submenu', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/updatesubmenu', $data);
            // footer.php doesn't need $data to passed
            $this->load->view('templates/footer');
        } else {
            $this->menu->updatesubmenu();
            // redirect after insert 
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sub Menu Updated!</div>');
            redirect('menu/submenu');
        }
    }
}
