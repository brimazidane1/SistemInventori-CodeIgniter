<div id="wrapper">

    <ul class="sidebar navbar-nav">

        <?php if ($title == "Daftar Barang") : ?>
            <li class="nav-item active">
            <?php else : ?>
            <li class="nav-item">
            <?php endif; ?>
            <a class="nav-link" href="<?= base_url('pegawai/barang'); ?>">
                <i class="fas fa-tools"></i>
                <span>Daftar Barang</span></a>
            </li>

            <?php if ($title == "Daftar Harga") : ?>
                <li class="nav-item active">
                <?php else : ?>
                <li class="nav-item">
                <?php endif; ?>
                <a class="nav-link" href="<?= base_url('pegawai/jual'); ?>">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Daftar Harga</span></a>
                </li>
    </ul>

    <div id="content-wrapper">

        <div class="container-fluid">