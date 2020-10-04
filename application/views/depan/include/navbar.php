<nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
    <div class="container px-4">
        <a class="navbar-brand" href="<?= base_url(); ?>">
            <img src="<?= base_url(); ?>/assets/img/brand/sipakar-white.png" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="<?= base_url(); ?>">
                            <img src="<?= base_url(); ?>/assets/img/brand/sipakar.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Navbar items -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="<?= base_url(); ?>">
                        <i class="ni ni-planet"></i>
                        <span class="nav-link-inner--text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="<?= base_url('home/about'); ?>">
                        <i class="ni ni-single-02"></i>
                        <span class="nav-link-inner--text">About</span>
                    </a>
                </li>
                <?php if ($this->session->userdata('email')) : ?>
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="<?= base_url('konsultasi'); ?>">
                            <i class="fas fa-book-reader"></i>
                            <span class="nav-link-inner--text">Konsultasi</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="<?= base_url('auth/logout'); ?>">
                            <i class="ni ni-user-run"></i>
                            <span class="nav-link-inner--text">Logout</span>
                        </a>
                    </li>
                    <li class="nav-item mt--2">
                        <a href="<?= base_url('auth'); ?>" class="nav-link nav-link-icon">
                            <span class="nav-link-inner--text avatar avatar-sm rounded-circle">
                                <img alt="Image placeholder" src="<?= base_url('assets/img/profile/') . $this->session->userdata('image'); ?>">
                            </span>
                        </a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="<?= base_url('auth'); ?>">
                            <i class="ni ni-key-25"></i>
                            <span class="nav-link-inner--text">Login</span>
                        </a>
                    </li>
                <?php endif ?>
            </ul>
        </div>
    </div>
</nav>