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
    <div class="card-header"><i class="fas fa-table"></i> Stok Barang: <b> <?= $ambil_barang['total_barang'] ?> </b></div>
    <div class="card-body">
        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#tambahStokModal">Update Masuk</a>
        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#keluarStokModal">Update Keluar</a><br><br>
        <div class="table-responsive">
            <table id="tabel" class="table table-hover table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Tanggal</th>
                        <th>No PO</th>
                        <th>No Reg</th>
                        <th>Qty Masuk</th>
                        <th>Qty Keluar</th>
                        <th>Sisa Qty</th>
                        <th>Harga Modal Dollar</th>
                        <th>Harga Modal Rupiah</th>
                        <th>Total Harga Modal</th>
                        <th>Harga Ongkos</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Harga Jual Lain</th>
                        <th>Lokasi</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0; ?>
                    <?php $awal = 0;
                    $total = 0; ?>
                    <?php foreach ($stok as $s) : ?>
                        <tr>
                            <td><?= ++$no; ?></td>
                            <input type="hidden" name="id_barang" value="<?= $s['id_barang'] ?>">
                            <td><?= $s['kode_barang'] ?></td>
                            <td><?= $s['nama_barang'] ?></td>
                            <td><?= $s['tanggal_stok'] ?></td>
                            <td><?= $s['nopo_stok'] ?></td>
                            <td><?= $s['noreg_stok'] ?></td>
                            <td><?= $s['masuk_stok'] ?></td>
                            <td><?= $s['keluar_stok'] ?></td>
                            <td>
                                <?php if ($no == 1) : ?>
                                    <?php $total = $awal + $s['masuk_stok'] - $s['keluar_stok']; ?>
                                    <?= $total ?>
                                    <?php $awal = $total; ?>
                                <?php else : ?>
                                    <?php $total = $awal + $s['masuk_stok'] - $s['keluar_stok']; ?>
                                    <?php if ($total < 0) : ?>
                                        <p class="text-danger">Stock Opname!!</p>
                                    <?php else : ?>
                                        <?= $total ?>
                                        <?php $awal = $total; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                            <!-- Modal Dollar -->
                            <td>USD <?= $s['harga_beli_stok']  ?></td>
                            <!-- Modal Rupiah -->
                            <td>Rp<?= $s['harga_modal_rupiah'] ?></td>
                            <!-- Total Modal -->
                            <td>Rp<?= number_format($s['harga_beli_stok'] * $s['harga_modal_rupiah'], 0, ',', '.') ?></td>
                            <!-- Ongkos -->
                            <td>Rp<?= number_format($s['harga_ongkos'], 0, ',', '.') ?></td>
                            <!-- Harga Beli -->
                            <td>Rp<?= number_format(($s['harga_beli_stok'] * $s['harga_modal_rupiah']) + $s['harga_ongkos'], 0, ',', '.') ?></td>
                            <td>Rp<?= number_format($s['harga_jual_stok'], 0, ',', '.') ?></td>
                            <td>Rp<?= number_format($s['harga_jual_lain'], 0, ',', '.') ?></td>
                            <td><?= $s['lokasi_stok'] ?></td>
                            <td><?= $s['keterangan'] ?></td>
                            <?php if ($s['approve_stok'] == 0) : ?>
                                <td>
                                    <p class="text-danger">Not Approved</p>
                                </td>
                            <?php else : ?>
                                <td>
                                    <p class="text-success">Approved</p>
                                </td>
                            <?php endif; ?>
                            <td>
                                <a href="" class="btn btn-primary" data-toggle="modal" data-target="#editStokModal<?= $s['id_stok']; ?>">Edit</a>
                                <a href="<?= base_url('sadmin/hapus_stok/' . $s['id_barang'] . '/' .  $s['id_stok']); ?>" class="btn btn-primary">Hapus</a>
                                <a href="<?php echo site_url("sadmin/print_stok/" . $s['id_stok'] . '/' . $s['merk_barang'] . '/' . $s['nama_barang'] . '/' . $s['tanggal_stok']) ?>" class="btn btn-danger">Print</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Tanggal</th>
                        <th>No PO</th>
                        <th>No Reg</th>
                        <th>Qty Masuk</th>
                        <th>Qty Keluar</th>
                        <th>Sisa Qty</th>
                        <th>Harga Modal Dollar</th>
                        <th>Harga Modal Rupiah</th>
                        <th>Harga Modal</th>
                        <th>Harga Ongkos</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Harga Jual Lain</th>
                        <th>Lokasi</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- Modal Edit Stok -->
