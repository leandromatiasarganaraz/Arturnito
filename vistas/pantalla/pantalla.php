<?php

// llamada a archivo base (conexión mysql)
require('../../config/db.php');


?>

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
  <link rel="stylesheet" href="<?php echo URL_PROJECT ?>/global/dist/css/atencion/style_atencion.css"><!--  Para cada una vista que se creé -->
  <link rel="stylesheet" href="<?php echo URL_PROJECT ?>/global/dist/css/alertify.css"><!--  Para cada una vista que se creé -->

  <!-- jquery -->
  <script src="<?php echo URL_PROJECT ?>/global/dist/js/jquery-3.5.1.min.js"></script>
  <script src="<?php echo URL_PROJECT ?>/global/dist/js/alertify.js"></script>


<body class="container-pantalla">

  <style type="text/css">
    .container-pantalla {
      background: -webkit-linear-gradient(to right, #84a9ac, #84a9ac);
      background: linear-gradient(to right, #84a9ac, #205145);
    }

    .parpadea {
  
  animation-name: parpadeo;
  animation-duration: 1.8s;
  animation-timing-function: linear;
  animation-iteration-count: infinite;

  -webkit-animation-name:parpadeo;
  -webkit-animation-duration: 1.8s;
  -webkit-animation-timing-function: linear;
  -webkit-animation-iteration-count: infinite;
}
@-moz-keyframes parpadeo{  
  0% { opacity: 1.0; }
  50% { opacity: 0.0; }
  100% { opacity: 1.0; }
}

@-webkit-keyframes parpadeo {  
  0% { opacity: 1.0; }
  50% { opacity: 0.0; }
   100% { opacity: 1.0; }
}

@keyframes parpadeo {  
  0% { opacity: 1.0; }
   50% { opacity: 0.0; }
  100% { opacity: 1.0; }
}
  </style>

  <center>
    <iframe class="mt-4" text-center width="1000" height="400" src="https://www.youtube.com/embed/jMlVnXx2M0c?rel=0&amp;autoplay=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>


    <table class="container-pantalla text-white"text-align:center bgcolor="grey" width=80% border=1>
      <br><br>
      <MARQUEE SCROLLDELAY=60 width="60%" direction="left" height="100px">
        <h2 class="text-center text-white font-weight-bold"> ¡Gracias por visitarnos!<br>
          En un momento serás atendido...</h2>
      </MARQUEE>

      <tr>

        <td width="50%">
          <center>
            <h1 class="mt-1 container-pantalla text-white font-weight-bold" border=1>TURNOS </h1>
        </td>


      </tr>
    </table>
  </center>

  <?php


  $resultados = mysqli_query($conn, "SELECT Turno,Puesto,Id_Estado FROM TurnosTomados_vista WHERE Id_Estado IN (1,3) order by Id_Estado desc limit 10");
  while ($consulta = mysqli_fetch_array($resultados)) {
  ?>
    <center>
      <table width="80%" class="container-pantalla" border=1>
        <tr>

          <?php

          if ($consulta[2] == 3) {

          ?>

            <td width="50%" style="background-color:black">
              <MARQUEE SCROLLDELAY=60 BGCOLOR="#4AF218">
                <h1 class="text-left font-weight-bold parpadea" border=1><?php echo $consulta[0]; ?></h1>
              </MARQUEE>
            </td>
            <td width="50%" style="background-color:black">
              <MARQUEE SCROLLDELAY=60 BGCOLOR="#4AF218">
                <h1 class="text-left font-weight-bold parpadea" border=1><?php echo $consulta[1]; ?></h1>
              </MARQUEE>
            </td>

          <?php

          }
          if ($consulta[2] == 1) {
          ?>


            <td width="50%">
              <h1 class="text-center text-dark font-weight-bold"><?php echo $consulta[0]; ?></h1>
            </td>
            <td width="50%">
              <h1 class="text-center text-dark font-weight-bold">En Espera</h1>
            </td>
        </tr>

    <?php
          }
        }
        // cierra la conexión
    ?>
      </table>
    </center>
</body>

</html>


<!-- ACA TENEMOS QUE TRABAJAR (DENTRO DEL DIV) -->
</div><!-- /.col -->
</div><!-- /.row -->
</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- /.content -->
<?php

// PARTE INFERIOR DEL DASHBOARD (FOOTER)
//require_once('../../global/footer.php');

// llamada a archivo base (conexión mysql)

?>
<!-- ./wrapper -->

<!-- ESTOS SCRIPTS DEBEN DE ESTAR EN TODOS LOS ARCHIVOS-->

<!-- jQuery -->
<script src="../../global/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../../global/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jQuery UI -->
<script src="../../global/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- AdminLTE App -->
<script src="../../global/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../global/dist/js/demo.js"></script>

</body>

</html>