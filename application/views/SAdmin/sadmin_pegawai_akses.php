<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item active">
        <a href="<?= base_url('sadmin/perusahaan'); ?>">Perusahaan</a>
    </li>
    <li class="breadcrumb-item active"> <?= $perusahaan['nama_perusahaan'] ?></li>
    <li class="breadcrumb-item active"><?= $gudang['nama_gudang'] ?></li>
</ol>
<?= $this->session->flashdata('tes'); ?>

<!-- Content -->
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Akses Pegawai</div>
    <div class="card-body">
        <h6>Nama Pegawai: <?= $pegawai['nama_pegawai'] ?></h6>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>

                        <th scope="col">Perusahaan</th>

                        <th scope="col">Akses</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($akses as $p) : ?>
                        <tr>
                            <td><?= $p['nama_perusahaan'] ?></td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" <?= cek_akses_pegawai($pegawai['id_pegawai'], $p['id_perusahaan']); ?> data-pegawai="<?= $pegawai['id_pegawai']; ?>" data-perusahaan="<?= $p['id_perusahaan']; ?>">
                                </div>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>