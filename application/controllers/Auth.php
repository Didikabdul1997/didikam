<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_commond_data(&$data)
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $data['app_name']        = $this->db->get_where('system_config', ['sys_id' => 'app_name'])->row_array()['sys_value'];
        $data['app_icon']        = $this->db->get_where('system_config', ['sys_id' => 'app_icon'])->row_array()['sys_value'];
    }

    public function index()
    {
        // $this->_get_commond_data($data);
        $data['title'] = "User Login || Didikam";
        $this->load->view('depan/auth/login', $data);
    }

    public function signIn()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
            'required' => 'Email harus diisi!',
            'valid_email' => 'Email tidak valid!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', [
            'required' => 'Password harus diisi!'
        ]);

        if ($this->form_validation->run()) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $user = $this->db->get_where('user', ['email' => $email])->row_array();
            if ($user) {
                if ($user['is_active'] == 1) {
                    if (password_verify($password, $user['password'])) {
                        $data = [
                            'email' => $user['email'],
                            'role_id' => $user['role_id'],
                            'image' => $user['image']
                        ];
                        $data['token'] = $this->security->get_csrf_hash();
                        $this->session->set_userdata($data);
                        echo json_encode(array('status' => 1, 'pesan' => "Anda Sudah Login", 'role_id' => $user['role_id']));
                    } else {
                        echo json_encode(array('status' => 0, 'pesan' => "Password Salah"));
                    }
                } else {
                    echo json_encode(array('status' => 0, 'pesan' => "Email belum di aktivasi"));
                }
            } else {
                echo json_encode(array('status' => 0, 'pesan' => "Email belum terdaftar"));
            }
        } else {
            $array = array(
                'error'   => true,
                'message_error' => form_error('message')
            );
            if (form_error('email')) {
                $array['email_error'] = form_error('email');
            } else {
                $array['email_success'] = $this->input->post('email');
            }
            if (form_error('password')) {
                $array['password_error'] = form_error('password');
            } else {
                $array['password_success'] = $this->input->post('password');
            }
            echo json_encode(array('status' => 3, 'pesan' => $array));
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('msg_logout', '<div id="pesan" class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Warning ! </strong> Anda Sudah Logout !!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        redirect('auth');
    }

    public function blocked()
    {
        $this->load->view('errors/403');
    }
}
