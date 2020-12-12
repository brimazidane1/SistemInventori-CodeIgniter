<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class pegawai_model extends CI_Model
{
    function get_perusahaan()
    {
        return $this->db->get('perusahaan')->result_array();
    }

    function get_gudang()
    {
        return $this->db->get('gudang')->result_array();
    }

    public function getBarangById($id)
    {
        return $this->db->get_where('barang', ['id_barang' => $id])->row_array();
    }

    function getTotalBarang($id_perusahaan)
    {
        $query = $this->db->select('barang.id_barang');
        $this->db->select('barang.kode_barang');
        $this->db->select('barang.merk_barang');
        $this->db->select('barang.nama_barang');
        $this->db->select('barang.product_type_barang');
        $this->db->select('barang.ID');
        $this->db->select('barang.OD');
        $this->db->select('barang.thick_barang');
        $this->db->select('barang.weight_barang');
        $this->db->select_sum('barang.total_barang');
        $this->db->select_sum('boking.qty_boking');
        $this->db->from('barang');
        $this->db->where('barang.id_perusahaan', $id_perusahaan);
        $this->db->where('boking.status_boking', 0);
        $this->db->join('boking', 'boking.id_barang = barang.id_barang', 'left');
        $this->db->group_by('barang.kode_barang');
        return $this->db->get()->result_array();
    }

    function getBarangByPerusahaan($id_perusahaan)
    {
        $query = $this->db->select('barang.id_barang');
        $this->db->select('barang.kode_barang');
        $this->db->select('barang.merk_barang');
        $this->db->select('barang.nama_barang');
        $this->db->select('barang.product_type_barang');
        $this->db->select('barang.ID');
        $this->db->select('barang.OD');
        $this->db->select('barang.thick_barang');
        $this->db->select('barang.weight_barang');
        $this->db->select_sum('barang.total_barang');
        $this->db->from('barang');
        $this->db->where('barang.id_perusahaan', $id_perusahaan);
        $this->db->group_by('barang.kode_barang');

        return $this->db->get()->result_array();
    }

    function getKodeBarang($id_perusahaan)
    {
        $query = $this->db->select('barang.kode_barang');
        $this->db->from('barang');
        $this->db->where('barang.id_perusahaan', $id_perusahaan);
        $this->db->group_by('barang.kode_barang');

        return $this->db->get()->result_array();
    }

    function getTotalBarangPekan($id_perusahaan)
    {
        $query = $this->db->select('barang.kode_barang');
        $this->db->select_sum('barang.total_barang');
        $this->db->from('barang');
        $this->db->where('barang.id_perusahaan', $id_perusahaan);
        $this->db->where('barang.id_gudang', 3);
        $this->db->group_by('barang.kode_barang');
        return $this->db->get()->result_array();
    }

    function gettBokingBarangPekan($id_perusahaan)
    {
        $query = $this->db->select('barang.kode_barang');
        $this->db->select('barang.id_barang');
        $this->db->select('barang.id_gudang');
        $this->db->select_sum('boking.qty_boking');
        $this->db->from('barang');
        $this->db->where('barang.id_perusahaan', $id_perusahaan);
        $this->db->where('barang.id_gudang', 3);
        $this->db->where('boking.status_boking', 0);
        $this->db->join('boking', 'boking.id_barang = barang.id_barang');
        $this->db->group_by('barang.kode_barang');
        return $this->db->get()->result_array();
    }

    function getTotalAkhirPekan($id_perusahaan)
    {
        $this->db->select('barang.kode_barang');
        $this->db->select('barang.id_barang');
        $this->db->select('barang.id_gudang');
        $this->db->select('barang.total_barang');
        $this->db->select_sum('boking.qty_boking');
        $this->db->from('barang');
        $this->db->where('barang.id_perusahaan', $id_perusahaan);
        $this->db->where('barang.id_gudang', 3);
        $this->db->where('boking.status_boking', 0);
        $this->db->join('boking', 'boking.id_barang = barang.id_barang');
        $this->db->group_by('barang.kode_barang');
        return $this->db->get()->result_array();
    }

    function getTotalBarangPadang($id_perusahaan)
    {
        $query = $this->db->select('barang.kode_barang');
        $this->db->select_sum('barang.total_barang');
        $this->db->from('barang');
        $this->db->where('barang.id_perusahaan', $id_perusahaan);
        $this->db->where('barang.id_gudang', 4);
        $this->db->group_by('barang.kode_barang');
        return $this->db->get()->result_array();
    }

    function gettBokingBarangPadang($id_perusahaan)
    {
        $query = $this->db->select('barang.kode_barang');
        $this->db->select('barang.kode_barang');
        $this->db->select('barang.id_gudang');
        $this->db->select_sum('boking.qty_boking');
        $this->db->from('barang');
        $this->db->where('barang.id_perusahaan', $id_perusahaan);
        $this->db->where('barang.id_gudang', 4);
        $this->db->where('boking.status_boking', 0);
        $this->db->join('boking', 'boking.id_barang = barang.id_barang');
        $this->db->group_by('barang.id_barang');
        return $this->db->get()->result_array();
    }

    function getTotalAkhirPadang($id_perusahaan)
    {
        $this->db->select('barang.kode_barang');
        $this->db->select('barang.id_barang');
        $this->db->select('barang.id_gudang');
        $this->db->select('barang.total_barang');
        $this->db->select_sum('boking.qty_boking');
        $this->db->from('barang');
        $this->db->where('barang.id_perusahaan', $id_perusahaan);
        $this->db->where('barang.id_gudang', 4);
        $this->db->where('boking.status_boking', 0);
        $this->db->join('boking', 'boking.id_barang = barang.id_barang');
        $this->db->group_by('barang.kode_barang');
        return $this->db->get()->result_array();
    }

    function gettBokingBarang($id_perusahaan)
    {
        $query = $this->db->select('barang.kode_barang');
        $this->db->select_sum('boking.qty_boking');
        $this->db->from('barang');
        $this->db->where('barang.id_perusahaan', $id_perusahaan);
        $this->db->where('boking.status_boking', 0);
        $this->db->join('boking', 'boking.id_barang = barang.id_barang', 'inner');
        $this->db->group_by('barang.kode_barang');

        return $this->db->get()->result_array();
    }

    function getStokByKartu($id_barang, $id_perusahaan)
    {
        $query = $this->db->select('*');
        $this->db->from('stok');
        $this->db->join('barang', 'barang.id_barang = stok.id_barang', 'inner');
        $this->db->where('stok.id_barang', $id_barang);
        $this->db->where('barang.id_perusahaan', $id_perusahaan);
        return $this->db->get()->result_array();
    }

    function getStokByPerusahaan($id_perusahaan)
    {
        $query = $this->db->select('*');
        $this->db->from('stok');
        $this->db->join('barang', 'barang.id_barang = stok.id_barang', 'inner');
        $this->db->where('barang.id_perusahaan', $id_perusahaan);
        return $this->db->get()->result_array();
    }

    function getBokingByPerusahaan($id_perusahaan)
    {
        $query = $this->db->select('*');
        $this->db->from('boking');
        $this->db->join('barang', 'boking.id_barang = barang.id_barang', 'inner');
        $this->db->where('barang.id_perusahaan', $id_perusahaan);
        return $this->db->get()->result_array();
    }

    function getBokingBarang2($id_perusahaan)
    {
        $this->db->select('barang.kode_barang');
        $this->db->select('boking.id_boking');
        $this->db->select('barang.id_barang');
        $this->db->select('barang.total_barang');
        $this->db->select_sum('boking.qty_boking');
        $this->db->from('barang');
        $this->db->where('barang.id_perusahaan', $id_perusahaan);
        $this->db->where('boking.status_boking', 0);
        $this->db->join('boking', 'boking.id_barang = barang.id_barang', 'LEFT');
        $this->db->group_by('barang.id_barang');

        return $this->db->get()->result_array();
    }

    function getTotalBarang2($id_perusahaan)
    {
        $this->db->select('*');
        $this->db->select_sum('barang.total_barang');
        $this->db->select_sum('boking.qty_boking');
        $this->db->from('barang');
        $this->db->where('barang.id_perusahaan', $id_perusahaan);
        $this->db->where('boking.status_boking', 0);
        $this->db->join('boking', 'boking.id_barang = barang.id_barang', 'LEFT');
        $this->db->group_by('barang.kode_barang');

        return $this->db->get()->result_array();
    }

    function getJual($id_perusahaan)
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
        gudang.nama_gudang,
        stok.harga_jual_stok,
        stok.harga_jual_lain
        FROM stok 
        INNER JOIN barang
          ON stok.id_barang = barang.id_barang
        INNER JOIN gudang
          ON barang.id_gudang = gudang.id_gudang
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
        GROUP BY barang.id_barang
        ";
        return $this->db->query($sql);
    }
}
