<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>404 Page Not Found</title>
    <link href="/assets/img/icons/app.png" rel="icon" type="image/png">

    <!-- CSS Files -->
    <link href="/assets/css/argon-dashboard.css?v=1.1.2" rel="stylesheet" />
</head>

<body>
    <div class="row justify-content-center mt-7">
        <img src="<?= base_url('assets/img/errors/404.png'); ?>" width="25%" class="justify-text-center" alt="">
    </div>
    <div class="row justify-content-center">
        <h1 class="display-3">Page Not Found</h1>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-4 text-center">
            It looks like you found a glitch in the matrix...
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <a href="<?= base_url('auth'); ?>" class="btn btn-primary">Home Page</a>
    </div>

</body>

</html>