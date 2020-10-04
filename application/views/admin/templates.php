<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title; ?></title>
    <link rel="icon" href="<?= base_url(); ?>assets/images/icons/d.png" type="image/x-icon">
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url(); ?>material/admin/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>material/admin/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?= base_url(); ?>material/admin/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>material/admin/vendors/jvectormap/jquery-jvectormap.css">
    <!-- End plugin css for this page -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?= base_url(); ?>material/admin/css/demo/style.css">
</head>

<body>
    <script src="<?= base_url(); ?>material/admin/js/preloader.js"></script>
    <div class="body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php $this->load->view('admin/include/sidebar'); ?>
        <!-- partial -->
        <div class="main-wrapper mdc-drawer-app-content">
            <!-- partial:partials/_navbar.html -->
            <?php $this->load->view('admin/include/navbar'); ?>
            <!-- partial -->
            <div class="page-wrapper mdc-toolbar-fixed-adjust">
                <?php $this->load->view($page); ?>
                <?php $this->load->view('admin/include/footer'); ?>
            </div>
        </div>
    </div>
    <!-- plugins:js -->
    <script src="<?= base_url(); ?>material/admin/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <script src="<?= base_url(); ?>material/admin/vendors/chartjs/Chart.min.js"></script>
    <script src="<?= base_url(); ?>material/admin/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="<?= base_url(); ?>material/admin/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="<?= base_url(); ?>material/admin/js/material.js"></script>
    <script src="<?= base_url(); ?>material/admin/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="<?= base_url(); ?>material/admin/js/dashboard.js"></script>
    <!-- End custom js for this page-->
</body>

</html>