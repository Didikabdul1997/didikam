<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Postingan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    private function _get_commond_data(&$data)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    }

    public function index()
    {
        $this->_get_commond_data($data);
        $data['title'] = 'Postingan';
        $data['page'] = 'admin/postingan/data';
        $this->load->view('admin/templates', $data);
    }
}
