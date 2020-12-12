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
        Daftar Boking</div>
    <div class="card-body">
        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#tambahBokingModal">Tambah Boking</a><br><br>
        <div class="table-responsive">
            <table id="tabel" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Barang</th>
                        <th>Merk Barang</th>
                        <th>No Surat</th>
                        <th>Pemesan</th>
                        <th>Tanggal</th>
                        <th>Qty</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($boking as $b) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <input type="hidden" name="id_boking" value="<?= $b['id_boking']; ?>">
                            <td><?= $b['nama_barang'] ?></td>
                            <td><?= $b['merk_barang'] ?></td>
                            <td><?= $b['no_surat'] ?></td>
                            <td><?= $b['nama_boking'] ?></td>
                            <td><?= $b['tanggal_boking'] ?></td>
                            <td><?= $b['qty_boking'] ?></td>
                            <td>
                                <?php if ($b['status_boking'] == 0) : ?>
                                    <p class="text-danger">Not Approved</p>
                                <?php else : ?>
                                    <p class="text-success">Approved</p>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?= base_url('sadmin/approved_boking/' . $b['id_boking']); ?>" class="btn btn-primary">Approved</a>
                                <a href="<?= base_url('sadmin/batal_approved_boking/' . $b['id_boking']); ?>" class="btn btn-primary">Batal</a>
                                <a href="<?= base_url('sadmin/hapus_boking/' . $b['id_boking']); ?>" class="btn btn-primary">Hapus</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th>Barang</th>
                        <th>Merk Barang</th>
                        <th>No Surat</th>
                        <th>Pemesan</th>
                        <th>Tanggal</th>
                        <th>Qty</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- Modal Boking -->
<div class="modal fade" id="tambahBokingModal" tabindex="-1" role="dialog" aria-labelledby="tambahBokingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahBokingModalLabel">Tambah Boking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('sadmin/boking'); ?>" method="post">
                <div class="modal-body">
                    <?= form_error('pilih_barang', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <select class="custom-select" id="pilih_barang" name="pilih_barang">
                            <option class="form-control form-control-user" value=""> -- Pilih Barang -- </option>

                            <div class="form-control form-control-user" aria-labelledby="pilih_barang">
                                <?php foreach ($daftar_barang as $b) : ?>
                                    <option value="<?= $b['id_barang'] ?> "><?= $b['nama_barang'] . ' ' . $b['merk_barang'] ?></option>
                                <?php endforeach; ?>
                        </select>
                    </div>
                    <?= form_error('no_surat', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <input type="text" class="form-control" id="no_surat" name="no_surat" placeholder="No Surat">
                    </div>
                    <?= form_error('nama_boking', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_boking" name="nama_boking" placeholder="Nama Pemesan">
                    </div>
                    <?= form_error('tanggal_boking', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <input type="date" class="form-control" id="tanggal_boking" name="tanggal_boking">
                    </div>
                    <?= form_error('qty_boking', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <input type="text" class="form-control" id="qty_boking" name="qty_boking" placeholder="Qty Boking">
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