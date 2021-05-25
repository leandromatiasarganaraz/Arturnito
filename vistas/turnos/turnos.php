<?php
require_once('../../config/db.php');
require_once('../../config/var_globales.php');
?>

<!DOCTYPE html>
<!--
ESTE ARCHIVO TIENE LA PARTE SUPERIOR DE TODA VISTA EN EL DASHBOARD
-->
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Arturnito</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
  <link rel="stylesheet" href="<?php echo URL_PROJECT ?>../global/dist/css/style_general_compartido.css"><!--  Para etiquetas mas importantes / glabales -->
  <link rel="stylesheet" href="<?php echo URL_PROJECT ?>/global/dist/css/categorias/style_categorias.css"><!--  Para cada una vista que se creé -->
  <link rel="stylesheet" href="<?php echo URL_PROJECT ?>../global/dist/css/atencion/style_atencion.css"><!--  Para cada una vista que se creé -->
  <link rel="stylesheet" href="<?php echo URL_PROJECT ?>/global/dist/css/alertify.css"><!--  Para cada una vista que se creé -->

  <!-- jquery -->
  <script src="<?php echo URL_PROJECT ?>/global/dist/js/jquery-3.5.1.min.js"></script>
  <script src="<?php echo URL_PROJECT ?>/global/dist/js/alertify.js"></script>

  <!-- Icono Pesataña -->
  <link rel="icon" href="<?php echo URL_PROJECT ?>/global/dist/img/logoart.PNG">

</head>

<body class="container-pantalla">
  <style>
    .container-pantalla {
      background: -webkit-linear-gradient(to right, #84a9ac, #84a9ac);
      background: linear-gradient(to right, #84a9ac, #205145);
    }
  </style>

  <div class="container">
    <h2 class="text-center mt-5 mb-3">SELECCIONE SU TURNO</h2>

    <form action="generarturno.php" method="post">


      <?php
      // llamada a archivo base (conexión mysql)


      $resultados = mysqli_query($conn, "SELECT Modulo FROM modulo WHERE Estado_Modulo = 1");
      while ($consulta = mysqli_fetch_array($resultados)) {

      ?>

        <input name="modulo" type="submit" value='<?php echo $consulta[0]; ?>' class="p-4 mb-1 btn btn-block btn-primary text-uppercase"></input>

      <?php
      }


      ?>

    </form>
  </div>
</body>
<?php

// Footer
// require_once('../../global/footer.php');

?>