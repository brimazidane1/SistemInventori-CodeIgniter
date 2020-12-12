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
        Daftar Pegawai</div>
    <div class="card-body">
        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#tambahPegawaiModal">Tambah Pegawai</a><br><br>
        <div class="table-responsive">
            <table id="tabel" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pegawai</th>
                        <th>Username Pegawai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($pegawai as $a) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $a['nama_pegawai'] ?></td>
                            <td><?= $a['username_pegawai'] ?></td>
                            <td>
                                <a href="<?= base_url('sadmin/pegawai_akses/' . $a['id_pegawai']); ?>" class="btn btn-primary">Akses</a>
                                <a href="<?= base_url('sadmin/hapus_pegawai/' . $a['id_pegawai']); ?>" class="btn btn-primary">Hapus</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th>Nama Pegawai</th>
                        <th>Username Pegawai</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>
</div>

<!-- Modal Tambah Pegawai -->
<div class="modal fade" id="tambahPegawaiModal" tabindex="-1" role="dialog" aria-labelledby="tambahPegawaiModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPegawaiModalLabel">Tambah Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('sadmin/kelola_pegawai'); ?>" method="post">
                <div class="modal-body">
                    <?= form_error('nama_pegawai', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai" placeholder="Nama Pegawai">
                    </div>
                    <?= form_error('username_pegawai', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <input type="text" class="form-control" id="username_pegawai" name="username_pegawai" placeholder="Username Pegawai">
                    </div>
                    <?= form_error('password_pegawai', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password_pegawai" name="password_pegawai" placeholder="Password">
                    </div>
                    <?= form_error('password_pegawai2', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password_pegawai2" name="password_pegawai2" placeholder="Konfirmasi Password">
                    </div>
                    <!-- <?= form_error('pilih_perusahaan', '<small class="text-danger pl-3">', '</small>') ?>
                            <div class="form-group">
                                <select class="custom-select" id="pilih_perusahaan" name="pilih_perusahaan">
                                    <option class="form-control form-control-user" value=""> -- Pilih Perusahaan -- </option>

                                    <div class="form-control form-control-user" aria-labelledby="pilih_perusahaan">
                                        <?php foreach ($daftar_perusahaan as $d) : ?>
                                            <option value="<?= $d['id_perusahaan'] ?> "><?= $d['nama_perusahaan'] ?></option>
                                        <?php endforeach; ?>
                                </select>
                            </div>
                            <?= form_error('pilih_gudang', '<small class="text-danger pl-3">', '</small>') ?>
                            <div class="form-group">
                                <select class="custom-select" id="pilih_gudang" name="pilih_gudang">
                                    <option class="form-control form-control-user" value=""> -- Pilih Gudang -- </option>
                                    <div class="form-control form-control-user" aria-labelledby="pilih_gudang">
                                        <?php foreach ($daftar_gudang as $d) : ?>
                                            <option value="<?= $d['id_gudang'] ?> "><?= $d['nama_gudang'] ?></option>
                                        <?php endforeach; ?>
                                </select>
                            </div> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>