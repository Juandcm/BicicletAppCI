<?php
$uri = $_SERVER['REQUEST_URI'];
$breadcrumb = '';
$fotoUser = ($_SESSION['user_photo'] == '') ? 'assets/images/users/1.jpg' : $_SESSION['user_photo'];
$iduser = ($_SESSION['user_id'] != '') ? $_SESSION['user_id'] : '';
$array = explode("/", $uri);
$enlace = '';
if ($array[3] == 'buscador') {
    $breadcrumb = '<li class="breadcrumb-item active" aria-current="page">Buscador</li>';
    $enlace = '../';
}

$librerias = '
<link href="' . base_url() . '/assets/libs/dropzone/dist/min/dropzone.min.css" rel="stylesheet"/>    
<link href="' . base_url() . '/dist/css/style.min.css" rel="stylesheet">
<link href="' . base_url() . '/dist/css/estilosagregados.css" rel="stylesheet">
';

switch ($uri) {
    case '/bicicletappci/public/inicio':
        break;

    case '/bicicletappci/public/usuarios':
        $librerias .= '
    <link href="' . base_url() . '/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    ';
        $breadcrumb = '<li class="breadcrumb-item active" aria-current="page">Usuarios</li>';
        break;

    case '/bicicletappci/public/categorias':
        $librerias .= '
    <link href="' . base_url() . '/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    ';
        $breadcrumb = '<li class="breadcrumb-item active" aria-current="page">Categorias</li>';
        break;

    case '/bicicletappci/public/foro':
        $breadcrumb = '<li class="breadcrumb-item active" aria-current="page">Foro</li>';
        break;

    case '/bicicletappci/public/piezas':
        $librerias .= '
    <link href="' . base_url() . '/dist/js/isotope-docs.css" rel="stylesheet">
    ';
        $breadcrumb = '<li class="breadcrumb-item active" aria-current="page">Piezas</li>';
        break;

    case '/bicicletappci/public/quiz':
        $librerias .= '
    <link href="' . base_url() . '/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="' . base_url() . '/assets/libs/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet">
    ';
        $breadcrumb = '<li class="breadcrumb-item active" aria-current="page">Quiz</li>';
        break;

    default:
        break;
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>/assets/images/icon.png">
    <title>BicicletApp</title>

    <?= $librerias; ?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-header-position='fixed' ata-sidebar-position='fixed'>
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-navheader='fixed'>
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="#">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <!-- <img src="<?= base_url() ?>/assets/images/icon.png" alt="homepage" class="dark-logo" /> -->
                            <!-- Light Logo icon -->
                            <img src="<?= base_url() ?>/assets/images/icon.png" alt="homepage" style="width: 100%; height: 60px" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text text-center">
                            <!-- dark Logo text -->
                            BicicletApp
                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <!--                     <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                        <form class="app-search position-absolute" id="formBuscador">
                            <input type="text" class="form-control" id="inputBuscador" placeholder="Buscar..."> <a class="srh-btn"><i class="ti-close"></i></a>

                        </form>
                    </li> -->
                        <input type="hidden" name="idusuarioweb" id="idusuarioweb" value="<?= $iduser; ?>">
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?= base_url() ?>/<?= $fotoUser ?>" alt="user" class="rounded-circle" width="31"></a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <span class="with-arrow"><span class="bg-primary"></span></span>
                                <div class="d-flex no-block align-items-center p-15 bg-primary text-white m-b-10">
                                    <div class="">
                                        <a href="javascript:void(0)">
                                            <img src="<?= base_url() ?>/<?= $fotoUser ?>" alt="user" class="img-circle" width="60" onclick='verImagenDetallada("<?= base_url() ?>/<?= $fotoUser ?>")'>
                                        </a>
                                    </div>
                                    <div class="m-l-10">
                                        <h4 class="m-b-0"><?= $_SESSION['user_name']; ?></h4>
                                        <p class=" m-b-0"><?= $_SESSION['user_email']; ?></p>
                                    </div>
                                </div>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="editarusuariodatatable(<?php echo "'" . $_SESSION['user_id'] . "','" . $_SESSION['user_name'] . "','" . $_SESSION['user_email'] . "','" . $_SESSION['user_phone'] . "','" . $_SESSION['user_type'] . "','" . $_SESSION['user_photo'] . "','1'"; ?>)"><i class="ti-user m-r-5 m-l-5"></i> Editar Perfil</a>
                                <div class="dropdown-divider"></div>
                                <!-- <a class="dropdown-item" href="javascript:void(0)"><i class="ti-email m-r-5 m-l-5"></i> Mensajeria</a> -->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:salir()" id="btnsalir"><i class="fa fa-power-off m-r-5 m-l-5"></i> Salir</a>
                                <div class="dropdown-divider"></div>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-view-dashboard"></i>
                                <span class="hide-menu text-center">Menú Administrativo del Sitio y App</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="<?= $enlace ?>usuarios" class="sidebar-link waves-effect waves-dark">
                                        <i class="icon-people"></i>
                                        <span class="hide-menu"> Usuarios </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="<?= $enlace ?>categorias" class="sidebar-link waves-effect waves-dark">
                                        <i class="icon-settings"></i>
                                        <span class="hide-menu"> Categorías </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="<?= $enlace ?>piezas" class="sidebar-link waves-effect waves-dark">
                                        <i class="ti-settings"></i>
                                        <span class="hide-menu"> Piezas </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="<?= $enlace ?>foro" class="sidebar-link waves-effect waves-dark">
                                        <i class="ti-comments"></i>
                                        <span class="hide-menu"> Foros </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="<?= $enlace ?>quiz" class="sidebar-link waves-effect waves-dark">
                                        <i class="icon-question"></i>
                                        <span class="hide-menu"> Quiz </span>
                                    </a>
                                </li>

                                <!--                                 <li class="sidebar-item">
                                    <a href="<?= $enlace ?>buscador" class="sidebar-link waves-effect waves-dark">
                                        <i class="ti-search"></i>
                                        <span class="hide-menu"> Buscador </span>
                                    </a>
                                </li> -->

                            </ul>
                        </li>

                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>



        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Página actual</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= $enlace ?>inicio">Inicio</a></li>
                                    <?php echo $breadcrumb; ?>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <?php
            echo view('administracion/usuarios/modaleditarusuario');
            ?>

            <div class="container-fluid">