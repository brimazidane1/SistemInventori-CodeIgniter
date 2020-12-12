<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->model('Sadmin_model', '', TRUE);
        $this->load->model('Pegawai_model', '', TRUE);
        $this->load->model('Admin_model', '', TRUE);
    }
    public function index()
    {
        $data['title'] = 'Login Page';
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        $username = $this->session->userdata('username');

        $superadmin = $this->db->get_where('superadmin', ['username_sa' => $username])->row_array();
        $admin = $this->db->get_where('admin', ['username_admin' => $username])->row_array();
        $pegawai = $this->db->get_where('pegawai', ['username_pegawai' => $username])->row_array();

        if ($this->session->userdata('username')) {
            if ($superadmin) {
                redirect('sadmin');
            } else if ($admin) {
                redirect('admin');
            } else if ($pegawai) {
                redirect('pegawai');
            }
        }

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login', $data);
            $this->load->view('templates/auth_footer');
        } else {
            $this->_login();
        }
    }

    public function _login()
    {

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $superadmin = $this->db->get_where('superadmin', ['username_sa' => $username])->row_array();
        $admin = $this->db->get_where('admin', ['username_admin' => $username])->row_array();
        $pegawai = $this->db->get_where('pegawai', ['username_pegawai' => $username])->row_array();

        if ($superadmin) {
            //usernya ada
            if (password_verify($password, $superadmin['password_sa'])) {
                $data = [
                    'username' => $superadmin['username_sa'],
                    'id_role' => $superadmin['id_role']
                ];
                //session nama akun dan rolenya
                $this->session->set_userdata($data);
                if ($superadmin['id_role'] == 1) {
                    redirect('sadmin');
                }
            } else {
                redirect('login');
            }
        } else if ($admin) {
            //usernya ada
            if (password_verify($password, $admin['password_admin'])) {
                $data = [
                    'username' => $admin['username_admin'],
                    'id_admin' => $admin['id_admin'],
                    'id_role' => $admin['id_role']
                ];
                //session nama akun dan rolenya
                $this->session->set_userdata($data);
                if ($admin['id_role'] == 3) {
                    redirect('admin');
                }
            } else {
                redirect('login');
            }
        } else if ($pegawai) {
            //usernya ada
            if (password_verify($password, $pegawai['password_pegawai'])) {
                $data = [
                    'username' => $pegawai['username_pegawai'],
                    'id_pegawai' => $pegawai['id_pegawai'],
                    'id_role' => $pegawai['id_role']
                ];
                //session nama akun dan rolenya
                $this->session->set_userdata($data);

                if ($pegawai['id_role'] == 2) {
                    redirect('pegawai');
                }
            } else {
                redirect('login');
            }
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('id_perusahaan');
        $this->session->unset_userdata('nama_perusahaan');
        $this->session->unset_userdata('id_gudang');
        $this->session->unset_userdata('nama_gudang');
        $this->session->unset_userdata('nama_role');

        $this->session->set_flashdata('tes', '<div class="alert alert-success" role="alert">
        Anda berhasil keluar dari akun anda.</div>');
        redirect('login');
    }
}
