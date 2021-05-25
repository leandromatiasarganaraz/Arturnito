<?php

// llamada a archivo base (conexión mysql)
require('../../config/db.php');

// PARTE SUPERIOR DEL DASHBOARD HTML
require_once('../../global/header.php');


?>
  <div class="content-wrapper">
    <!-- COLOCAR EN MAY EL MODULO QUE LE CORESPONDE -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>CALENDARIOej/colocarelquecorresponda</h1>
          </div>
          <!-- COLOCAR LA RUTA DE SU MODULO NO SE CAMBIA HOME SINO EL LI DE breadcrumb-item active -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Calendario</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- CONTENIDO PRINCIPAL --ACA VA SU MODULO -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
        
         
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
 <?php

// PARTE INFERIOR DEL DASHBOARD (FOOTER)
require_once('../../global/footer.php');

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
