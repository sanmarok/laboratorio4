<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ingresar</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- SweetAlert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
</head>

<body class="hold-transition login-page bg-dark">
    <div class="login-box ">
        <div class="login-logo">
            <span class="text-white">Ingresar</span>
        </div>
        <!-- /.login-logo -->
        <div class="card bg-secondary">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Para ingresar se debe iniciar sesión</p>

                <form method="post">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="loginEmail" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group my-2">
                        <input type="password" class="form-control" placeholder="Contraseña" name="loginPassword" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <?php
                        // $login = new ControllerUsers();
                        // $login->ctrLogin();
                        ?>
                        <!-- /.col -->
                        <div class="col-4 m-auto">
                            <button type="submit" class="btn btn-success btn-block my-2" name="btnIngresar">Ingresar</button>
                        </div>

                        <?php
                        // Verifica si el botón ha sido presionado
                        if (isset($_POST['btnIngresar'])) {
                            $login = new ControllerUsers();
                            $login->ctrLogin();
                            unset($login);
                        }
                        ?>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>

    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>

</body>


</html>