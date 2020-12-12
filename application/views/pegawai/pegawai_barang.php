<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item active">
        <a href="<?= base_url('pegawai/perusahaan'); ?>">Perusahaan</a>
    </li>
    <li class="breadcrumb-item active"> <?= $perusahaan['nama_perusahaan'] ?></li>

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
                        <th>Merk</th>
                        <th>Nama</th>
                        <th>Product Type</th>
                        <th>ID</th>
                        <th>OD</th>
                        <th>Thick</th>
                        <th>Weight</th>
                        <th>Total Barang Pekan</th>
                        <th>Total Boking Pekan</th>
                        <th>Total Akhir Pekan</th>
                        <th>Total Barang Padang</th>
                        <th>Total Boking Padang</th>
                        <th>Total Akhir Padang</th>
                        <th>Total Akhir Barang</th>
                        <th>Total Real Barang</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($barang as $b) : ?>
                        <?php
                            $totalpekan = 0;
                            $awalpadang = 0;
                            $totalpadang = 0; ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <input type="hidden" name="kode_barang" value="<?= $b['kode_barang'] ?>">
                            <td><?= $b['merk_barang'] ?></td>
                            <td><?= $b['nama_barang'] ?></td>
                            <td><?= $b['product_type_barang'] ?></td>
                            <td><?= $b['ID'] ?></td>
                            <td><?= $b['OD'] ?></td>
                            <td><?= $b['thick_barang'] ?></td>
                            <td><?= $b['weight_barang'] ?></td>
                            <td>
                                <?php if (empty($totalbarangpekan)) : ?>
                                    0
                                <?php endif; ?>
                                <?php foreach ($totalbarangpekan as $b1) : ?>
                                    <?php if ($b1['kode_barang'] == $b['kode_barang']) : ?>
                                        <?= $b1['total_barang'] ?>
                                    <?php elseif ($b1['kode_barang'] != $b['kode_barang']) : ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </td>

                            <td>
                                <?php if (empty($tbokingbarangpekan)) : ?>
                                    0
                                <?php endif; ?>
                                <?php foreach ($tbokingbarangpekan as $b2) : ?>
                                    <?php if ($b2['kode_barang'] == $b['kode_barang']) : ?>
                                        <?= $b2['qty_boking'] ?>
                                    <?php elseif ($b2['kode_barang'] !=  $b['kode_barang'] && $b2['kode_barang'] == null) : ?>
                                        dua
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </td>

                            <td>
                                <?php if (empty($totalakhirpekan)) : ?>
                                    0
                                <?php endif; ?>
                                <?php foreach ($totalakhirpekan as $b3) : ?>
                                    <?php if ($b3['kode_barang'] == $b['kode_barang']) : ?>
                                        <?= $b3['total_barang'] - $b3['qty_boking'] ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </td>

                            <td>
                                <?php if (empty($totalbarangpadang)) : ?>
                                    0
                                <?php endif; ?>
                                <?php foreach ($totalbarangpadang as $b4) : ?>
                                    <?php if ($b4['kode_barang'] == $b['kode_barang']) : ?>
                                        <?= $b4['total_barang'] ?>
                                    <?php elseif ($b4['kode_barang'] != $b['kode_barang']) : ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </td>

                            <td>
                                <?php if (empty($tbokingbarangpadang)) : ?>
                                    0
                                <?php endif; ?>
                                <?php foreach ($tbokingbarangpadang as $b5) : ?>
                                    <?php if ($b5['kode_barang'] == $b['kode_barang']) : ?>
                                        <?= $b5['qty_boking'] ?>
                                    <?php elseif ($b5['kode_barang'] !=  $b['kode_barang'] && $b5['kode_barang'] == null) : ?>
                                        dua
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </td>

                            <td>
                                <?php if (empty($totalakhirpadang)) : ?>
                                    0
                                <?php endif; ?>
                                <?php foreach ($totalakhirpadang as $b6) : ?>
                                    <?php if ($b6['kode_barang'] == $b['kode_barang']) : ?>
                                        <?= $b6['total_barang'] - $b6['qty_boking'] ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </td>

                            <td>
                                <?php if (empty($total)) : ?>
                                    0
                                <?php endif; ?>
                                <?php foreach ($total as $b7) : ?>
                                    <?php if ($b7['kode_barang'] == $b['kode_barang']) : ?>
                                        <?= $b['total_barang'] - $b7['qty_boking'] ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </td>

                            <td> <?= $b['total_barang'] ?> </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th>Merk</th>
                        <th>Nama</th>
                        <th>Product Type</th>
                        <th>ID</th>
                        <th>OD</th>
                        <th>Thick</th>
                        <th>Weight</th>
                        <th>Total Barang Pekan</th>
                        <th>Total Boking Pekan</th>
                        <th>Total Akhir Pekan</th>
                        <th>Total Barang Padang</th>
                        <th>Total Boking Padang</th>
                        <th>Total Akhir Padang</th>
                        <th>Total Akhir Barang</th>
                        <th>Total Real Barang</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>