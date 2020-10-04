<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_commond_data(&$data)
    {
        $data['app_name']        = $this->db->get_where('system_config', ['sys_id' => 'app_name'])->row_array()['sys_value'];
        $data['app_icon']        = $this->db->get_where('system_config', ['sys_id' => 'app_icon'])->row_array()['sys_value'];
    }

    public function index()
    {
        $this->load->view('depan/templates');
    }

    public function about()
    {
        $this->_get_commond_data($data);
        $data['title'] = "About";
        $data['pages'] = "depan/about";
        $this->load->view('depan/templates', $data);
    }
}
