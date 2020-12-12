<?php


function cek_akses_admin($id_admin, $id_perusahaan, $id_gudang)
{
    $ci = get_instance();

    $ci->db->where('id_admin', $id_admin);
    $ci->db->where('id_perusahaan', $id_perusahaan);
    $ci->db->where('id_gudang', $id_gudang);
    $result = $ci->db->get('admin_akses');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}

function cek_akses_pegawai($id_pegawai, $id_perusahaan)
{
    $ci = get_instance();

    $ci->db->where('id_pegawai', $id_pegawai);
    $ci->db->where('id_perusahaan', $id_perusahaan);
    $result = $ci->db->get('pegawai_akses');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}
