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
         Daftar Harga</div>
     <div class="card-body">
         <div class="table-responsive">
             <table id="tabel" class="table table-striped table-bordered">
                 <thead>
                     <tr>
                         <th>No</th>
                         <th>Nama Barang</th>
                         <th>Merk Barang</th>
                         <th>Harga Jual Umum</th>
                         <th>Harga Jual Lain</th>
                         <th>Boking</th>
                         <th>Total Real Barang</th>
                         <th>Total Barang</th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php $no = 1; ?>
                     <?php foreach ($jual->result() as $j) : ?>
                         <tr>
                             <td><?= $no++; ?></td>
                             <td><?= $j->nama_barang ?></td>
                             <td><?= $j->merk_barang ?></td>
                             <td>Rp<?= number_format($j->harga_jual_stok, 0, ',', '.') ?></td>
                             <td>Rp<?= number_format($j->harga_jual_lain, 0, ',', '.') ?></td>
                             <td>
                                 <?php if (empty($tbokingbarang)) : ?>
                                     0
                                 <?php endif; ?>
                                 <?php foreach ($tbokingbarang as $b9) : ?>
                                     <?php if ($b9['id_barang'] == $j->id_barang) : ?>
                                         <?= $b9['qty_boking'] ?>
                                     <?php endif; ?>
                                 <?php endforeach; ?>
                             </td>

                             <td><?= $j->total_barang ?> </td>
                             <td>
                                 <?php if (empty($tbokingbarang)) : ?>
                                     <?= $j->total_barang ?>
                                 <?php endif; ?>
                                 <?php foreach ($tbokingbarang as $b10) : ?>
                                     <?php if ($b10['id_barang'] == $j->id_barang) : ?>
                                         <?= $b10['total_barang'] - $b10['qty_boking']  ?>
                                     <?php endif; ?>
                                 <?php endforeach; ?>
                             </td>
                         </tr>
                     <?php endforeach; ?>
                 </tbody>
                 <tfoot>
                     <tr>
                         <th></th>
                         <th>Nama Barang</th>
                         <th>Merk Barang</th>
                         <th>Harga Jual Umum</th>
                         <th>Harga Jual Lain</th>
                         <th>Boking</th>
                         <th>Total Real Barang</th>
                         <th>Total Barang</th>
                     </tr>
                 </tfoot>
             </table>
         </div>
     </div>
 </div>