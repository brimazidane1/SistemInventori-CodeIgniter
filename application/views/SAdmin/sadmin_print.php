<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Laporan</title>
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .line-title {
            border: 0;
            border-style: inset;
            border-top: 1px solid #000;
        }

        .line-dotted {
            border: 1px;
            border-style: dashed;
        }
    </style>
</head>

<body>
    <img src="assets/img/logo.jpg" style="position: absolute; width: 35px; height: auto;">
    <table>
        <tr>
            <td align="center">
                <span style="line-height: 1; font-weight: bold; margin-left:55px;">
                    <?= $perusahaan['nama_perusahaan']; ?>
                    <br>
                    <?= $gudang['nama_gudang']; ?>
                </span>
            </td>
        </tr>
    </table>

    <hr class="line-title">
    <font size="11.5px">
        <table style="width:fit-content">
            <tr>
                <td>Admin</td>
                <td>:</td>
                <td><?= $sa['nama_sa']; ?></td>
            </tr>
            <tr>
                <td>Nama Barang</td>
                <td>:</td>
                <td><?= $stok->merk_barang . ' ' .  $stok->nama_barang; ?></td>
            </tr>
            <tr>
                <td>Kode Barang</td>
                <td>:</td>
                <td><?= $stok->kode_barang; ?></td>
            </tr>
            <tr>
                <td>No Registrasi</td>
                <td>:</td>
                <td><?= $stok->noreg_stok; ?></td>
            </tr>
            <tr>
                <td>Tanggal Stok</td>
                <td>:</td>
                <td><?= $stok->tanggal_stok; ?></td>
            </tr>
            <tr>
                <td>Qty Keluar</td>
                <td>:</td>
                <td><?= $stok->keluar_stok; ?></td>
            </tr>
            <tr>
                <td>Keterangan</td>
                <td>:</td>
                <td><?= $stok->keterangan; ?></td>
            </tr>
            <tr>
                <td>Lokasi</td>
                <td>:</td>
                <td><?= $stok->lokasi_stok; ?></td>
            </tr>
        </table>
    </font>

    <hr class="line-dotted">
    <font size="1">
        <?= date('l, d F Y H:i:s'); ?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        Penerima:
    </font>

</body>

</html>