<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/'); ?>css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

    <body class="bg-dark">

        <div class="container">
            <div class="card card-login mx-auto mt-5">
                <?= $this->session->flashdata('tes'); ?>

                <div class="card-body">

                    <form class="user" method="post" action="<?= base_url('sadmin/perusahaan'); ?>">
                        <div class="form-group">
                            <select class="custom-select" id="pilih_perusahaan" name="pilih_perusahaan">
                                <option class="form-control form-control-user" value=""> -- Pilih Perusahaan -- </option>

                                <div class="form-control form-control-user" aria-labelledby="pilih_perusahaan">
                                    <?php foreach ($daftar_perusahaan as $d) : ?>
                                        <option value="<?= $d['id_perusahaan'] ?> "><?= $d['nama_perusahaan'] ?></option>
                                    <?php endforeach; ?>
                            </select>
                            <?= form_error('pilih_perusahaan', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>

                        <div class="form-group">
                            <select class="custom-select" id="pilih_gudang" name="pilih_gudang">
                                <option class="form-control form-control-user" value=""> -- Pilih Gudang -- </option>

                                <div class="form-control form-control-user" aria-labelledby="pilih_gudang">
                                    <?php foreach ($daftar_gudang as $d) : ?>
                                        <option value="<?= $d['id_gudang'] ?> "><?= $d['nama_gudang'] ?></option>
                                    <?php endforeach; ?>
                            </select>
                            <?= form_error('pilih_gudang', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>

                        <button class="btn btn-primary btn-block" type="submit">Cek</button>
                    </form>

                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
        <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

    </body>

</html>