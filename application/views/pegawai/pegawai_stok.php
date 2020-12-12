<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item active"> <?= $perusahaan['nama_perusahaan'] ?></li>
</ol>

<!-- Content -->
<div class="card mb-3">
    <div class="card-header"><i class="fas fa-table"></i> Stok Barang:</div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="tabel" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID Stok</th>
                        <th>Kode Barang</th>
                        <th>Gudang</th>
                        <th>Nama Barang</th>
                        <th>Tanggal</th>
                        <th>No PO</th>
                        <th>No Reg</th>
                        <th>Masuk</th>
                        <th>Keluar</th>
                        <th>Sisa</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Status</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($stok as $s) : ?>
                        <tr>
                            <td><?= $s['id_stok'] ?></td>
                            <td><?= $s['kode_barang'] ?></td>
                            <?php if ($s['id_gudang'] == 3) : ?>
                                <td>
                                    Pekanbaru
                                </td>
                            <?php else : ?>
                                <td>
                                    Padang
                                </td>
                            <?php endif; ?>
                            </td>
                            <td><?= $s['nama_barang'] ?></td>
                            <td><?= $s['tanggal_stok'] ?></td>
                            <td><?= $s['nopo_stok'] ?></td>
                            <td><?= $s['noreg_stok'] ?></td>
                            <td><?= $s['masuk_stok'] ?></td>
                            <td><?= $s['keluar_stok'] ?></td>
                            <td><?= $s['masuk_stok'] - $s['keluar_stok'] ?></td>
                            <td><?= $s['harga_beli_stok'] ?></td>
                            <td><?= $s['harga_jual_stok'] ?></td>
                            <?php if ($s['approve_stok'] == 0) : ?>
                                <td>
                                    <p class="text-danger">Not Approved</p>
                                </td>
                            <?php else : ?>
                                <td>
                                    <p class="text-success">Approved</p>
                                </td>
                            <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>