<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('pegawai_model', '', true);
        $this->load->library('form_validation');
        $this->load->library('Zend');
        if (!$this->session->userdata('username')) {
            redirect('login');
        }
    }

    public function index()
    {
        $username = $this->session->userdata('username');
        $superadmin = $this->db->get_where('superadmin', ['username_sa' => $username])->row_array();
        $admin = $this->db->get_where('admin', ['username_admin' => $username])->row_array();
        $pegawai = $this->db->get_where('pegawai', ['username_pegawai' => $username])->row_array();
        if ($superadmin) {
            redirect('sadmin/blocked');
        }
        if ($admin) {
            redirect('admin/blocked');
        }
        if ($pegawai) {
            $this->perusahaan();
        }
    }

    public function Barcode($kodenya)
    {
        $this->zend->load('Zend/Barcode');
        Zend_Barcode::render('code128', 'image', array('text' => $kodenya));
    }
    public function perusahaan()
    {
        $data['title'] = 'Pilih Perusahaan';

        $data['daftar_perusahaan'] = $this->pegawai_model->get_perusahaan();

        $this->form_validation->set_rules('pilih_perusahaan', 'Perusahaan', 'required');

        if ($this->form_validation->run() == false) {
            $username = $this->session->userdata('username');
            $superadmin = $this->db->get_where('superadmin', ['username_sa' => $username])->row_array();
            $admin = $this->db->get_where('admin', ['username_admin' => $username])->row_array();
            $pegawai = $this->db->get_where('pegawai', ['username_pegawai' => $username])->row_array();

            if ($superadmin) {
                redirect('sadmin/blocked');
            }
            if ($admin) {
                redirect('admin/blocked');
            }
            if ($pegawai) {
                $this->load->view('pegawai/pegawai_perusahaan', $data);
            }
        } else {
            $this->_perusahaan();
        }
    }

    public function _perusahaan()
    {

        $perusahaan = $this->input->post('pilih_perusahaan');

        $perusahaan_cek = $this->db->get_where('pegawai_akses', ['id_pegawai' =>
        $this->session->userdata('id_pegawai'), 'id_perusahaan' => $perusahaan])->row_array();

        if ($perusahaan_cek) {
            $data = [
                'id_perusahaan' => $perusahaan['id_perusahaan'],
                'nama_perusahaan' => $perusahaan['nama_perusahaan'],

            ];
            $this->session->set_userdata($data);
            redirect('pegawai/barang');
        } else {
            redirect('pegawai/blocked');
        }
    }

    public function barang()
    {

        $username = $this->session->userdata('username');

        $superadmin = $this->db->get_where('superadmin', ['username_sa' => $username])->row_array();
        $admin = $this->db->get_where('admin', ['username_admin' => $username])->row_array();
        if ($superadmin) {
            redirect('sadmin/blocked');
        }
        if ($admin) {
            redirect('admin/blocked');
        }
        $data['title'] = 'Daftar Barang';
        //session
        $data['pg'] = $this->db->get_where('pegawai', ['username_pegawai' =>
        $this->session->userdata('username')])->row_array();
        $data['perusahaan'] = $this->db->get_where('perusahaan', ['id_perusahaan' =>
        $this->session->userdata('id_perusahaan')])->row_array();


        $data['id_role'] = $this->db->get_where('role', ['id_role' =>
        $this->session->userdata('role_id')])->row_array();

        //get daftar barang sesuai kartu
        $id_perusahaan = $this->session->userdata('id_perusahaan');

        $data['barang'] = $this->pegawai_model->getBarangByPerusahaan($id_perusahaan);

        $data['totalbarangpekan'] = $this->pegawai_model->getTotalBarangPekan($id_perusahaan);
        $data['totalakhirpekan'] = $this->pegawai_model->getTotalAkhirPekan($id_perusahaan);

        $data['totalbarangpadang'] = $this->pegawai_model->getTotalBarangPadang($id_perusahaan);
        $data['totalakhirpadang'] = $this->pegawai_model->getTotalAkhirPadang($id_perusahaan);

        $data['tbokingbarangpekan'] = $this->pegawai_model->gettBokingBarangPekan($id_perusahaan);

        $data['tbokingbarangpadang'] = $this->pegawai_model->gettBokingBarangPadang($id_perusahaan);
        $data['tbokingbarang'] = $this->pegawai_model->gettBokingBarang($id_perusahaan);

        $data['total'] = $this->pegawai_model->getTotalBarang($id_perusahaan);

        $this->load->view('pegawai/pegawai_header', $data);
        $this->load->view('pegawai/pegawai_topbar', $data);
        $this->load->view('pegawai/pegawai_sidebar', $data);
        $this->load->view('pegawai/pegawai_barang', $data);
        $this->load->view('pegawai/pegawai_footer', $data);
    }

    public function jual()
    {
        $username = $this->session->userdata('username');

        $superadmin = $this->db->get_where('superadmin', ['username_sa' => $username])->row_array();
        $admin = $this->db->get_where('admin', ['username_admin' => $username])->row_array();
        if ($superadmin) {
            redirect('sadmin/blocked');
        }
        if ($admin) {
            redirect('admin/blocked');
        }
        $data['title'] = 'Daftar Harga';
        //session
        $data['pg'] = $this->db->get_where('pegawai', ['username_pegawai' =>
        $this->session->userdata('username')])->row_array();
        $data['perusahaan'] = $this->db->get_where('perusahaan', ['id_perusahaan' =>
        $this->session->userdata('id_perusahaan')])->row_array();

        //get daftar barang sesuai kartu
        $id_perusahaan = $this->session->userdata('id_perusahaan');

        $data['daftar_stok'] = $this->pegawai_model->getStokByPerusahaan($id_perusahaan);
        $data['jual'] = $this->pegawai_model->getJual($id_perusahaan);
        $data['tbokingbarang'] = $this->pegawai_model->getBokingBarang2($id_perusahaan);
        $data['total'] = $this->pegawai_model->getTotalBarang2($id_perusahaan);

        $this->load->view('pegawai/pegawai_header', $data);
        $this->load->view('pegawai/pegawai_topbar', $data);
        $this->load->view('pegawai/pegawai_sidebar', $data);
        $this->load->view('pegawai/pegawai_jual', $data);
        $this->load->view('pegawai/pegawai_footer', $data);
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('id_perusahaan');
        $this->session->unset_userdata('nama_perusahaan');
        $this->session->unset_userdata('nama_role');

        $this->session->set_flashdata('tes', '<div class="alert alert-success" role="alert">
        Anda berhasil keluar dari akun anda.</div>');
        redirect('login');
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }
}
