<div id="wrapper">

    <ul class="sidebar navbar-nav">

        <?php if ($title == "Daftar Barang") : ?>
            <li class="nav-item active">
            <?php else : ?>
            <li class="nav-item">
            <?php endif; ?>
            <a class="nav-link" href="<?= base_url('sadmin/barang'); ?>">
                <i class="fas fa-tools"></i>
                <span>Daftar Barang</span></a>
            </li>

            <?php if ($title == "Stok Barang") :  ?>
                <li class="nav-item active">
                <?php else : ?>
                <li class="nav-item">
                <?php endif; ?>
                <a class="nav-link" href="<?= base_url('sadmin/kartu'); ?>">
                    <i class="fas fa-stream"></i>
                    <span>Stok Barang</span></a>
                </li>

                <?php if ($title == "Daftar Boking") :  ?>
                    <li class="nav-item active">
                    <?php else : ?>
                    <li class="nav-item">
                    <?php endif; ?>
                    <a class="nav-link" href="<?= base_url('sadmin/boking'); ?>">
                        <i class="fas fa-hand-holding"></i>
                        <span>Daftar Boking</span></a>
                    </li>

                    <?php if ($title == "Daftar Harga") :  ?>
                        <li class="nav-item active">
                        <?php else : ?>
                        <li class="nav-item">
                        <?php endif; ?>
                        <a class="nav-link" href="<?= base_url('sadmin/jual'); ?>">
                            <i class="fas fa-clipboard-list"></i>
                            <span>Daftar Harga</span></a>
                        </li>

                        <?php if ($title == "Kelola Super Admin") :  ?>
                            <li class="nav-item active">
                            <?php else : ?>
                            <li class="nav-item">
                            <?php endif; ?>
                            <a class="nav-link" href="<?= base_url('sadmin/kelola_sadmin'); ?>">
                                <i class="fas fa-user-tie"></i>
                                <span>Kelola Super Admin</span></a>
                            </li>

                            <?php if ($title == "Kelola Admin") :  ?>
                                <li class="nav-item active">
                                <?php else : ?>
                                <li class="nav-item">
                                <?php endif; ?>
                                <a class="nav-link" href="<?= base_url('sadmin/kelola_admin'); ?>">
                                    <i class="fas fa-user-tie"></i>
                                    <span>Kelola Admin</span></a>
                                </li>

                                <?php if ($title == "Kelola Pegawai") :  ?>
                                    <li class="nav-item active">
                                    <?php else : ?>
                                    <li class="nav-item">
                                    <?php endif; ?>
                                    <a class="nav-link" href="<?= base_url('sadmin/kelola_pegawai'); ?>">
                                        <i class="fas fa-user"></i>
                                        <span>Kelola Pegawai</span></a>
                                    </li>
    </ul>

    <div id="content-wrapper">

        <div class="container-fluid">