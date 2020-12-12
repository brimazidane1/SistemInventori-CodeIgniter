<div id="wrapper">

    <ul class="sidebar navbar-nav">

        <?php if ($title == "Daftar Barang") : ?>
            <li class="nav-item active">
            <?php else : ?>
            <li class="nav-item">
            <?php endif; ?>
            <a class="nav-link" href="<?= base_url('admin/barang1'); ?>">
                <i class="fas fa-tools"></i>
                <span>Daftar Barang</span></a>
            </li>

            <?php if ($title == "Daftar Boking") :  ?>
                <li class="nav-item active">
                <?php else : ?>
                <li class="nav-item">
                <?php endif; ?>
                <a class="nav-link" href="<?= base_url('admin/boking1'); ?>">
                    <i class="fas fa-hand-holding"></i>
                    <span>Daftar Boking</span></a>
                </li>

                <?php if ($title == "Daftar Harga") :  ?>
                    <li class="nav-item active">
                    <?php else : ?>
                    <li class="nav-item">
                    <?php endif; ?>
                    <a class="nav-link" href="<?= base_url('admin/jual1'); ?>">
                        <i class="fas fa-clipboard-list"></i>
                        <span>Daftar Harga</span></a>
                    </li>
    </ul>

    <div id="content-wrapper">

        <div class="container-fluid">