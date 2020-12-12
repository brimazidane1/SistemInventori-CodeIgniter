<div id="wrapper">

    <ul class="sidebar navbar-nav" id="opoiki">

        <?php if ($title == "Daftar Barang") : ?>
            <li class="nav-item active">
            <?php else : ?>
            <li class="nav-item">
            <?php endif; ?>
            <a class="nav-link" href="<?= base_url('admin/barang'); ?>">
                <i class="fas fa-tools"></i>
                <span>Daftar Barang</span></a>
            </li>

            <?php if ($title == "Stok Barang") :  ?>
                <li class="nav-item active">
                <?php else : ?>
                <li class="nav-item">
                <?php endif; ?>
                <a class="nav-link" href="<?= base_url('admin/kartu'); ?>">
                    <i class="fas fa-stream"></i>
                    <span>Stok Barang</span></a>
                </li>

                <?php if ($title == "Daftar Boking") :  ?>
                    <li class="nav-item active">
                    <?php else : ?>
                    <li class="nav-item">
                    <?php endif; ?>
                    <a class="nav-link" href="<?= base_url('admin/boking'); ?>">
                        <i class="fas fa-hand-holding"></i>
                        <span>Daftar Boking</span></a>
                    </li>

                    <?php if ($title == "Daftar Harga") :  ?>
                        <li class="nav-item active">
                        <?php else : ?>
                        <li class="nav-item">
                        <?php endif; ?>
                        <a class="nav-link" href="<?= base_url('admin/jual'); ?>">
                            <i class="fas fa-clipboard-list"></i>
                            <span>Daftar Harga</span></a>
                        </li>
    </ul>

    <div id="content-wrapper">

        <div class="container-fluid">