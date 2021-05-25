<?php
// llamada a archivo base (conexión mysql)
require('../../config/db.php');

// PARTE SUPERIOR DEL DASHBOARD HTML
require_once('../../global/header.php');


?>
<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">
      <div class="row">

        <!-- AREA DE TRABAJO -->


        <main class="container-fluid">

          <!-- ALERTA -->
          <?php if (isset($_SESSION['message'])) { ?>
            <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show mt-2 mb-0" role="alert">
              <?= $_SESSION['message'] ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <?php 
            unset($_SESSION['message']);
            unset($_SESSION['message_type']);

          } ?>

          <!-- ALERTA -->

          <div class="d-flex justify-content-between">

            <h2 class="p-1 rounded mt-2 "><i class="nav-icon fas fa-tags"></i> Categorías</h2>
            <button type="button" class="btn btn-success m-2" id="myBtn"><i class="fas fa-plus"></i> Cargar Nueva</button>
          </div>

          <div class="row">

            <div class="col-12">
              <table class="table table-hover table-bordered">
                <thead class="colorfondo2 text-white">
                  <tr class="table animated fadeIn">
                    <th>Categoría</th>
                    <th>Código</th>
                    <th>Estado</th>
                    <th>Fecha de Alta</th>
                    <th style="width: 120px;" class="text-center">Acción</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $query = "SELECT * FROM modulo WHERE Estado_Modulo IN (0,1)";
                  $result_tasks = mysqli_query($conn, $query);

                  while ($row = mysqli_fetch_assoc($result_tasks)) { ?>
                    <tr>
                      <td><?php echo $row['Modulo']; ?></td>
                      <td><?php echo $row['Cod_Modulo']; ?></td>
                      <!-- <td><?php echo $row['Horario_Atencion']; ?></td> -->
                      <td><?php if ($row['Estado_Modulo'] == 1) {
                            echo 'Habilitado';
                          } else {
                            echo 'Deshabilitado';
                          } ?></td> 
                      <td><?php echo $row['Fecha_Alta']; ?></td>
                      <td>
                        <a href="edit.php?id=<?php echo $row['Id_Modulo'] ?>" class="btn btn-primary">
                          <img src="<?php echo URL_PROJECT ?>/global/dist/img/editar.png">
                        </a>
                        <a href="delete_task.php?id=<?php echo $row['Id_Modulo'] ?>" class="btn btn-danger" onclick="return ConfirmDelete()">
                          <img src="<?php echo URL_PROJECT ?>/global/dist/img/borrar.png">
                        </a>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </main>


        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header colorfondo2 text-white">
                <h4><span class="glyphicon glyphicon-lock "></span>Nueva Categoría</h4>
                <button class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body" style="padding:40px 50px;">

                <!-- ADD TASK FORM -->
                <div class="card card-body">
                  <form id="cargar_categoria_form" method="POST">
                    <div class="form-group">
                      <h6 class="">Categoría:</h6>
                      <input autocomplete="off" name="categoria" id="cat" type="text" class="form-control" value="" placeholder="Escribir nombre de categoría aquí" required>
                    </div>
                    <div class="form-group">
                      <h6 class="">Código:</h6>
                      <input autocomplete="off" name="codigo" maxlength="3" id="cod" type="text" class="form-control" value="" placeholder="Escribir código aquí" required>
                    </div>
                    <div class="form-group">
                      <h6 class="">Estado:</h6>
                      <select class="form-control" name="estado" id="est" required>
                        <option value="1">Habilitado</option>
                        <option value="0">Deshabilitado</option>
                      </select>
                    </div>
                    <span id="btn_cargar" class="btn btn-success btn-block" value="">Cargar Categoría</span>
                  </form>
                </div>

              </div>
            </div>
          </div>
        </div>

        <script type="text/javascript">
          $(document).ready(function() {
            $('#btn_cargar').click(function() {

              if ($.trim($('#cat').val()) == "") {
                alertify.alert("Debes ingresar el nombre de la categoría.");
                return false;
              } else if ($('#cod').val() == "") {
                alertify.alert("Debes ingresar un código de tres letras.");
                return false;
              } else if ($('#est').val() == "") {
                alertify.alert("Debes seleccionar un estado.");
                return false;
              }

              cadena = "cat=" + $('#cat').val() +
                "&cod=" + $('#cod').val() +
                "&est=" + $('#est').val();

              $.ajax({
                type: "POST",
                url: "cargar_cat.php",
                data: cadena,
                success: function(r) {
                  if (r == 5) {
                    alertify.alert("El nombre de categoría ya existe, prueba con otro.");}
                  else if (r == 4) {
                    alertify.alert("El código ingresado no es válido, prueba con otro.");
                  } else if (r == 3) {
                    alertify.alert("El código debe ser de tres caracteres y sin espacios.");
                  } else if (r == 2) {
                    alertify.alert("El código ingresado ya existe, prueba con otro.");
                  } else if (r == 1) {
                    $('#cargar_categoria_form')[0].reset();
                    alertify.success("Cargada con exito");
                    window.location.reload();
                  } else {
                    alertify.error("Fallo al cargar, vuelve a intentarlo.");
                  }
                }
              });
            });
          });
        </script>

        <script>
          $(document).ready(function() {
            $("#myBtn").click(function() {
              $("#myModal").modal();
            });
          });
        </script>

        <script type="text/javascript">
          function ConfirmDelete() {
            var respuesta = confirm("¿Esta seguro de eliminar la categoría?")

            if (respuesta == true) {
              return true;
            } else {
              return false;
            }
          }
        </script>


        <!-- AREA DE TRABAJO -->


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