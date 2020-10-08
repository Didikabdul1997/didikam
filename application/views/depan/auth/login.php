<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= $title; ?></title>
    <link rel="icon" href="/assets/images/icons/d.png" type="image/x-icon">
    <link rel="stylesheet" href="/material/css/bootstrap.min.css">
    <link rel="stylesheet" href="/material/css/mdb.min.css">
    <link rel="stylesheet" href="/material/css/style.css">
</head>
</head>

<style type="text/css">
    html,
    body {
        height: 100%;
    }
</style>

<body id="body">
    <main id="main">
        <div class="container">
            <section class="text-center d-flex justify-content-center">
                <div class="col-md-5 mt-5">
                    <div class="card mt-5">
                        <div class="card-header info-color white-text text-center py-4">
                            <h1 class="fas fa-users mb-3"></h1>
                            <h3><strong>Admin Login</strong></h3>
                        </div>
                        <div class="card-body px-lg-5 shadow">
                            <?= $this->session->flashdata('msg_logout'); ?>
                            <form id="form" class="text-center mt-3" style="color: #757575;">
                                <p><b>Silahkan Login Dibawah !!</b></p>
                                <hr width="70%"><input type="hidden" id="csrf" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                <div class="md-form mt-5 text-left">
                                    <input type="text" id="email" name="email" class="form-control">
                                    <label for="email" id="l_email">Username</label>
                                    <div class="invalid-feedback" id="email_error"></div>
                                </div>
                                <div class="md-form text-left">
                                    <input type="password" id="password" name="password" class="form-control">
                                    <label for="password" id="l_password">Password</label>
                                    <div class="invalid-feedback" id="password_error"></div>
                                </div>
                                <button id="login" class="btn btn-info btn-rounded btn-block z-depth-0 my-4 waves-effect" type="submit"><b class="mr-1">Login</b> <b class="fas fa-sign-in-alt"></b></button>
                                <a href="/" class="text-info"><u class="fas fa-arrow-left"></u><u> Home</u></a>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
</body>
<script type="text/javascript" src="/material/js/jquery.min.js"></script>
<script type="text/javascript" src="/material/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/material/js/mdb.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        remove_pesan();
    });

    var BASE_URL = "<?php echo base_url(); ?>";
    $('#body').append(`
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    `);
    $('#body').css('background', 'url("https://mdbootstrap.com/img/Photos/Horizontal/Nature/full%20page/img%20%283%29.jpg")no-repeat center center fixed');

    // Proses Login
    $('#form').on('submit', function(event) {
        signIn();
        event.preventDefault();
    });

    function remove_pesan() {
        setTimeout(function() {
            $("#pesan").remove();
        }, 3000);
    }

    function signIn() {
        var csfrData = {};
        csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
        $.ajaxSetup({
            data: csfrData
        });
        var form_data = new FormData($('#form')[0]);
        var link = BASE_URL + 'auth/signIn';
        $.ajax({
            url: link,
            type: "POST",
            data: form_data,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(data) {
                // Email
                $('#email').removeClass('is-invalid');
                $('#email').removeClass('is-valid');
                $('#l_email').removeClass('text-danger');
                $('#l_email').removeClass('text-success');
                $('#email_error').html('');
                // Password
                $('#password').removeClass('is-invalid');
                $('#password').removeClass('is-valid');
                $('#l_password').removeClass('text-danger');
                $('#l_password').removeClass('text-success');
                $('#password_error').html('');
                $("#pesan").remove();
                if (data.status == 3) {
                    if (data.pesan.email_error) {
                        $('#email').addClass('is-invalid');
                        $('#l_email').addClass('text-danger');
                        $('#email_error').html(data.pesan.email_error);
                    } else if (data.pesan.email_success) {
                        $('#email').addClass('is-valid');
                        $('#l_email').addClass('text-success');
                        $('#email').val(data.pesan.email_success);
                    }
                    if (data.pesan.password_error) {
                        $('#password').addClass('is-invalid');
                        $('#l_password').addClass('text-danger');
                        $('#password_error').html(data.pesan.password_error);
                    } else if (data.pesan.password_success) {
                        $('#password').addClass('is-valid');
                        $('#l_password').addClass('text-success');
                        $('#password').val(data.pesan.password_success);
                    }
                } else if (data.status == 0) {
                    $(`
                         <div id="pesan" class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Warning ! </strong> ` + data.pesan + `
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>`).insertBefore('#form');
                    remove_pesan()
                } else if (data.status == 1) {
                    $(`
                        <div id="pesan" class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success ! </strong> ` + data.pesan + `
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>`).insertBefore('#form');
                    remove_pesan();
                    setTimeout(function() {
                        document.location.href = BASE_URL + 'dashboard';
                    }, 1500);
                }
            }
        });
    }
</script>
</body>

</html>