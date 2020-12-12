<!-- Breadcrumbs-->
<ol class=" breadcrumb">
    <li class="breadcrumb-item active">
        <a href="<?= base_url('admin/perusahaan'); ?>">Perusahaan</a>
    </li>
    <li class="breadcrumb-item active"><?= $perusahaan['nama_perusahaan'] ?></li>
    <li class="breadcrumb-item active"><?= $gudang['nama_gudang'] ?></li>
</ol>
<?= $this->session->flashdata('tes'); ?>

<!-- Content -->
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Daftar Barang</div>
    <div class="card-body">
        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#tambahBarangModal">Tambah Barang</a><br><br>
        <div class="table-responsive">
            <table id="tabel" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Merk</th>
                        <th>Nama</th>
                        <th>Product Type</th>
                        <th>ID</th>
                        <th>OD</th>
                        <th>Thick</th>
                        <th>Weight</th>
                        <th>Total Barang</th>
                        <th>Barcode</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($barang as $b) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $b['kode_barang'] ?></td>
                            <td><?= $b['merk_barang'] ?></td>
                            <td><?= $b['nama_barang'] ?></td>
                            <td><?= $b['product_type_barang'] ?></td>
                            <td><?= $b['ID'] ?></td>
                            <td><?= $b['OD'] ?></td>
                            <td><?= $b['thick_barang'] ?></td>
                            <td><?= $b['weight_barang'] ?></td>
                            <td><?= $b['total_barang'] ?></td>
                            <td><img src="<?php echo site_url('admin/Barcode/' . $b['barcode_barang']); ?>"></td>
                            <td>
                                <a href="" class="btn btn-primary" data-toggle="modal" data-target="#editBarangModal<?= $b['id_barang']; ?>">Edit</a>
                                <a href="<?= base_url('admin/hapus_barang/' . $b['id_barang']); ?>" class="btn btn-primary">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th>Kode</th>
                        <th>Merk</th>
                        <th>Nama</th>
                        <th>Product Type</th>
                        <th>ID</th>
                        <th>OD</th>
                        <th>Thick</th>
                        <th>Weight</th>
                        <th>Total Barang</th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- Modal Edit Barang -->
<?php foreach ($barang as $b) : ?>
    <div class="modal fade" id="editBarangModal<?= $b['id_barang']; ?>" tabindex="-1" role="dialog" aria-labelledby="editBarangModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBarangModalLabel">Edit Data Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/edit_barang'); ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id_barang" value="<?= $b['id_barang'] ?>">
                        <?= form_error('kode_barang', ' <p class="text-danger">', '</p>'); ?>
                        <div class="form-group">
                            <h7>Kode Barang: </h7><input type="text" class="form-control" id="kode_barang" name="kode_barang" placeholder="Kode Barang" value="<?= $b['kode_barang'] ?>">
                        </div>
                        <?= form_error('merk_barang', ' <p class="text-danger">', '</p>'); ?>
                        <div class="form-group">
                            <h7>Merk Barang: </h7><input type="text" class="form-control" id="merk_barang" name="merk_barang" placeholder="Merk Barang" value="<?= $b['merk_barang'] ?>">
                        </div>
                        <?= form_error('nama_barang', ' <p class="text-danger">', '</p>'); ?>
                        <div class="form-group">
                            <h7>Nama Barang: </h7><input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Nama Barang" value="<?= $b['nama_barang'] ?>">
                        </div>
                        <?= form_error('product_type_barang', ' <p class="text-danger">', '</p>'); ?>
                        <div class="form-group">
                            <h7>Product Type: </h7><input type="text" class="form-control" id="product_type_barang" name="product_type_barang" placeholder="Product Type Barang" value="<?= $b['product_type_barang'] ?>">
                        </div>
                        <?= form_error('ID', ' <p class="text-danger">', '</p>'); ?>
                        <div class="form-group">
                            <h7>ID: </h7><input type="text" class="form-control" id="ID" name="ID" placeholder="ID" value="<?= $b['ID'] ?> ">
                        </div>
                        <?= form_error('OD', ' <p class="text-danger">', '</p>'); ?>
                        <div class="form-group">
                            <h7>OD: </h7><input type="text" class="form-control" id="OD" name="OD" placeholder="OD" value="<?= $b['OD'] ?> ">
                        </div>
                        <?= form_error('thick_barang', ' <p class="text-danger">', '</p>'); ?>
                        <div class="form-group">
                            <h7>Thick: </h7><input type="text" class="form-control" id="thick_barang" name="thick_barang" placeholder="Thick Barang" value="<?= $b['thick_barang'] ?>">
                        </div>
                        <?= form_error('weight_barang', ' <p class="text-danger">', '</p>'); ?>
                        <div class="form-group">
                            <h7>Weight: </h7><input type="text" class="form-control" id="weight_barang" name="weight_barang" placeholder="Weight Barang" value="<?= $b['weight_barang'] ?>">
                        </div>
                        <?= form_error('barcode_barang', ' <p class="text-danger">', '</p>'); ?>
                        <div class="form-group">
                            <h7>Barcode: </h7><input type="text" class="form-control" id="barcode_barang" name="barcode_barang" placeholder="Barcode Barang" value="<?= $b['barcode_barang'] ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Tambah Barang -->
<div class="modal fade" id="tambahBarangModal" tabindex="-1" role="dialog" aria-labelledby="tambahBarangModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahBarangModalLabel">Tambah Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/barang'); ?>" method="post">
                <div class="modal-body">
                    <?= form_error('kode_barang', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <input type="text" class="form-control" id="kode_barang" name="kode_barang" placeholder="Kode Barang">
                    </div>
                    <?= form_error('merk_barang', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <input type="text" class="form-control" id="merk_barang" name="merk_barang" placeholder="Merk Barang">
                    </div>
                    <?= form_error('nama_barang', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Nama Barang">
                    </div>
                    <?= form_error('product_type_barang', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <input type="text" class="form-control" id="product_type_barang" name="product_type_barang" placeholder="Product Type Barang">
                    </div>
                    <?= form_error('ID', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <input type="text" class="form-control" id="ID" name="ID" placeholder="ID">
                    </div>
                    <?= form_error('OD', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <input type="text" class="form-control" id="OD" name="OD" placeholder="OD">
                    </div>
                    <?= form_error('thick_barang', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <input type="text" class="form-control" id="thick_barang" name="thick_barang" placeholder="Thick Barang">
                    </div>
                    <?= form_error('weight_barang', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <input type="text" class="form-control" id="weight_barang" name="weight_barang" placeholder="Weight Barang">
                    </div>
                    <?= form_error('barcode_barang', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <input type="text" class="form-control" id="barcode_barang" name="barcode_barang" placeholder="Barcode Barang">
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