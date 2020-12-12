<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class admin_model extends CI_Model
{
    function get_perusahaan()
    {

        return $this->db->get('perusahaan')->result_array();
    }

    public function getById($id)
    {
        $this->db->join('barang', 'barang.id_barang = stok.id_barang', 'inner');
        return $this->db->get_where('stok', ['id_stok' => $id])->row();
    }
    function get_gudang()
    {

        return $this->db->get('gudang')->result_array();
    }

    function get_admin($id_perusahaan, $id_gudang)
    {
        $query =  $this->db->select('*');
        $this->db->from('admin');
        $this->db->join('perusahaan', 'admin.id_perusahaan = perusahaan.id_perusahaan', 'inner');
        $this->db->join('gudang', 'admin.id_gudang = gudang.id_gudang', 'inner');
        $this->db->where('admin.id_perusahaan', $id_perusahaan);
        $this->db->where('admin.id_gudang', $id_gudang);
        return $this->db->get()->result_array();
    }

    function get_pegawai()
    {
        return $this->db->get('pegawai')->result_array();
    }

    public function getBarangById($id)
    {
        return $this->db->get_where('barang', ['id_barang' => $id])->row_array();
    }

    function getBarangByPerusahaan($id_perusahaan, $id_gudang)
    {
        $query =  $this->db->select('*');
        $this->db->from('barang');
        $this->db->join('gudang', 'barang.id_gudang = gudang.id_gudang', 'inner');
        $this->db->where('id_perusahaan', $id_perusahaan);
        $this->db->where('barang.id_gudang', $id_gudang);
        return $this->db->get()->result_array();
    }

    function getStokByKartu($id_barang, $id_perusahaan, $id_gudang)
    {
        $query =  $this->db->select('*');
        $this->db->from('stok');
        $this->db->join('barang', 'barang.id_barang = stok.id_barang', 'inner');
        $this->db->where('stok.id_barang', $id_barang);
        $this->db->where('barang.id_perusahaan', $id_perusahaan);
        $this->db->where('barang.id_gudang', $id_gudang);
        return $this->db->get()->result_array();
    }

    function getStokByPerusahaan($id_perusahaan, $id_gudang)
    {
        $query =  $this->db->select('*');
        $this->db->from('stok');
        $this->db->join('barang', 'barang.id_barang = stok.id_barang', 'inner');
        $this->db->where('barang.id_perusahaan', $id_perusahaan);
        $this->db->where('barang.id_gudang', $id_gudang);
        return $this->db->get()->result_array();
    }

    function getBokingByPerusahaan($id_perusahaan, $id_gudang)
    {
        $query =  $this->db->select('*');
        $this->db->from('boking');
        $this->db->join('barang', 'boking.id_barang = barang.id_barang', 'inner');
        $this->db->where('barang.id_perusahaan', $id_perusahaan);
        $this->db->where('barang.id_gudang', $id_gudang);
        return $this->db->get()->result_array();
    }

    function getBokingBarang2($id_perusahaan, $id_gudang)
    {
        $this->db->select('barang.kode_barang');
        $this->db->select('boking.id_boking');
        $this->db->select('barang.id_barang');
        $this->db->select('barang.total_barang');
        $this->db->select_sum('boking.qty_boking');
        $this->db->from('barang');
        $this->db->where('barang.id_perusahaan', $id_perusahaan);
        $this->db->where('barang.id_gudang', $id_gudang);
        $this->db->where('boking.status_boking', 0);
        $this->db->join('boking', 'boking.id_barang = barang.id_barang', 'LEFT');
        $this->db->group_by('barang.id_barang');

        return $this->db->get()->result_array();
    }

    function getTotalBarang2($id_perusahaan, $id_gudang)
    {
        $this->db->select('*');
        $this->db->select_sum('barang.total_barang');
        $this->db->select_sum('boking.qty_boking');
        $this->db->from('barang');
        $this->db->where('barang.id_perusahaan', $id_perusahaan);
        $this->db->where('barang.id_gudang', $id_gudang);
        $this->db->where('boking.status_boking', 0);
        $this->db->join('boking', 'boking.id_barang = barang.id_barang', 'LEFT');
        $this->db->group_by('barang.kode_barang');

        return $this->db->get()->result_array();
    }

    function getJual($id_perusahaan, $id_gudang)
    {
        $sql = "SELECT id_stok,
        sum(boking.qty_boking) qty,
        boking.status_boking,
        boking.id_boking,
        barang.total_barang,
        barang.id_barang,
        barang.kode_barang,
        barang.nama_barang,
        barang.merk_barang,
        stok.harga_jual_stok,
        stok.harga_jual_lain
        FROM stok 
        INNER JOIN barang
          ON stok.id_barang = barang.id_barang
        LEFT JOIN boking
          ON barang.id_barang = boking.id_barang
        INNER JOIN
          (SELECT id_barang, MAX(id_stok) AS MaxID
          FROM stok
          Where stok.keluar_stok <= '0'
          GROUP BY id_barang) groupedtt 
        ON stok.id_barang = groupedtt.id_barang
        AND stok.id_stok = groupedtt.MaxID
        WHERE barang.id_perusahaan ='" . $id_perusahaan . "'
        AND barang.id_gudang ='" . $id_gudang . "'
        GROUP BY barang.id_barang
        ";
        return $this->db->query($sql);
    }

    public function hapus_stok($id_stok)
    {
        $this->db->where('id_stok', $id_stok);
        $this->db->delete('stok');
    }

    public function hapus_barang($id_barang)
    {
        $this->db->where('id_barang', $id_barang);
        $this->db->delete('barang');
    }

    public function hapus_boking($id_boking)
    {
        $this->db->where('id_boking', $id_boking);
        $this->db->delete('boking');
    }
}
