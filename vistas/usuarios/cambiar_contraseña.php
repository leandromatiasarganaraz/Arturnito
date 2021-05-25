<?php
// llamada a archivo db (conexión mongoDB)
require_once('../../config/dbMongo.php');

// PARTE SUPERIOR DEL DASHBOARD HTML
require_once('../../global/header.php');



?>
<div class="content-wrapper">
    <!-- COLOCAR EN MAY EL MODULO QUE LE CORESPONDE -->
  <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1></h1>
                  </div>
                  <!-- COLOCAR LA RUTA DE SU MODULO NO SE CAMBIA HOME SINO EL LI DE breadcrumb-item active -->
                  <!-- <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Calendario</li>
              </ol>
            </div> -->
              </div>
          </div><!-- /.container-fluid -->
      </section>
 <section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 mx-auto">
        <div class="colorfondo2 card card-body mt-5">
          <form action="edit_contraseña.php" method="POST">
            <h2 class="colorfondo2 text-center text-white mb-2"><i class="fas fa-key"></i> Cambiar contraseña</h2>
            <a href="usuarios.php" class="btn btn-primary btn-block mt-2 mb-2">Ir a la lista de usuarios</a>
            <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
            <?php
            $bulk = new MongoDB\Driver\BulkWrite;
                      $id = $_GET["id"];
                      $filter = ['_id' => new MongoDB\BSON\ObjectId($id)];

                      $query = new MongoDB\Driver\Query($filter);

                      $rows = $manager->executeQuery($dbname, $query);
                      foreach ($rows as $row) { ?>
            <div class="form-group">

              <input type="hidden" class="form-control" id="nombre" name="nombre" value="<?php echo $row->nombre ?>" placeholder=" ">
            </div>
            <div class="form-group">

              <input type="hidden" class="form-control" id="apellido" name="apellido" value="<?php echo $row->apellido; ?>" placeholder=" ">
            </div>
            <div class="form-group">

              <input type="hidden" class="form-control" id="email" name="email" value="<?php echo $row->email; ?>" placeholder=" ">
            </div>
            <div class="form-group">

              <input type="hidden" class="form-control" id="nombreUs" name="nombreUs" value="<?php echo $row->nombreUs; ?>" placeholder=" ">
            </div>
            <div class="form-group" style="display: none">
            <h6 class="text-white" for="rol" class="">Rol:</h6>
                              <select class="form-control" name="rol" id="sel1" required>
                                  <option <?php if ($row->rol == 1) {
                                              echo "selected";
                                          } ?> value="1">Administrador</option>

                                  <option <?php if ($row->rol == 2) {
                                              echo "selected";
                                          } ?> value="2">Usuario</option>
                              </select>
                          </div>
            <div style="display: none" class="form-group">
            <h6 class="text-white" for="estado" class="">Estado:</h6>
                              <select class="form-control" name="estado" id="sel1" required>
                                  <option  <?php if ($row->estado == 1) {
                                              echo "selected";
                                          } ?> value="1">Habilitado</option>

                                  <option  <?php if ($row->estado == 0) {
                                              echo "selected";
                                          } ?> value="0">Deshabilitado</option>
                              </select>
            </div>
           <div class="form-group">
                      <h6 class="">Contraseña:</h6>
                      <input autocomplete="off" name="contraseña" id="contraseña" minlength="4" maxlength="12" type="password" class="form-control" pattern="[A-Za-z0-9-]{4,12}" value="" placeholder="Escribir contraseña aquí" required title="La contraseña debe tener entre 4 y 12 caracteres. Puede contener letras mayúsculas, minúsculas y números. Sin simbolos especiales">
                    </div>
            <div class="form-group">

              <input type="hidden" autocomplete="off" name="dia" type="text" class="form-control" value="<?php echo $row->dia ?>" placeholder=" " required readonly="readonly">
            </div>
            <input type="submit" value="Actualizar contraseña" class="btn btn-primary btn-block">
          </form>
                      <? } ?>
        </div>
      </div>
      </div>
    </div>
  </div>


</section>
  <!-- /.content -->
  <?php

// PARTE INFERIOR DEL DASHBOARD (FOOTER)
require_once('../../global/footer.php');

// llamada a archivo base (conexión mysql)

?>
<!-- ./wrapper -->

<!-- ESTOS SCRIPTS DEBEN DE ESTAR EN TODOS LOS ARCHIVOS-->

<!-- BOOTSTRAP 4 SCRIPTS -->
<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
---<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script> -->

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