<?php foreach ($stok as $s) : ?>
    <div class="modal fade" id="editStokModal<?= $s['id_stok']; ?>" tabindex="-1" role="dialog" aria-labelledby="editStokModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editStokModalLabel">Edit Stok</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('sadmin/edit_stok'); ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id_stok" value="<?= $s['id_stok'] ?>">
                        <h6>Nama Barang: <?= $ambil_barang['nama_barang'] . ' ' . $ambil_barang['merk_barang']; ?></h6>
                        <input type="hidden" name="id_barang" value="<?= $s['id_barang'] ?>">

                        <?= form_error('tanggal_stok', ' <p class="text-danger">', '</p>'); ?>
                        <div class="form-group">
                            <h7>Tanggal: </h7><input type="date" class="form-control" id="tanggal_stok" name="tanggal_stok" value="<?= $s['tanggal_stok'] ?>">
                        </div>
                        <?= form_error('nopo_stok', ' <p class="text-danger">', '</p>'); ?>
                        <div class="form-group">
                            <h7>No. PO: </h7><input type="text" class="form-control" id="nopo_stok" name="nopo_stok" placeholder="No. Po" value="<?= $s['nopo_stok'] ?>">
                        </div>
                        <?= form_error('noreg_stok', ' <p class="text-danger">', '</p>'); ?>
                        <div class="form-group">
                            <h7>No. Reg: </h7><input type="text" class="form-control" id="noreg_stok" name="noreg_stok" placeholder="No. Reg" value="<?= $s['noreg_stok'] ?>">
                        </div>
                        <?= form_error('masuk_stok', ' <p class="text-danger">', '</p>'); ?>
                        <div class="form-group">
                            <h7>Qty Masuk: </h7><input type="text" class="form-control" id="masuk_stok" name="masuk_stok" placeholder="Qty Masuk" value="<?= $s['masuk_stok'] ?>">
                        </div>
                        <?= form_error('keluar_stok', ' <p class="text-danger">', '</p>'); ?>
                        <div class="form-group">
                            <h7>Qty Keluar: </h7><input type="text" class="form-control" id="keluar_stok" name="keluar_stok" placeholder="Qty Keluar" value="<?= $s['keluar_stok'] ?>">
                        </div>
                        <?= form_error('harga_beli_stok', ' <p class="text-danger">', '</p>'); ?>
                        <div class="form-group">
                            <h7>Harga Modal Dollar: </h7><input type="text" class="form-control" id="harga_beli_stok" name="harga_beli_stok" placeholder="Harga Modal Dollar" value="<?= $s['harga_beli_stok'] ?>">
                        </div>
                        <?= form_error('harga_modal_rupiah', ' <p class="text-danger">', '</p>'); ?>
                        <div class="form-group">
                            <h7>Harga Modal Rupiah: </h7><input type="text" class="form-control" id="harga_modal_rupiah" name="harga_modal_rupiah" placeholder="Harga Modal Rupiah" value="<?= $s['harga_modal_rupiah'] ?>">
                        </div>
                        <?= form_error('harga_ongkos', ' <p class="text-danger">', '</p>'); ?>
                        <div class="form-group">
                            <h7>Harga Ongkos: </h7><input type="text" class="form-control" id="harga_ongkos" name="harga_ongkos" placeholder="Harga Ongkos" value="<?= $s['harga_ongkos'] ?>">
                        </div>
                        <?= form_error('harga_jual_stok', ' <p class="text-danger">', '</p>'); ?>
                        <div class="form-group">
                            <h7>Harga Jual Umum: </h7> <input type="text" class="form-control" id="harga_jual_stok" name="harga_jual_stok" placeholder="Harga Jual Umum" value="<?= $s['harga_jual_stok'] ?>">
                        </div>
                        <?= form_error('harga_jual_lain', ' <p class="text-danger">', '</p>'); ?>
                        <div class="form-group">
                            <h7>Harga Jual Lain: </h7> <input type="text" class="form-control" id="harga_jual_lain" name="harga_jual_lain" placeholder="Harga Jual Lain" value="<?= $s['harga_jual_lain'] ?>">
                        </div>
                        <?= form_error('lokasi_stok', ' <p class="text-danger">', '</p>'); ?>
                        <div class="form-group">
                            <h7>Lokasi: </h7> <input type="text" class="form-control" id="lokasi_stok" name="lokasi_stok" placeholder="Lokasi Stok" value="<?= $s['lokasi_stok'] ?>">
                        </div>
                        <?= form_error('keterangan', ' <p class="text-danger">', '</p>'); ?>
                        <div class="form-group">
                            <h7>Keterangan: </h7><textarea class="form-control" name="keterangan" placeholder="Keterangan"><?= $s['keterangan'] ?></textarea>
                        </div>
                        <?= form_error('status_stok', '<small class="text-danger pl-3">', '</small>') ?>
                        <div class="form-group">
                            <select class="custom-select" id="status_stok" name="status_stok">

                                <option class="form-control form-control-user" value=""> -- Pilih Status -- </option>
                                <div class="form-control form-control-user" aria-labelledby="status_stok">
                                    <?php if ($s['approve_stok'] == 0) : ?>
                                        <option value=0 selected>Not Approved</option>
                                        <option value=1>Approved</option>
                                    <?php elseif ($s['approve_stok'] == 1) : ?>
                                        <option value=0>Not Approved</option>
                                        <option value=1 selected>Approved</option>
                                    <? endif; ?>
                            </select>

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

