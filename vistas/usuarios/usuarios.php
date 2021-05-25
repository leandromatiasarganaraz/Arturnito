<?php
// llamada a archivo db (conexión mongoDB)
require_once('../../config/dbMongo.php');

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

            <h2 class="p-1 rounded mt-2"><i class="fas fa-users-cog"></i> Administración de usuarios</h2>
            <button type="button" class="btn btn-success m-2" id="myBtn"> <i class="fas fa-user-plus"></i> Añadir Usuario</button>
          </div>

          <div class="row">

            <div class="col-12">
              <table class="table table-hover table-bordered">
                <thead class="colorfondo2 text-white">
                  <tr class="table animated fadeIn">

                    <th style="text-align: center;">Nombre</th>
                    <th style="text-align: center;">Apellido</th>
                    <!-- <th>Horario</th> -->
                    <th style="width: 190px; text-align: center;">Nombre de usuario</th>
                    <th style="text-align: center;">Email</th>
                    <th style="text-align: center;">Rol</th>
                    <th style="text-align: center;">Estado</th>

                    <th style="text-align: center;">Fecha de alta</th>
                    <th style="width: 120px;" class="text-center">Acción</th>
                  </tr>
                </thead>

                <tbody>
                  <?php
                  $query = new MongoDB\Driver\Query([]);

                  $rows = $manager->executeQuery($dbname, $query);

                  foreach ($rows as $row) { ?>
                    <tr>

                      <td style="text-align: center;"><?php echo $row->nombre ?></td>
                      <td style="text-align: center;"><?php echo $row->apellido ?></td>
                      <td style="text-align: center;"><?php echo $row->nombreUs ?></td>
                      <td style="text-align: center;"><?php echo $row->email ?></td>
                      <td style="text-align: center;"><?php if ($row->rol == 1) {
                                                        echo 'Administrador';
                                                      } else {
                                                        echo 'Usuario';
                                                      } ?></td>
                      <td style="text-align: center;"><?php if ($row->estado == 1) {
                                                        echo 'Habilitado';
                                                      } else {
                                                        echo 'Deshabilitado';
                                                      } ?></td>
                      <td style="text-align: center;"><?php echo $row->dia ?></td>

                      <td><a href="editar_usuario.php?id=<?php echo $row->_id
                                                          ?>" class="btn btn-primary">
                          <img src="<?php echo URL_PROJECT ?>/global/dist/img/editar.png">
                        </a>
                        <a href="cambiar_contraseña.php?id=<?php echo $row->_id ?>" class="btn btn-warning">
                          <i class="fas fa-key"></i>
                        </a> </td>

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
                <h4><span class="glyphicon glyphicon-lock "></span>Nuevo Usuario</h4>
                <button class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body" style="padding:40px 50px;">

                <!-- ADD TASK FORM -->
                <div class="card card-body">
                  <form action="añadir_usuario.php" method="POST">
                    <div class="form-group">
                      <h6 class="">Nombre:</h6>
                      <input autocomplete="off" name="nombre" minlength="2" maxlength="20" pattern="[a-zA-Z ]{2,20}" id="nombre" type="text" class="form-control" value="" placeholder="Escribir nombre aquí" required title="El nombre debe tener entre 2 y 20 caracteres. Sin números, ni símbolos especiales">
                    </div>
                    <div class="form-group">
                      <h6 class="">Apellido:</h6>
                      <input autocomplete="off" name="apellido" minlength="2" maxlength="20" pattern="[a-zA-Z ]{2,20}" id="apellido" type="text" class="form-control" value="" placeholder="Escribir apellido aquí" required title="El apellido debe tener entre 2 y 20 caracteres. Sin números, ni símbolos especiales">
                    </div>
                    <div class="form-group">
                      <h6 class="">Email:</h6>
                      <input autocomplete="off" name="email" id="email" type="email" class="form-control" value="" pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" placeholder="Escribir email aquí" required>
                    </div>
                    <div class="form-group">
                      <h6 class="">Nombre de usuario:</h6>
                      <input autocomplete="off" name="nombreUs" minlength="2" maxlength="10" pattern="[a-zA-Z ]{2,20}" id="nombreUs" type="text" class="form-control" value="" placeholder="Escribir nombre de usuario aquí" required title="El nombre de usuario debe tener entre 2 y 20 caracteres. Sin números, ni símbolos especiales">
                    </div>
                    <div class="form-group">
                      <h6 class="">Contraseña:</h6>
                      <input autocomplete="off" name="contraseña" id="contraseña" minlength="4" maxlength="12" type="password" class="form-control" pattern="[A-Za-z0-9 ]{4,12}" value="" placeholder="Escribir contraseña aquí" required title="La contraseña debe tener entre 4 y 12 caracteres. Puede contener letras mayúsculas, minúsculas y números. Sin simbolos especiales">
                    </div>
                    <div class="form-group">
                    <div class="form-group">
                      <h6 class="">Rol:</h6>
                      <select class="form-control" name="rol" id="rol" required>
                        <option value="1">Administrador</option>
                        <option value="2">Usuario</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <h6 class="">Estado:</h6>
                      <select class="form-control" name="estado" id="estado" required>
                        <option value="1">Habilitado</option>
                        <option value="0">Deshabilitado</option>
                      </select>
                    </div>
                    <button id="btnCargar" type="submit" name="añadir_usuario" class="btn btn-success btn-block" value=""> Añadir usuario </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>


        <script type="text/javascript">
          $(document).ready(function() {
            $('#btnCargar').click(function() {

              if ($.trim($('#nombre').val()) == "") {
                alertify.alert("Debes ingresar el nombre del usuario.");
                return false;
              } else if ($('#apellido').val() == "") {
                alertify.alert("Debes ingresar el apellido del usuario.");
                return false;
              } else if ($('#email').val() == "") {
                alertify.alert("Debes ingresar el email del usuario.");
                return false;
              } else if ($('#nombreUs').val() == "") {
                alertify.alert("Debes ingresar el nombre de usuario del usuario.");
                return false;
              } else if ($('#contraseña').val() == "") {
                alertify.alert("Debes ingresar la contraseña del usuario.");
                return false;
              } else if ($('#rol').val() == "") {
                alertify.alert("Debes seleccionar un rol.");
                return false;
              } else if ($('#estado').val() == "") {
                alertify.alert("Debes seleccionar un estado.");
                return false;
              }

            });
          });
        </script>
<!-- 
        <script>
          var input = document.getElementById('nombre');
          input.oninvalid = function(event) {
            event.target.setCustomValidity('El nombre debe tener entre 2 y 20 caracteres. Sin números, ni símbolos especiales');
          }
          var input = document.getElementById('apellido');
          input.oninvalid = function(event) {
            event.target.setCustomValidity('El apellido debe tener entre 2 y 20 caracteres. Sin números, ni símbolos especiales');
          }
          var input = document.getElementById('nombreUs');
          input.oninvalid = function(event) {
            event.target.setCustomValidity('El nombre de usuario debe tener entre 2 y 20 caracteres. Sin números, ni símbolos especiales');
          }
          var input = document.getElementById('contraseña');
          input.oninvalid = function(event) {
            event.target.setCustomValidity('La contraseña debe tener entre 4 y 12 caracteres. Puede contener letras mayúsculas, minúsculas y números. Sin simbolos especiales');
          }
        </script> -->


        <script>
          $(document).ready(function() {
            $("#myBtn").click(function() {
              $("#myModal").modal();
            });
          });
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