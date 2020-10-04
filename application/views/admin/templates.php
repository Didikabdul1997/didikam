<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title; ?></title>
    <link rel="icon" href="/assets/images/icons/d.png" type="image/x-icon">
    <!-- plugins:css -->
    <link rel="stylesheet" href="/material/admin/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/material/admin/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="/material/admin/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="/material/admin/vendors/jvectormap/jquery-jvectormap.css">
    <!-- End plugin css for this page -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="/material/admin/css/demo/style.css">
    <script type="text/javascript" src="/material/js/jquery.min.js"></script>
    <script type="text/javascript" src="/material/js/bootstrap.min.js"></script>
</head>

<body>
    <script src="/material/admin/js/preloader.js"></script>
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
    <script src="/material/admin/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <script src="/material/admin/vendors/chartjs/Chart.min.js"></script>
    <script src="/material/admin/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="/material/admin/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="/material/admin/js/material.js"></script>
    <script src="/material/admin/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="/material/admin/js/dashboard.js"></script>
    <!-- End custom js for this page-->
</body>

</html>