<!-- Modal Tambah Stok Masuk -->
<div class="modal fade" id="tambahStokModal" tabindex="-1" role="dialog" aria-labelledby="tambahStokModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahStokModalLabel">Update Stok Masuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="<?= base_url('sadmin/kartu_stok/' . $id_barang); ?>" method="post">
                <div class="modal-body">

                    <h6>Nama Barang: <?= $ambil_barang['nama_barang'] . " " . $ambil_barang['merk_barang']; ?></h6>
                    <input type="hidden" name="id_barang" value="<?= $id_barang; ?>"><br>

                    <?= form_error('tanggal_stok', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <input type="date" class="form-control" id="tanggal_stok" name="tanggal_stok">
                    </div>
                    <?= form_error('nopo_stok', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nopo_stok" name="nopo_stok" placeholder="No. Po">
                    </div>
                    <?= form_error('noreg_stok', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <input type="text" class="form-control" id="noreg_stok" name="noreg_stok" placeholder="No. Reg">
                    </div>
                    <?= form_error('masuk_stok', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <input type="text" class="form-control" id="masuk_stok" name="masuk_stok" placeholder="Qty Masuk">
                    </div>
                    <?= form_error('keluar_stok', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="keluar_stok" name="keluar_stok" value=0>
                    </div>
                    <?= form_error('harga_beli_stok', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <input type="text" class="form-control" id="harga_beli_stok" name="harga_beli_stok" placeholder="Harga Modal Dollar">
                    </div>
                    <?= form_error('harga_modal_rupiah', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <input type="text" class="form-control" id="harga_modal_rupiah" name="harga_modal_rupiah" placeholder="Harga Modal Rupiah">
                    </div>
                    <?= form_error('harga_ongkos', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <input type="text" class="form-control" id="harga_ongkos" name="harga_ongkos" placeholder="Harga Ongkos">
                    </div>
                    <?= form_error('harga_jual_stok', ' <p class="text-danger">', '</p>'); ?>
                    <div class=" form-group">
                        <input type="text" class="form-control" id="harga_jual_stok" name="harga_jual_stok" placeholder="Harga Jual Umum">
                    </div>
                    <?= form_error('harga_jual_lain', ' <p class="text-danger">', '</p>'); ?>
                    <div class=" form-group">
                        <input type="text" class="form-control" id="harga_jual_lain" name="harga_jual_lain" placeholder="Harga Jual Lain">
                    </div>
                    <?= form_error('lokasi_stok', ' <p class="text-danger">', '</p>'); ?>
                    <div class=" form-group">
                        <input type="text" class="form-control" id="lokasi_stok" name="lokasi_stok" placeholder="Lokasi Stok">
                    </div>
                    <?= form_error('keterangan', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Tambah Stok Keluar -->
<div class="modal fade" id="keluarStokModal" tabindex="-1" role="dialog" aria-labelledby="keluarStokModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="keluarStokModal">Update Stok Keluar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="<?= base_url('sadmin/kartu_stok/' . $id_barang); ?>" method="post">
                <div class="modal-body">

                    <h6>Nama Barang: <?= $ambil_barang['nama_barang'] . " " . $ambil_barang['merk_barang']; ?></h6>
                    <input type="hidden" name="id_barang" value="<?= $id_barang; ?>"><br>

                    <?= form_error('tanggal_stok', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <input type="date" class="form-control" id="tanggal_stok" name="tanggal_stok">
                    </div>
                    <?= form_error('nopo_stok', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nopo_stok" name="nopo_stok" placeholder="No. Po">
                    </div>
                    <?= form_error('noreg_stok', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <input type="text" class="form-control" id="noreg_stok" name="noreg_stok" placeholder="No. Reg">
                    </div>
                    <?= form_error('masuk_stok', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="masuk_stok" name="masuk_stok" value=0>
                    </div>
                    <?= form_error('keluar_stok', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <input type="text" class="form-control" id="keluar_stok" name="keluar_stok" placeholder="Qty Keluar">
                    </div>
                    <?= form_error('harga_beli_stok', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="harga_beli_stok" name="harga_beli_stok" value=0>
                    </div>
                    <?= form_error('harga_modal_rupiah', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="harga_modal_rupiah" name="harga_modal_rupiah" value=0>
                    </div>
                    <?= form_error('harga_ongkos', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="harga_ongkos" name="harga_ongkos" value=0>
                    </div>
                    <?= form_error('harga_jual_stok', ' <p class="text-danger">', '</p>'); ?>
                    <div class=" form-group">
                        <input type="text" class="form-control" id="harga_jual_stok" name="harga_jual_stok" placeholder="Harga Jual Barang">
                    </div>
                    <?= form_error('harga_jual_lain', ' <p class="text-danger">', '</p>'); ?>
                    <div class=" form-group">
                        <input type="hidden" class="form-control" id="harga_jual_lain" name="harga_jual_lain" value=0>
                    </div>
                    <?= form_error('lokasi_stok', ' <p class="text-danger">', '</p>'); ?>
                    <div class=" form-group">
                        <input type="text" class="form-control" id="lokasi_stok" name="lokasi_stok" placeholder="Lokasi Stok">
                    </div>
                    <?= form_error('keterangan', ' <p class="text-danger">', '</p>'); ?>
                    <div class="form-group">
                        <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>