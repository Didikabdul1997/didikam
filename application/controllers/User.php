<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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
        $data['act'] = "myProfile";
        $this->_get_commond_data($data);
        $data['title']  = "Profil Saya";
        $data['pages']   = "admin/user";
        $this->load->view('admin/templates', $data);
    }

    public function prosesEditProfile()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        if ($this->form_validation->run()) {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['upload_path'] = './assets/img/profile/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '2048';
                $config['encrypt_name'] = TRUE; //nama yang terupload nantinya

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != "default.jpg") {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    $error = array('error' => $this->upload->display_errors());
                }
            }

            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $update = $this->db->update('user');
            echo json_encode(array('status' => 1, 'pesan' => 'Your profile has beed updated!'));
        } else {
            $array = array(
                'error'   => true,
                'email_error' => form_error('email'),
                'name_error' => form_error('name'),
                'message_error' => form_error('message')
            );
            echo json_encode(array('status' => 3, 'pesan' => $array));
        }
    }

    public function changePassword()
    {
        $data['act'] = "changePassword";
        $this->_get_commond_data($data);
        $data['title']  = "Change Password";
        $data['pages']   = "admin/change-password";
        $this->load->view('admin/templates', $data);
    }

    public function processChangePassword()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run()) {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                echo json_encode(array('status' => 0, 'pesan' => 'Wrong current password!'));
            } else {
                if ($current_password == $new_password) {
                    echo json_encode(array('status' => 0, 'pesan' => 'New password cannot be the same as current password!'));
                } else {
                    // password sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');
                    echo json_encode(array('status' => 1, 'pesan' => 'Password changed!'));
                }
            }
        } else {
            $array = array(
                'error'   => true,
                'current_password_error' => form_error('current_password'),
                'new_password1_error' => form_error('new_password1'),
                'new_password2_error' => form_error('new_password2'),
                'message_error' => form_error('message')
            );
            echo json_encode(array('status' => 3, 'pesan' => $array));
        }
    }
}
