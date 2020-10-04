<footer class="py-5">
    <div class="container">
        <div class="row align-items-center justify-content-xl-between">
            <div class="col-xl-6">
                <div class="copyright text-center text-xl-left text-muted">
                    &copy; <?= date('Y'); ?> <a class="font-weight-bold ml-1">Dirodev</a>
                </div>
            </div>
            <div class="col-xl-6">
                <ul class="nav nav-footer justify-content-center justify-content-xl-end">
                    <li class="nav-item">
                        <a href="<?= base_url(); ?>" class="nav-link">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('home/about'); ?>" class="nav-link">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('auth'); ?>" class="nav-link">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>