        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">
                <a href="<?= base_url('admin/perusahaan'); ?>">Perusahaan</a>
            </li>
            <li class="breadcrumb-item active"> <?= $perusahaan['nama_perusahaan'] ?></li>
            <li class="breadcrumb-item active"><?= $gudang['nama_gudang'] ?></li>
        </ol>
        <?= $this->session->flashdata('tes'); ?>

        <!-- Content -->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Daftar Barang</div>
            <div class="card-body">
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
                                <th>Barcode</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>