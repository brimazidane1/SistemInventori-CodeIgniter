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
                Daftar Boking</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tabel" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Barang</th>
                                <th>No Surat</th>
                                <th>Pemesan</th>
                                <th>Tanggal</th>
                                <th>Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($boking as $b) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <input type="hidden" name="id_boking" value="<?= $b['id_boking']; ?>">
                                    <td><?= $b['nama_barang'] ?></td>
                                    <td><?= $b['no_surat'] ?></td>
                                    <td><?= $b['nama_boking'] ?></td>
                                    <td><?= $b['tanggal_boking'] ?></td>
                                    <td><?= $b['qty_boking'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Barang</th>
                                <th>No Surat</th>
                                <th>Pemesan</th>
                                <th>Tanggal</th>
                                <th>Qty</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>