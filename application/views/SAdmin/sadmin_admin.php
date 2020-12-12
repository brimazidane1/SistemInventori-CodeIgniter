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
        Daftar Admin</div>
    <div class="card-body">
        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#tambahAdminModal">Tambah Admin</a><br><br>
        <div class="table-responsive">
            <table id="tabel" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Admin</th>
                        <th>Username</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($admin as $a) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $a['nama_admin'] ?></td>
                            <td><?= $a['username_admin'] ?></td>

                            <td>
                                <a href="<?= base_url('sadmin/admin_akses/' . $a['id_admin']); ?>" class="btn btn-primary">Akses</a>
                                <a href="<?= base_url('sadmin/hapus_admin/' . $a['id_admin']); ?>" class="btn btn-primary">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th>Nama Admin</th>
                        <th>Username</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Admin -->
<div class="modal fade" id="tambahAdminModal" tabindex="-1" role="dialog" aria-labelledby="tambahAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahAdminModalLabel">Tambah Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('sadmin/kelola_admin'); ?>" method="post">
                <div class="modal-body">
                    <?= form_error('nama_admin', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_admin" name="nama_admin" placeholder="Nama Admin">
                    </div>
                    <?= form_error('username_admin', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <input type="text" class="form-control" id="username_admin" name="username_admin" placeholder="Username Admin">
                    </div>
                    <?= form_error('password_admin', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password_admin" name="password_admin" placeholder="Password">
                    </div>
                    <?= form_error('password_admin2', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password_admin2" name="password_admin2" placeholder="Konfirmasi Password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>