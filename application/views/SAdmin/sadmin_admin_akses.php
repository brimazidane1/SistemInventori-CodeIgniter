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
        Akses Admin</div>
    <div class="card-body">
        <h6>Nama Admin: <?= $admin['nama_admin'] ?></h6>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Perusahaan</th>
                        <th scope="col">Gudang</th>
                        <th scope="col">Akses</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($akses as $g) : ?>
                        <tr>
                            <td>Perusahaan 1</td>
                            <td><?= $g['nama_gudang'] ?></td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" <?= cek_akses_admin($admin['id_admin'], 5, $g['id_gudang']); ?> data-admin="<?= $admin['id_admin']; ?>" data-perusahaan="5" data-gudang="<?= $g['id_gudang']; ?>">
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php foreach ($akses as $g) : ?>
                        <tr>
                            <td>Perusahaan 2</td>
                            <td><?= $g['nama_gudang'] ?></td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" <?= cek_akses_admin($admin['id_admin'], 7, $g['id_gudang']); ?> data-admin="<?= $admin['id_admin']; ?>" data-perusahaan="7" data-gudang="<?= $g['id_gudang']; ?>">
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>