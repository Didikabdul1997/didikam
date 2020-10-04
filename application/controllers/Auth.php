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
        $this->_get_commond_data($data);
        $data['title'] = "User Login";
        $data['pages'] = "depan/auth/login";
        $this->load->view('depan/templates', $data);
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
                'email_error' => form_error('email'),
                'password_error' => form_error('password'),
                'message_error' => form_error('message')
            );
            echo json_encode(array('status' => 3, 'pesan' => $array));
        }
    }

    public function forgotPassword()
    {
        $this->_get_commond_data($data);
        $data['title'] = "Forgot Password";
        $data['pages'] = "depan/auth/forgot-password";
        $this->load->view('depan/templates', $data);
    }

    public function processForgotPassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run()) {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', [
                'email' => $email,
                'is_active' => 1
            ])->row_array();
            if ($user) {
                $token = md5(rand());
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];
                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot');
                echo json_encode(array('status' => 1, 'pesan' => 'Cek email untuk ubah password!'));
            } else {
                echo json_encode(array('status' => 0, 'pesan' => 'Email belum terdaftar / di aktivasi!'));
            }
        } else {
            $array = array(
                'error'   => true,
                'email_error' => form_error('email'),
                'message_error' => form_error('message')
            );
            echo json_encode(array('status' => 3, 'pesan' => $array));
        }
    }

    public function registration()
    {
        $this->_get_commond_data($data);
        $data['title'] = "User Registration";
        $data['pages'] = "depan/auth/registration";
        $this->load->view('depan/templates', $data);
    }

    public function registerAccount()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');


        if ($this->form_validation->run()) {
            $email = $this->input->post('email', true);
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 0,
                'date_created' => time()
            ];

            // siapkan token
            $token = md5(rand());
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            $this->db->insert('user', $data);
            $this->db->insert('user_token', $user_token);
            $this->_sendEmail($token, 'verify');
            echo json_encode(array('status' => 1, 'pesan' => "Selamat! Akun anda sudah terbuat. Silahkan cek email untuk aktivasi"));
        } else {
            $array = array(
                'error'   => true,
                'name_error' => form_error('name'),
                'email_error' => form_error('email'),
                'password1_error' => form_error('password1'),
                'password2_error' => form_error('password2'),
                'message_error' => form_error('message')
            );
            echo json_encode(array('status' => 3, 'pesan' => $array));
        }
    }

    public function registration2()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'WPU User Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 0,
                'date_created' => time()
            ];

            // siapkan token
            $token = md5(rand());
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            $this->db->insert('user', $data);
            $this->db->insert('user_token', $user_token);

            $this->_sendEmail($token, 'verify');

            $this->session->set_flashdata('flash-success-ok', 'Congratulation! your account has been created. Please activate your account in email');
            redirect('auth');
        }
    }

    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'dirodev91@gmail.com',
            'smtp_pass' => 'didikam97',
            'smtp_port' => 465,
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"
        ];

        $this->email->initialize($config);

        $this->email->from('dirodev91@gmail.com', 'Sistem Pakar');
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {
            $this->email->subject('Account Verification');
            $this->email->message('Click this link to verify you account : <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . $token . '">Activate</a>');
        } else if ($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message('Click this link to reset your password : <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . $token . '">Reset Password</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $email . ' has been activated! Please login.</div>');
                    redirect('auth');
                } else {
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Token expired.</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Wrong token.</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Wrong email.</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Anda Sudah Logout
            </div>');
        redirect('auth');
    }

    public function blocked()
    {
        $this->load->view('errors/403');
    }

    public function resetPassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user_token', ['email' => $email])->row_array();
        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->changePassword();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                        Reset password failed! Wrong token.
                        </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Reset password failed! Wrong email.
                    </div>');
            redirect('auth');
        }
    }

    public function changePassword()
    {
        $this->_get_commond_data($data);
        $data['title'] = "Change Password";
        $data['pages'] = "depan/auth/change-password";
        $this->load->view('depan/templates', $data);
    }

    public function processChangePassword()
    {
        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[3]|matches[password1]');
        if ($this->form_validation->run()) {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');
            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');
            $this->session->unset_userdata('reset_email');
            echo json_encode(array('status' => 1, 'pesan' => 'Password has been changed! Please login'));
        } else {
            $array = array(
                'error'   => true,
                'password1_error' => form_error('password1'),
                'password2_error' => form_error('password2'),
                'message_error' => form_error('message')
            );
            echo json_encode(array('status' => 3, 'pesan' => $array));
        }
    }
}
