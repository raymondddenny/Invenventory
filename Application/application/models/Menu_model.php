<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{

    // public function getAllMenu()
    // {
    //     return $this->db->get('user_menu')->result_array();
    // }

    public function getMenuById($id)
    {
        // $this->db->where('id', $id);
        return $this->db->get_where('user_menu', ['id' => $id])->row_array();
    }

    public function getSubMenu()
    {
        // Join dari table submenu ke table menu
        $query = " SELECT `user_sub_menu`.*, `user_menu`.`menu` 
                    FROM `user_sub_menu` JOIN `user_menu`
                    ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
        ";

        return $this->db->query($query)->result_array();
    }

    // get item from specific user
    public function getuseritems()
    {
        $user_name = $this->session->userdata('name');
        $query = "SELECT `user`.`id`
                FROM `user` JOIN `items` 
                ON `user`.`id` = `items`.`user_id`
                WHERE `items`.`user_name` = $user_name
                ORDER BY `items`.`user_id` ASC
        ";

        return $this->db->query($query)->result_array();
    }

    // untuk delete menu
    public function menuDelete($id)
    {
        $this->db->where('id', $id);
        // which table ?
        $this->db->delete('user_menu');
    }

    // untuk delete submenu
    public function subMenuDelete($id)
    {
        $this->db->where('id', $id);
        // which table ?
        $this->db->delete('user_sub_menu');
    }

    // untuk delete items
    public function deleteitems($id)
    {
        $this->db->where('id', $id);
        // which table ?
        $this->db->delete('items');
    }

    public function getItemsById($id)
    {
        return $this->db->get_where('items', ['id' => $id])->row_array();
    }

    // METHOD UPDATE ITEMS
    public function updateitems()
    {
        $id = $this->input->post('id', true);
        $item_name = $this->input->post('item_name');
        $type = $this->input->post('type');
        $category = $this->input->post('category');
        $location = $this->input->post('location');
        $vendor = $this->input->post('vendor');
        $quantity = $this->input->post('quantity');

        $this->db->set('item_name', $item_name);
        $this->db->set('type', $type);
        $this->db->set('category', $category);
        $this->db->set('location', $location);
        $this->db->set('vendor', $vendor);
        $this->db->set('quantity', $quantity);
        $this->db->where('id', $id);
        $this->db->update('items');
    }

    public function getSubMenuById($id)
    {
        return $this->db->get_where('user_sub_menu', ['id' => $id])->row_array();
    }

    public function updatesubmenu()
    {
        $id = $this->input->post('id', true);
        $title_submenu = $this->input->post('title_submenu');
        $menu_id = $this->input->post('menu_id');
        $url = $this->input->post('url');
        $icon = $this->input->post('icon');

        $this->db->set('title_submenu', $title_submenu);
        $this->db->set('menu_id', $menu_id);
        $this->db->set('url', $url);
        $this->db->set('icon', $icon);
        $this->db->where('id', $id);
        $this->db->update('user_sub_menu');
    }

    public function search_item($keyword)
    {
        $this->db->like('item_name', $keyword);
        // $this->db->or_like('type', $keyword);
        // $this->db->or_like('Category', $keyword);
        // $this->db->or_like('Location', $keyword);
        // $this->db->or_like('Vendor', $keyword);
        $query = $this->db->get('items');
        return $query->result_array();
    }
}
