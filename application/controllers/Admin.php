<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model', '', TRUE);
        $this->load->library('Zend');
        $this->load->library('form_validation');
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
        if ($pegawai) {
            redirect('pegawai/blocked');
        }
        if ($admin) {
            $this->perusahaan();
        }
    }

    public function Barcode($kodenya)
    {
        $username = $this->session->userdata('username');
        $superadmin = $this->db->get_where('superadmin', ['username_sa' => $username])->row_array();
        $admin = $this->db->get_where('admin', ['username_admin' => $username])->row_array();
        $pegawai = $this->db->get_where('pegawai', ['username_pegawai' => $username])->row_array();
        if ($superadmin) {
            redirect('sadmin/blocked');
        }
        if ($pegawai) {
            redirect('pegawai/blocked');
        }
        if ($admin) {
            $this->zend->load('Zend/Barcode');
            Zend_Barcode::render('code128', 'image', array('text' => $kodenya));
        }
    }

    public function perusahaan()
    {

        $data['title'] = 'Pilih Perusahaan';

        $data['daftar_perusahaan'] = $this->admin_model->get_perusahaan();
        $data['daftar_gudang'] = $this->admin_model->get_gudang();

        $this->form_validation->set_rules('pilih_perusahaan', 'Perusahaan', 'required');
        $this->form_validation->set_rules('pilih_gudang', 'Gudang', 'required');

        if ($this->form_validation->run() == false) {
            $username = $this->session->userdata('username');
            $superadmin = $this->db->get_where('superadmin', ['username_sa' => $username])->row_array();
            $admin = $this->db->get_where('admin', ['username_admin' => $username])->row_array();
            $pegawai = $this->db->get_where('pegawai', ['username_pegawai' => $username])->row_array();
            if ($superadmin) {
                redirect('sadmin/blocked');
            }
            if ($pegawai) {
                redirect('pegawai/blocked');
            }
            if ($admin) {
                $this->load->view('admin/admin_perusahaan', $data);
            }
        } else {
            $this->_perusahaan();
        }
    }

    public function _perusahaan()
    {
        $perusahaan = $this->input->post('pilih_perusahaan');
        $gudang = $this->input->post('pilih_gudang');

        $perusahaan_cek = $this->db->get_where('admin_akses', ['id_admin' =>
        $this->session->userdata('id_admin'), 'id_perusahaan' => $perusahaan])->row_array();

        $gudang_cek = $this->db->get_where('admin_akses', ['id_admin' =>
        $this->session->userdata('id_admin'), 'id_gudang' => $gudang])->row_array();

        if ($perusahaan_cek) {
            if ($gudang_cek) {
                $data = [
                    'id_perusahaan' => $perusahaan['id_perusahaan'],
                    'nama_perusahaan' => $perusahaan['nama_perusahaan'],
                    'id_gudang' => $gudang['id_gudang'],
                    'nama_gudang' => $gudang['nama_gudang'],
                ];
                $this->session->set_userdata($data);
                redirect('admin/barang');
            } else {
                $data = [
                    'id_perusahaan' => $perusahaan['id_perusahaan'],
                    'id_gudang' => $gudang['id_gudang'],
                ];
                $this->session->set_userdata($data);
                redirect('admin/barang1');
            }
        } else {
            redirect('admin/blocked');
        }
    }

    public function print_stok($id_stok, $merk_barang, $nama_barang, $tanggal_stok)
    {
        $username = $this->session->userdata('username');

        $superadmin = $this->db->get_where('superadmin', ['username_sa' => $username])->row_array();
        $pegawai = $this->db->get_where('pegawai', ['username_pegawai' => $username])->row_array();
        if ($superadmin) {
            redirect('sadmin/blocked');
        }
        if ($pegawai) {
            redirect('pegawai/blocked');
        }
        $data['admin'] = $this->db->get_where('admin', ['id_admin' =>
        $this->session->userdata('id_admin')])->row_array();

        $data['perusahaan'] = $this->db->get_where('perusahaan', ['id_perusahaan' =>
        $this->session->userdata('id_perusahaan')])->row_array();

        $data['gudang'] = $this->db->get_where('gudang', ['id_gudang' =>
        $this->session->userdata('id_gudang')])->row_array();

        $data['stok'] = $this->admin_model->getById($id_stok);
        $this->load->library('pdf');
        //Kertas 3 paper (merah,putih,kuning)
        //$customPaper = array(0, 0, 595, 425);
        $customPaper = array(0, 0, 300, 280);
        $this->pdf->setPaper($customPaper);
        $this->pdf->filename = "Laporan Stok " . $merk_barang . ' ' . $nama_barang . '_' . $tanggal_stok;
        $this->pdf->load_view('admin/admin_print', $data);
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
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

    public function barang()
    {
        $username = $this->session->userdata('username');

        $superadmin = $this->db->get_where('superadmin', ['username_sa' => $username])->row_array();
        $pegawai = $this->db->get_where('pegawai', ['username_pegawai' => $username])->row_array();
        if ($superadmin) {
            redirect('sadmin/blocked');
        }
        if ($pegawai) {
            redirect('pegawai/blocked');
        }
        $data['title'] = 'Daftar Barang';
        //session
        $data['admin'] = $this->db->get_where('admin', ['username_admin' =>
        $this->session->userdata('username')])->row_array();
        $data['perusahaan'] = $this->db->get_where('perusahaan', ['id_perusahaan' =>
        $this->session->userdata('id_perusahaan')])->row_array();
        $data['gudang'] = $this->db->get_where('gudang', ['id_gudang' =>
        $this->session->userdata('id_gudang')])->row_array();

        //get daftar barang sesuai perusahaan
        $id_perusahaan =  $this->session->userdata('id_perusahaan');
        $id_gudang =  $this->session->userdata('id_gudang');
        $data['barang'] = $this->admin_model->getBarangByPerusahaan($id_perusahaan, $id_gudang);

        $this->form_validation->set_rules('kode_barang', 'Kode', 'required');
        $this->form_validation->set_rules('merk_barang', 'Merk', 'required');
        $this->form_validation->set_rules('nama_barang', 'Nama barang', 'required');
        $this->form_validation->set_rules('product_type_barang', 'Product Type', 'required');
        $this->form_validation->set_rules('ID', 'ID', 'required');
        $this->form_validation->set_rules('OD', 'OD', 'required');
        $this->form_validation->set_rules('thick_barang', 'Thick', 'required');
        $this->form_validation->set_rules('weight_barang', 'Weight', 'required');
        $this->form_validation->set_rules('barcode_barang', 'Barcode Barang', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/admin_header', $data);
            $this->load->view('admin/admin_topbar', $data);
            $this->load->view('admin/admin_sidebar', $data);
            $this->load->view('admin/admin_barang', $data);
            $this->load->view('admin/admin_footer', $data);
        } else {
            $data = [
                'id_perusahaan' => $id_perusahaan,
                'id_gudang' => $id_gudang,
                'kode_barang' => $this->input->post('kode_barang'),
                'merk_barang' => $this->input->post('merk_barang'),
                'nama_barang' => $this->input->post('nama_barang'),
                'product_type_barang' => $this->input->post('product_type_barang'),
                'ID' => $this->input->post('ID'),
                'OD' => $this->input->post('OD'),
                'thick_barang' => $this->input->post('thick_barang'),
                'weight_barang' => $this->input->post('weight_barang'),
                'barcode_barang' => $this->input->post('barcode_barang'),
            ];
            $this->db->insert('barang', $data);
            $this->session->set_flashdata(
                'tes',
                '<div class="alert alert-success" role="alert">
                Barang telah berhasil ditambahkan!
                </div>'
            );
            redirect('admin/barang');
        }
    }

    public function edit_barang()
    {
        $username = $this->session->userdata('username');

        $superadmin = $this->db->get_where('superadmin', ['username_sa' => $username])->row_array();
        $pegawai = $this->db->get_where('pegawai', ['username_pegawai' => $username])->row_array();
        if ($superadmin) {
            redirect('sadmin/blocked');
        }
        if ($pegawai) {
            redirect('pegawai/blocked');
        }
        $data['title'] = 'Edit Barang';
        //session
        $data['admin'] = $this->db->get_where('admin', ['username_admin' =>
        $this->session->userdata('username')])->row_array();
        $data['perusahaan'] = $this->db->get_where('perusahaan', ['id_perusahaan' =>
        $this->session->userdata('id_perusahaan')])->row_array();
        $data['gudang'] = $this->db->get_where('gudang', ['id_gudang' =>
        $this->session->userdata('id_gudang')])->row_array();

        //get daftar barang sesuai perusahaan
        $id_perusahaan =  $this->session->userdata('id_perusahaan');
        $id_gudang =  $this->session->userdata('id_gudang');
        $data['barang'] = $this->admin_model->getBarangByPerusahaan($id_perusahaan, $id_gudang);

        $this->form_validation->set_rules('kode_barang', 'Kode', 'required');
        $this->form_validation->set_rules('merk_barang', 'Merk', 'required');
        $this->form_validation->set_rules('nama_barang', 'Nama barang', 'required');
        $this->form_validation->set_rules('product_type_barang', 'Product Type', 'required');
        $this->form_validation->set_rules('ID', 'ID', 'required');
        $this->form_validation->set_rules('OD', 'OD', 'required');
        $this->form_validation->set_rules('thick_barang', 'Thick', 'required');
        $this->form_validation->set_rules('weight_barang', 'Weight', 'required');
        $this->form_validation->set_rules('barcode_barang', 'Barcode Barang', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/admin_header', $data);
            $this->load->view('admin/admin_topbar', $data);
            $this->load->view('admin/admin_sidebar', $data);
            $this->load->view('admin/admin_barang', $data);
            $this->load->view('admin/admin_footer', $data);
        } else {
            $id_barang = $this->input->post('id_barang');
            $data = [
                'kode_barang' => $this->input->post('kode_barang'),
                'merk_barang' => $this->input->post('merk_barang'),
                'nama_barang' => $this->input->post('nama_barang'),
                'product_type_barang' => $this->input->post('product_type_barang'),
                'ID' => $this->input->post('ID'),
                'OD' => $this->input->post('OD'),
                'thick_barang' => $this->input->post('thick_barang'),
                'weight_barang' => $this->input->post('weight_barang'),
                'barcode_barang' => $this->input->post('barcode_barang'),
            ];
            $this->db->where('id_barang', $id_barang);
            $this->db->update('barang', $data);
            $this->session->set_flashdata(
                'tes',
                '<div class="alert alert-success" role="alert">
                Barang telah berhasil diperbarui!
                </div>'
            );
            redirect('admin/barang');
        }
    }

    public function kartu()
    {
        $username = $this->session->userdata('username');

        $superadmin = $this->db->get_where('superadmin', ['username_sa' => $username])->row_array();
        $pegawai = $this->db->get_where('pegawai', ['username_pegawai' => $username])->row_array();
        if ($superadmin) {
            redirect('sadmin/blocked');
        }
        if ($pegawai) {
            redirect('pegawai/blocked');
        }
        $data['title'] = 'Stok Barang';
        //session
        $data['admin'] = $this->db->get_where('admin', ['username_admin' =>
        $this->session->userdata('username')])->row_array();
        $data['perusahaan'] = $this->db->get_where('perusahaan', ['id_perusahaan' =>
        $this->session->userdata('id_perusahaan')])->row_array();
        $data['gudang'] = $this->db->get_where('gudang', ['id_gudang' =>
        $this->session->userdata('id_gudang')])->row_array();

        //get daftar barang sesuai perusahaan
        $id_perusahaan =  $this->session->userdata('id_perusahaan');
        $id_gudang =  $this->session->userdata('id_gudang');
        $data['daftar_kartu'] = $this->admin_model->getBarangByPerusahaan($id_perusahaan, $id_gudang);

        $this->load->view('admin/admin_header', $data);
        $this->load->view('admin/admin_topbar', $data);
        $this->load->view('admin/admin_sidebar', $data);
        $this->load->view('admin/admin_kartu', $data);
        $this->load->view('admin/admin_footer');
    }

    public function kartu_stok($id_barang)
    {
        $username = $this->session->userdata('username');

        $superadmin = $this->db->get_where('superadmin', ['username_sa' => $username])->row_array();
        $pegawai = $this->db->get_where('pegawai', ['username_pegawai' => $username])->row_array();
        if ($superadmin) {
            redirect('sadmin/blocked');
        }
        if ($pegawai) {
            redirect('pegawai/blocked');
        }
        $data['title'] = 'Stok Barang';
        //session
        $data['admin'] = $this->db->get_where('admin', ['username_admin' =>
        $this->session->userdata('username')])->row_array();
        $data['perusahaan'] = $this->db->get_where('perusahaan', ['id_perusahaan' =>
        $this->session->userdata('id_perusahaan')])->row_array();
        $data['gudang'] = $this->db->get_where('gudang', ['id_gudang' =>
        $this->session->userdata('id_gudang')])->row_array();

        //get perusahaan dan gudang
        $id_perusahaan =  $this->session->userdata('id_perusahaan');
        $id_gudang =  $this->session->userdata('id_gudang');

        // get daftar no kartu
        $data['daftar_kartu'] = $this->admin_model->getBarangByPerusahaan($id_perusahaan, $id_gudang);

        //get daftar barang sesuai kartu
        $data['id_barang'] = $id_barang;
        $data['ambil_barang'] = $this->admin_model->getBarangById($id_barang);
        $data['stok'] = $this->admin_model->getStokByKartu($id_barang, $id_perusahaan, $id_gudang);

        //get daftar barang sesuai perusahaan
        $data['barang'] = $this->admin_model->getBarangByPerusahaan($id_perusahaan, $id_gudang);

        $this->form_validation->set_rules('tanggal_stok', 'Tanggal', 'required');
        $this->form_validation->set_rules('nopo_stok', 'No Po', 'required');
        $this->form_validation->set_rules('noreg_stok', 'No Reg', 'required');
        $this->form_validation->set_rules('masuk_stok', 'Qty Masuk', 'required');
        $this->form_validation->set_rules('keluar_stok', 'Qty Keluar', 'required');
        $this->form_validation->set_rules('harga_beli_stok', 'Harga Modal Dollar', 'required');
        $this->form_validation->set_rules('harga_modal_rupiah', 'Harga Modal Rupiah', 'required');
        $this->form_validation->set_rules('harga_jual_stok', 'Harga Jual Umum', 'required');
        $this->form_validation->set_rules('harga_jual_lain', 'Harga Jual Lain', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        $this->form_validation->set_rules('harga_ongkos', 'Harga Ongkos', 'required');
        $this->form_validation->set_rules('lokasi_stok', 'Lokasi Stok', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/admin_header', $data);
            $this->load->view('admin/admin_topbar', $data);
            $this->load->view('admin/admin_sidebar', $data);
            $this->load->view('admin/admin_stok', $data);
            $this->load->view('admin/admin_footer', $data);
        } else {
            $data = [
                'id_barang' => $this->input->post('id_barang'),
                'tanggal_stok' => $this->input->post('tanggal_stok'),
                'nopo_stok' => $this->input->post('nopo_stok'),
                'noreg_stok' => $this->input->post('noreg_stok'),
                'masuk_stok' => $this->input->post('masuk_stok'),
                'keluar_stok' => $this->input->post('keluar_stok'),
                'harga_beli_stok' => $this->input->post('harga_beli_stok'),
                'harga_jual_stok' => $this->input->post('harga_jual_stok'),
                'keterangan' => $this->input->post('keterangan'),
                'harga_ongkos' => $this->input->post('harga_ongkos'),
                'lokasi_stok' => $this->input->post('lokasi_stok'),
                'harga_modal_rupiah' => $this->input->post('harga_modal_rupiah'),
                'harga_jual_lain' => $this->input->post('harga_jual_lain'),
            ];
            $this->db->insert('stok', $data);
            $this->session->set_flashdata(
                'tes',
                '<div class="alert alert-success" role="alert">
                Stok telah berhasil ditambahkan!
                </div>'
            );
            redirect('admin/kartu_stok/' . $id_barang);
        }
    }

    public function edit_stok()
    {
        $username = $this->session->userdata('username');

        $superadmin = $this->db->get_where('superadmin', ['username_sa' => $username])->row_array();
        $pegawai = $this->db->get_where('pegawai', ['username_pegawai' => $username])->row_array();
        if ($superadmin) {
            redirect('sadmin/blocked');
        }
        if ($pegawai) {
            redirect('pegawai/blocked');
        }
        $data['title'] = 'Edit Stok Barang';
        //session
        $data['admin'] = $this->db->get_where('admin', ['username_admin' =>
        $this->session->userdata('username')])->row_array();
        $data['perusahaan'] = $this->db->get_where('perusahaan', ['id_perusahaan' =>
        $this->session->userdata('id_perusahaan')])->row_array();
        $data['gudang'] = $this->db->get_where('gudang', ['id_gudang' =>
        $this->session->userdata('id_gudang')])->row_array();

        //get perusahaan dan gudang
        $id_barang = $this->input->post('id_barang');
        $id_perusahaan =  $this->session->userdata('id_perusahaan');
        $id_gudang =  $this->session->userdata('id_gudang');

        // get daftar no kartu
        $data['daftar_kartu'] = $this->admin_model->getBarangByPerusahaan($id_perusahaan, $id_gudang);

        //get daftar stok
        $data['stok'] = $this->admin_model->getStokByKartu($id_perusahaan, $id_gudang);

        //get daftar barang sesuai perusahaan
        $data['barang'] = $this->admin_model->getBarangByPerusahaan($id_perusahaan, $id_gudang);

        $this->form_validation->set_rules('tanggal_stok', 'Tanggal', 'required');
        $this->form_validation->set_rules('nopo_stok', 'No Po', 'required');
        $this->form_validation->set_rules('noreg_stok', 'No Reg', 'required');
        $this->form_validation->set_rules('masuk_stok', 'Qty Masuk', 'required');
        $this->form_validation->set_rules('keluar_stok', 'Qty Keluar', 'required');
        $this->form_validation->set_rules('harga_beli_stok', 'Harga Modal Dollar', 'required');
        $this->form_validation->set_rules('harga_modal_rupiah', 'Harga Modal Rupiah', 'required');
        $this->form_validation->set_rules('harga_jual_stok', 'Harga Jual Umum', 'required');
        $this->form_validation->set_rules('harga_jual_lain', 'Harga Jual Lain', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        $this->form_validation->set_rules('harga_ongkos', 'Harga Ongkos', 'required');
        $this->form_validation->set_rules('lokasi_stok', 'Lokasi Stok', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/admin_header', $data);
            $this->load->view('admin/admin_topbar', $data);
            $this->load->view('admin/admin_sidebar', $data);
            $this->load->view('admin/admin_stok', $data);
            $this->load->view('admin/admin_footer', $data);
        } else {
            $id_stok = $this->input->post('id_stok');
            $data = [
                'tanggal_stok' => $this->input->post('tanggal_stok'),
                'nopo_stok' => $this->input->post('nopo_stok'),
                'noreg_stok' => $this->input->post('noreg_stok'),
                'masuk_stok' => $this->input->post('masuk_stok'),
                'keluar_stok' => $this->input->post('keluar_stok'),
                'harga_beli_stok' => $this->input->post('harga_beli_stok'),
                'harga_jual_stok' => $this->input->post('harga_jual_stok'),
                'keterangan' => $this->input->post('keterangan'),
                'harga_ongkos' => $this->input->post('harga_ongkos'),
                'lokasi_stok' => $this->input->post('lokasi_stok'),
                'harga_modal_rupiah' => $this->input->post('harga_modal_rupiah'),
                'harga_jual_lain' => $this->input->post('harga_jual_lain')
            ];
            $this->db->where('id_stok', $id_stok);
            $this->db->update('stok', $data);
            $this->session->set_flashdata(
                'tes',
                '<div class="alert alert-success" role="alert">
                Stok telah berhasil diperbarui!
                </div>'
            );
            redirect('admin/kartu_stok/' . $id_barang);
        }
    }

    public function boking()
    {
        $username = $this->session->userdata('username');

        $superadmin = $this->db->get_where('superadmin', ['username_sa' => $username])->row_array();
        $pegawai = $this->db->get_where('pegawai', ['username_pegawai' => $username])->row_array();
        if ($superadmin) {
            redirect('sadmin/blocked');
        }
        if ($pegawai) {
            redirect('pegawai/blocked');
        }
        $data['title'] = 'Daftar Boking';
        //session
        $data['admin'] = $this->db->get_where('admin', ['username_admin' =>
        $this->session->userdata('username')])->row_array();
        $data['perusahaan'] = $this->db->get_where('perusahaan', ['id_perusahaan' =>
        $this->session->userdata('id_perusahaan')])->row_array();
        $data['gudang'] = $this->db->get_where('gudang', ['id_gudang' =>
        $this->session->userdata('id_gudang')])->row_array();

        //get daftar boking sesuai perusahaan
        $id_perusahaan =  $this->session->userdata('id_perusahaan');
        $id_gudang =  $this->session->userdata('id_gudang');
        $data['boking'] = $this->admin_model->getBokingByPerusahaan($id_perusahaan, $id_gudang);
        $data['daftar_barang'] = $this->admin_model->getBarangByPerusahaan($id_perusahaan, $id_gudang);

        $this->form_validation->set_rules('pilih_barang', 'Barang', 'required');
        $this->form_validation->set_rules('no_surat', 'No Surat', 'required');
        $this->form_validation->set_rules('nama_boking', 'Nama Boking', 'required');
        $this->form_validation->set_rules('tanggal_boking', 'Tanggal Boking', 'required');
        $this->form_validation->set_rules('qty_boking', 'Qty', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/admin_header', $data);
            $this->load->view('admin/admin_topbar', $data);
            $this->load->view('admin/admin_sidebar', $data);
            $this->load->view('admin/admin_boking', $data);
            $this->load->view('admin/admin_footer', $data);
        } else {
            $data = [
                'id_barang' => $this->input->post('pilih_barang'),
                'no_surat' => $this->input->post('no_surat'),
                'nama_boking' => $this->input->post('nama_boking'),
                'tanggal_boking' => $this->input->post('tanggal_boking'),
                'qty_boking' => $this->input->post('qty_boking')
            ];
            $this->db->insert('boking', $data);
            $this->session->set_flashdata(
                'tes',
                '<div class="alert alert-success" role="alert">
                Data Boking telah berhasil ditambahkan!
                </div>'
            );
            redirect('admin/boking');
        }
    }

    public function approved_boking($id_boking)
    {
        $username = $this->session->userdata('username');

        $superadmin = $this->db->get_where('superadmin', ['username_sa' => $username])->row_array();
        $pegawai = $this->db->get_where('pegawai', ['username_pegawai' => $username])->row_array();
        if ($superadmin) {
            redirect('sadmin/blocked');
        }
        if ($pegawai) {
            redirect('pegawai/blocked');
        }
        $data['title'] = 'Approved Boking';
        //session
        $data['admin'] = $this->db->get_where('admin', ['username_admin' =>
        $this->session->userdata('username')])->row_array();
        $data['perusahaan'] = $this->db->get_where('perusahaan', ['id_perusahaan' =>
        $this->session->userdata('id_perusahaan')])->row_array();
        $data['gudang'] = $this->db->get_where('gudang', ['id_gudang' =>
        $this->session->userdata('id_gudang')])->row_array();

        $this->load->view('admin/admin_header', $data);
        $this->load->view('admin/admin_topbar', $data);
        $this->load->view('admin/admin_sidebar', $data);
        $this->load->view('admin/admin_boking', $data);
        $this->load->view('admin/admin_footer', $data);

        $data = [
            'status_boking' => 1
        ];
        $this->db->where('id_boking', $id_boking);
        $this->db->update('boking', $data);
        $this->session->set_flashdata(
            'tes',
            '<div class="alert alert-success" role="alert">
                Data Boking telah berhasil disetujui!
                </div>'
        );
        redirect('admin/boking');
    }

    public function batal_approved_boking($id_boking)
    {
        $username = $this->session->userdata('username');

        $superadmin = $this->db->get_where('superadmin', ['username_sa' => $username])->row_array();
        $pegawai = $this->db->get_where('pegawai', ['username_pegawai' => $username])->row_array();
        if ($superadmin) {
            redirect('sadmin/blocked');
        }
        if ($pegawai) {
            redirect('pegawai/blocked');
        }
        $data['title'] = 'Approved Boking';
        //session
        $data['admin'] = $this->db->get_where('admin', ['username_admin' =>
        $this->session->userdata('username')])->row_array();
        $data['perusahaan'] = $this->db->get_where('perusahaan', ['id_perusahaan' =>
        $this->session->userdata('id_perusahaan')])->row_array();
        $data['gudang'] = $this->db->get_where('gudang', ['id_gudang' =>
        $this->session->userdata('id_gudang')])->row_array();

        $this->load->view('admin/admin_header', $data);
        $this->load->view('admin/admin_topbar', $data);
        $this->load->view('admin/admin_sidebar', $data);
        $this->load->view('admin/admin_boking', $data);
        $this->load->view('admin/admin_footer', $data);

        $data = [
            'status_boking' => 0
        ];
        $this->db->where('id_boking', $id_boking);
        $this->db->update('boking', $data);
        $this->session->set_flashdata(
            'tes',
            '<div class="alert alert-success" role="alert">
                Data Boking telah berhasil dibatalkan!
                </div>'
        );
        redirect('admin/boking');
    }

    public function jual()
    {
        $username = $this->session->userdata('username');

        $superadmin = $this->db->get_where('superadmin', ['username_sa' => $username])->row_array();
        $pegawai = $this->db->get_where('pegawai', ['username_pegawai' => $username])->row_array();
        if ($superadmin) {
            redirect('sadmin/blocked');
        }
        if ($pegawai) {
            redirect('pegawai/blocked');
        }
        $data['title'] = 'Daftar Harga';
        //session
        $data['admin'] = $this->db->get_where('admin', ['username_admin' =>
        $this->session->userdata('username')])->row_array();
        $data['perusahaan'] = $this->db->get_where('perusahaan', ['id_perusahaan' =>
        $this->session->userdata('id_perusahaan')])->row_array();
        $data['gudang'] = $this->db->get_where('gudang', ['id_gudang' =>
        $this->session->userdata('id_gudang')])->row_array();

        //get daftar barang sesuai kartu
        $id_perusahaan =  $this->session->userdata('id_perusahaan');
        $id_gudang =  $this->session->userdata('id_gudang');

        $data['daftar_barang'] = $this->admin_model->getBarangByPerusahaan($id_perusahaan, $id_gudang);
        $data['jual'] = $this->admin_model->getJual($id_perusahaan, $id_gudang);
        $data['tbokingbarang'] = $this->admin_model->getBokingBarang2($id_perusahaan, $id_gudang);
        $data['total'] = $this->admin_model->getTotalBarang2($id_perusahaan, $id_gudang);

        $this->load->view('admin/admin_header', $data);
        $this->load->view('admin/admin_topbar', $data);
        $this->load->view('admin/admin_sidebar', $data);
        $this->load->view('admin/admin_jual', $data);
        $this->load->view('admin/admin_footer', $data);
    }

    public function hapus_stok($id_barang, $id_stok)
    {
        $username = $this->session->userdata('username');

        $superadmin = $this->db->get_where('superadmin', ['username_sa' => $username])->row_array();
        $pegawai = $this->db->get_where('pegawai', ['username_pegawai' => $username])->row_array();
        if ($superadmin) {
            redirect('sadmin/blocked');
        }
        if ($pegawai) {
            redirect('pegawai/blocked');
        }
        $this->admin_model->hapus_stok($id_stok);
        $this->session->set_flashdata(
            'tes',
            '<div class="alert alert-success" role="alert">
            Stok telah berhasil dihapus!
            </div>'
        );
        redirect('admin/kartu_stok/' . $id_barang);
    }

    public function hapus_barang($id_barang)
    {
        $username = $this->session->userdata('username');

        $superadmin = $this->db->get_where('superadmin', ['username_sa' => $username])->row_array();
        $pegawai = $this->db->get_where('pegawai', ['username_pegawai' => $username])->row_array();
        if ($superadmin) {
            redirect('sadmin/blocked');
        }
        if ($pegawai) {
            redirect('pegawai/blocked');
        }
        $this->admin_model->hapus_barang($id_barang);
        $this->session->set_flashdata(
            'tes',
            '<div class="alert alert-success" role="alert">
            Barang telah berhasil dihapus!
            </div>'
        );
        redirect('admin/barang');
    }

    public function hapus_boking($id_boking)
    {
        $username = $this->session->userdata('username');

        $superadmin = $this->db->get_where('superadmin', ['username_sa' => $username])->row_array();
        $pegawai = $this->db->get_where('pegawai', ['username_pegawai' => $username])->row_array();
        if ($superadmin) {
            redirect('sadmin/blocked');
        }
        if ($pegawai) {
            redirect('pegawai/blocked');
        }
        $this->admin_model->hapus_boking($id_boking);
        $this->session->set_flashdata(
            'tes',
            '<div class="alert alert-success" role="alert">
            Boking telah berhasil dihapus!
            </div>'
        );
        redirect('admin/boking');
    }

    public function barang1()
    {
        $username = $this->session->userdata('username');

        $superadmin = $this->db->get_where('superadmin', ['username_sa' => $username])->row_array();
        $pegawai = $this->db->get_where('pegawai', ['username_pegawai' => $username])->row_array();
        if ($superadmin) {
            redirect('sadmin/blocked');
        }
        if ($pegawai) {
            redirect('pegawai/blocked');
        }
        $data['title'] = 'Daftar Barang';
        //session
        $data['admin'] = $this->db->get_where('admin', ['username_admin' =>
        $this->session->userdata('username')])->row_array();
        $data['perusahaan'] = $this->db->get_where('perusahaan', ['id_perusahaan' =>
        $this->session->userdata('id_perusahaan')])->row_array();
        $data['gudang'] = $this->db->get_where('gudang', ['id_gudang' =>
        $this->session->userdata('id_gudang')])->row_array();

        //get daftar barang sesuai perusahaan
        $id_perusahaan =  $this->session->userdata('id_perusahaan');
        $id_gudang =  $this->session->userdata('id_gudang');
        $data['barang'] = $this->admin_model->getBarangByPerusahaan($id_perusahaan, $id_gudang);

        if ($this->form_validation->run() == false) {
            $this->load->view('admin1/admin1_header', $data);
            $this->load->view('admin1/admin1_topbar', $data);
            $this->load->view('admin1/admin1_sidebar', $data);
            $this->load->view('admin1/admin1_barang', $data);
            $this->load->view('admin1/admin1_footer', $data);
        }
    }

    public function boking1()
    {
        $username = $this->session->userdata('username');

        $superadmin = $this->db->get_where('superadmin', ['username_sa' => $username])->row_array();
        $pegawai = $this->db->get_where('pegawai', ['username_pegawai' => $username])->row_array();
        if ($superadmin) {
            redirect('sadmin/blocked');
        }
        if ($pegawai) {
            redirect('pegawai/blocked');
        }
        $data['title'] = 'Daftar Boking';
        //session
        $data['admin'] = $this->db->get_where('admin', ['username_admin' =>
        $this->session->userdata('username')])->row_array();
        $data['perusahaan'] = $this->db->get_where('perusahaan', ['id_perusahaan' =>
        $this->session->userdata('id_perusahaan')])->row_array();
        $data['gudang'] = $this->db->get_where('gudang', ['id_gudang' =>
        $this->session->userdata('id_gudang')])->row_array();

        //get daftar boking sesuai perusahaan
        $id_perusahaan =  $this->session->userdata('id_perusahaan');
        $id_gudang =  $this->session->userdata('id_gudang');
        $data['boking'] = $this->admin_model->getBokingByPerusahaan($id_perusahaan, $id_gudang);
        $data['daftar_barang'] = $this->admin_model->getBarangByPerusahaan($id_perusahaan, $id_gudang);

        if ($this->form_validation->run() == false) {
            $this->load->view('admin1/admin1_header', $data);
            $this->load->view('admin1/admin1_topbar', $data);
            $this->load->view('admin1/admin1_sidebar', $data);
            $this->load->view('admin1/admin1_boking', $data);
            $this->load->view('admin1/admin1_footer', $data);
        }
    }

    public function jual1()
    {
        $username = $this->session->userdata('username');

        $superadmin = $this->db->get_where('superadmin', ['username_sa' => $username])->row_array();
        $pegawai = $this->db->get_where('pegawai', ['username_pegawai' => $username])->row_array();
        if ($superadmin) {
            redirect('sadmin/blocked');
        }
        if ($pegawai) {
            redirect('pegawai/blocked');
        }
        $data['title'] = 'Daftar Harga';
        //session
        $data['admin'] = $this->db->get_where('admin', ['username_admin' =>
        $this->session->userdata('username')])->row_array();
        $data['perusahaan'] = $this->db->get_where('perusahaan', ['id_perusahaan' =>
        $this->session->userdata('id_perusahaan')])->row_array();
        $data['gudang'] = $this->db->get_where('gudang', ['id_gudang' =>
        $this->session->userdata('id_gudang')])->row_array();

        //get daftar barang sesuai kartu
        $id_perusahaan =  $this->session->userdata('id_perusahaan');
        $id_gudang =  $this->session->userdata('id_gudang');

        $data['daftar_barang'] = $this->admin_model->getBarangByPerusahaan($id_perusahaan, $id_gudang);
        $data['jual'] = $this->admin_model->getJual($id_perusahaan, $id_gudang);
        $data['tbokingbarang'] = $this->admin_model->getBokingBarang2($id_perusahaan, $id_gudang);
        $data['total'] = $this->admin_model->getTotalBarang2($id_perusahaan, $id_gudang);

        $this->load->view('admin1/admin1_header', $data);
        $this->load->view('admin1/admin1_topbar', $data);
        $this->load->view('admin1/admin1_sidebar', $data);
        $this->load->view('admin1/admin1_jual', $data);
        $this->load->view('admin1/admin1_footer', $data);
    }
}
