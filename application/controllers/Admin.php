<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    private function _get_commond_data(&$data)
    {
        $data['app_name']        = $this->db->get_where('system_config', ['sys_id' => 'app_name'])->row_array()['sys_value'];
        $data['app_icon']        = $this->db->get_where('system_config', ['sys_id' => 'app_icon'])->row_array()['sys_value'];
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get_where('user_role', ['id' => $this->session->userdata('role_id')])->row_array();
    }


    public function index()
    {
        $this->_get_commond_data($data);
        $data['title'] = 'Dashboard DidikAm';
        $data['page'] = 'admin/dashboard';
        $this->load->view('admin/templates', $data);
    }
}
