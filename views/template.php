<?php
session_start();
if (isset($_SESSION['user_type_id'])) {
    $url = ControllerTemplate::url();
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Inicio</title>
        <!-- DataTables -->
        <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/adminlte.min.css">
        <!-- SweetAlert -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!--Font Awesome -->
        <script src="https://kit.fontawesome.com/dcd8a6e406.js" crossorigin="anonymous"></script>
        <!-- Enlace al archivo users.functions.js -->
        <script src="functions/users.functions.js"></script>
        <!-- Enlace al archivo clients.functions.js -->
        <script src="functions/clients.functions.js"></script>
        <!-- Enlace al archivo template.functions.js -->
        <script src="functions/template.functions.js"></script>
    </head>

    <body class="layout-navbar-fixed control-sidebar-slide-open dark-mode">
        <!-- Site wrapper -->
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-light bg-dark">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="home" class="nav-link text-white">Inicio</a>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="index.php" class="brand-link elevation-4">
                    <span class="brand-text font-weight-light mx-auto">Gestor</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user (optional) -->
                    <div class="user-panel my-3 d-flex text-left">
                        <div class="info">
                            <span class="d-block mb-2">
                                <?php echo $_SESSION['name'] . ' ' . $_SESSION['last_name'] ?>
                            </span>
                            <span class="d-block mb-2">
                                <?php
                                switch ($_SESSION['user_type_id']) {
                                    case 1:
                                        echo '<i class="nav-icon fas fa-user-tie mr-2"></i><span class="px-1">Adminstrador supremo<span>';
                                        break;
                                    case 2:
                                        echo '<i class="nav-icon fas fa-user mr-2"></i><span class= px-1>Administrador<span>';
                                        break;
                                    case 3:
                                        echo '<i class="fa-solid fa-user-astronaut"></i><span class= px-1>Consultor<span>';
                                    default:
                                        # code...
                                        break;
                                }
                                ?>
                            </span>
                            <div class="mt-3">
                                <a href="logout" class="btn btn-danger btn-sm">
                                    <i class="fas fa-sign-out-alt"></i><span class="text-white m-2">Cerrar sesión</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <?php
                            if ($_SESSION['user_type_id'] == 1 || $_SESSION['user_type_id'] == 2) {
                                echo '                          
                                    <li class="nav-item">
                                        <a href="users" class="nav-link">
                                            <i class="nav-icon fas fa-users"></i>
                                            <p>Usuarios</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                    <a href="userstypes" class="nav-link">
                                        <i class="nav-icon fas fa-user-tag"></i>
                                        <p>Tipos de usuarios</p>
                                    </a>
                                </li>
                                    ';
                            }
                            ?>

                            <li class="nav-item">
                                <a href="clients" class="nav-link">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>Clientes</p>
                                </a>
                            </li>

                            <?php
                            if ($_SESSION['user_type_id'] == 1 || $_SESSION['user_type_id'] == 2) {
                                echo '                            <li class="nav-item">
                                <a href="maritalstatuses" class="nav-link">
                                    <i class="nav-icon fas fa-ring"></i>
                                    <p>Estados civiles</p>
                                </a>
                            </li>';
                            }
                            ?>
                            <li class="nav-item">
                                <a href="products" class="nav-link">
                                    <i class="nav-icon fas fa-shopping-cart"></i>
                                    <p>Productos</p>
                                </a>
                            </li>

                            <?php
                            if ($_SESSION['user_type_id'] == 1 || $_SESSION['user_type_id'] == 2) {
                                echo '                            <li class="nav-item">
                                <a href="category" class="nav-link">
                                    <i class="nav-icon fas fa-tag"></i>
                                    <p>Categorias</p>
                                </a>
                            </li>';
                            }
                            ?>

                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>
            <div class="content-wrapper">
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <?php
                                if (isset($_GET["page"])) {
                                    switch ($_GET["page"]) {
                                        case "clients":
                                        case "users":
                                        case "products":
                                        case "logout":
                                        case "userstypes":
                                            include 'modules/' . $_GET["page"] . '.php';
                                            break;
                                        default:
                                            include 'modules/home.php';
                                            break;
                                    }
                                } else {
                                    include 'modules/home.php';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /.content -->
            </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        </div>
        <!-- ./wrapper -->
        <!-- jQuery -->
        <script src="plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/adminlte.min.js"></script>
        <!-- DataTables & Plugins -->
        <script src="plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="plugins/jszip/jszip.min.js"></script>
        <script src="plugins/pdfmake/pdfmake.min.js"></script>
        <script src="plugins/pdfmake/vfs_fonts.js"></script>
        <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    </body>

    </html>
<?php
} else {
    if (isset($_GET['page']) && ($_GET['page'] == 'authentication')) {
        include 'modules/authentication.php';
    } else {
        include 'modules/authentication.php'; // o cualquier otra página predeterminada para usuarios no autenticados
    }
}
?>