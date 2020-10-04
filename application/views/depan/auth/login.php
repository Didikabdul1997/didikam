<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Welcome To Didikam</title>
    <!-- MDB icon -->
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url(); ?>material/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>material/css/mdb.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>material/css/style.css">
</head>
</head>

<style type="text/css">
    html,
    body,
    header,
    .container {
        height: 100%;
    }

    #body {
        background: url("https://mdbootstrap.com/img/Photos/Horizontal/Nature/full%20page/img%20%283%29.jpg")no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
</style>

<body id="body">
    <main class="mt-5">
        <div class="container">
            <!--Section: Best Features-->
            <section class="text-center d-flex justify-content-center">
                <!-- Default form login -->
                <div class="col-md-5">
                    <!-- Material form subscription -->
                    <div class="card mt-5">

                        <h5 class="card-header info-color white-text text-center py-4">
                            <strong>Admin Login</strong>
                        </h5>

                        <!--Card content-->
                        <div class="card-body px-lg-5 shadow">

                            <!-- Form -->
                            <form class="text-center" style="color: #757575;" action="#!">

                                <p>Silahkan Login Dibawah !!</p>
                                <br>
                                <div class="md-form mt-3">
                                    <input type="email" id="email" class="form-control">
                                    <label for="email">Username / Email Address</label>
                                </div>
                                <div class="md-form">
                                    <input type="password" id="password" class="form-control">
                                    <label for="password">Password</label>
                                </div>
                                <button class="btn btn-info btn-rounded btn-block z-depth-0 my-4 waves-effect" type="submit"><b class="mr-1">Login</b> <b class="fas fa-sign-in-alt"></b></button>
                                <a href="<?= base_url(); ?>" class="text-info"><i class="fas fa-arrow-left"></i> <u>Home</u></a>
                            </form>
                            <!-- Form -->

                        </div>

                    </div>
                    <!-- Material form subscription -->
                </div>
                <!-- Default form login -->
            </section>
            <!--Section: Best Features-->
        </div>
    </main>
    <!--Main layout-->

</body>
<script type="text/javascript" src="<?= base_url(); ?>material/js/jquery.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>material/js/popper.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>material/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>material/js/mdb.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js"></script>
</script>
<script type="text/javascript">
    const observer = lozad('.lozad', {
        rootMargin: '10px 0px', // syntax similar to that of CSS Margin
        threshold: 0.1, // ratio of element convergence
        enableAutoReload: true // it will reload the new image when validating attributes changes
    });
    observer.observe();
    $('#body').append(`
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    `);
    $('#intro').css('background', 'url("https://mdbootstrap.com/img/Photos/Horizontal/Nature/full%20page/img%20%283%29.jpg")no-repeat');
    $('.carousel').carousel({
        interval: 3000,
    })
</script>
</body>

</html>