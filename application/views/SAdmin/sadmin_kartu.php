<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item active">
        <a href="<?= base_url('sadmin/perusahaan'); ?>">Perusahaan</a>
    </li>
    <li class="breadcrumb-item active"> <?= $perusahaan['nama_perusahaan'] ?></li>
    <li class="breadcrumb-item active"><?= $gudang['nama_gudang'] ?></li>
</ol>

<?= $this->session->flashdata('tes'); ?>

<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Kartu</div>
    <div class="card-body">

        <div class="table-responsive">
            <!-- Content -->
            <table id="tabel" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No. Kartu Barang</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Merk Barang</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($daftar_kartu as $d) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $d['kode_barang'] ?></td>
                            <td><?= $d['nama_barang'] ?></td>
                            <td><?= $d['merk_barang'] ?></td>
                            <td><a href="<?= base_url('sadmin/kartu_stok/' . $d['id_barang']); ?>" class="btn btn-primary">Lihat Kartu</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>No. Kartu Barang</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Merk Barang</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>