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
        Daftar Super Admin</div>
    <div class="card-body">
        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#tambahAdminModal">Tambah Super Admin</a><br><br>
        <div class="table-responsive">
            <table id="tabel" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Super Admin</th>
                        <th>Username</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($sadmin as $a) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $a['nama_sa'] ?></td>
                            <td><?= $a['username_sa'] ?></td>

                            <td>
                                <a href="<?= base_url('sadmin/hapus_sadmin/' . $a['id_sa']); ?>" class="btn btn-primary">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th>Nama Super Admin</th>
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
                <h5 class="modal-title" id="tambahAdminModalLabel">Tambah Super Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('sadmin/kelola_sadmin'); ?>" method="post">
                <div class="modal-body">
                    <?= form_error('nama_sa', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_sa" name="nama_sa" placeholder="Nama Super Admin">
                    </div>
                    <?= form_error('username_sa', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <input type="text" class="form-control" id="username_sa" name="username_sa" placeholder="Username Super Admin">
                    </div>
                    <?= form_error('password_sa', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password_sa" name="password_sa" placeholder="Password">
                    </div>
                    <?= form_error('password_sa2', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password_sa2" name="password_sa2" placeholder="Konfirmasi Password">
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