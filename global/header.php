<?php
require_once('../../config/var_globales.php');
require_once('../../config/db.php');
if(isset($_SESSION['usuario'])){
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Arturnito</title>


  <link rel="stylesheet" type="text/css" href="<?php echo URL_PROJECT ?>/global/dist/datatables/datatables.min.css"/>
  <!--datables estilo bootstrap 4 CSS-->  
  <link rel="stylesheet"  type="text/css" href="<?php echo URL_PROJECT ?>/global/dist/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- JavaScript  CDN ALERTIFY COMIENZO -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.rtl.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.rtl.min.css"/>
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.rtl.min.css"/>
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.rtl.min.css"/>
<!-- 
    FIN CDN ALERTIFY
-->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../global/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- fullCalendar -->
  <link rel="stylesheet" href="../../global/plugins/fullcalendar/main.min.css">
  <link rel="stylesheet" href="../../global/plugins/fullcalendar-daygrid/main.min.css">
  <link rel="stylesheet" href="../../global/plugins/fullcalendar-timegrid/main.min.css">
  <link rel="stylesheet" href="../../global/plugins/fullcalendar-bootstrap/main.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../global/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- Css -->
  <link rel="stylesheet" href="<?php echo URL_PROJECT ?>/global/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo URL_PROJECT ?>/global/dist/css/style_general_compartido.css"><!--  Para etiquetas mas importantes / glabales -->
  <link rel="stylesheet" href="<?php echo URL_PROJECT ?>/global/dist/css/categorias/style_categorias.css"><!--  Para cada una vista que se creé -->
  <link rel="stylesheet" href="<?php echo URL_PROJECT ?>/global/dist/css/atencion/style_atencion.css"><!--  Para cada una vista que se creé -->
  <link rel="stylesheet" href="<?php echo URL_PROJECT ?>/global/dist/css/alertify.css"><!--  Para cada una vista que se creé -->

  <!-- jquery -->
  <script src="<?php echo URL_PROJECT ?>/global/dist/js/jquery-3.5.1.min.js"></script>
  <script src="<?php echo URL_PROJECT ?>/global/dist/js/alertify.js"></script>

  <!-- Icono Pesataña -->
  <link rel="icon" href="<?php echo URL_PROJECT ?>/global/dist/img/arturnitologo.PNG">

</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar se encuentra el pushmenu  -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" type="submit" name="submit" id="submit" href="../../global/logout.php" role="button"><i class="nav-icon fas fa-sign-out-alt"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- LOGO -->
      <a href="../../index.php" class="brand-link">
        <img src="../../global/dist/img/arturnitologo.png" alt="Logo Arturnito" class="brand-image"  style="opacity: .7">
        <span class="brand-text font-weight-light">ARTURNITO</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional)  NOTA: en SRC deberia de traer la foto por default o cargada por el usuario-->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
    <?php 
     $SelectFoto= "SELECT Foto FROM usuario WHERE NombreUs = '".$_SESSION['usuario']->nombreUs."'";
     $QueryFoto=mysqli_query($conn,$SelectFoto) or die ('No se pudo consultar la foto de perfil en usuarios<br>'.mysqli_error($conn));
     $PedirDato = $QueryFoto->fetch_assoc();
    ?>

            <img src="<?php echo URL_PROJECT ?>/vistas/perfil/<?php echo $PedirDato['Foto'] ?>"  width="40" height="40" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?php echo $nombre = ucwords($_SESSION['usuario']->nombre) ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Agrega íconos a los enlaces usando la clase .nav-icon
                con font-awesome o cualquier otra biblioteca de fuentes de iconos -->
            <!--En el inicio de este Li comienzan las opciones que solo van a poder ver los administradores-->
             <!-- ACA VA EL CONIDO DE HEADERADM -->
             <?php
             if($_SESSION['usuario']->rol==1){
               include_once('headeradm.php');
             }
             ?>
             <!--En el inicio de este Li comienzan las opciones de los usuarios-->
            <li class="nav-item">
              <a href="<?php echo URL_PROJECT ?>/vistas/atencion/atencion.php" class="nav-link">
                <i class="nav-icon fas fa-bell"></i>
                <p>
                  ATENCIÓN
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="javascript:ventanaSecundariaPantalla('../pantalla/pantalla.php')" class="nav-link">
                <i class="nav-icon fas fa-tv"></i>
                <p>
                  PANTALLA
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="javascript:ventanaSecundariaTurnos('../turnos/turnos.php')" class="nav-link">
                <i class="nav-icon fas fa-people-arrows"></i>
                <p>
                  TURNOS
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo URL_PROJECT ?>/vistas/perfil/perfil.php" class="nav-link">
                <i class="nav-icon fas fa-user-circle"></i>
                <p>
                  PERFÍL
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>



    <?php
    }else{
    ?>
     <script type="text/javascript"> window.location="../../index.php"; </script>
    <?php
     } 
    ?>