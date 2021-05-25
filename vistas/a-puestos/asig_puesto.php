<?php

// llamada a archivo base (conexión mysql)
require('../../config/db.php');

// PARTE SUPERIOR DEL DASHBOARD HTML
require_once('../../global/header.php');

if (isset($_POST['remover_todos'])) {

  //$id = $_POST['id_usuario'];
  $query = "UPDATE usuario set Id_Puesto = NULL";
  $result = mysqli_query($conn, $query);


  if (!$result) {
    die("Query Failed.");
  }
}

?>
<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">
      <div class="row">

        <!-- AREA DE TRABAJO -->


        <main class="container-fluid">

          <!-- ALERTA -->
          <!--   <?php if (isset($_SESSION['message'])) { ?>
            <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show mt-2 mb-0" role="alert">
              <?= $_SESSION['message'] ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <?php //session_unset();
                  } ?> -->

          <!-- ALERTA -->

          <div class="d-flex justify-content-between">

            <h2 class="p-2 rounded mt-2"><i class="fas fa-plus-square"></i> Asignación de Puestos</h2>
            <form action="asig_puesto.php" method="POST">
              <button type="submit" name="remover_todos" class="p-2 btn btn-danger m-3" onclick="return ConfirmDelete()">
                <i class="fas fa-user-times"></i> Remover todos los puestos</button>
            </form>
          </div>

          <div class="row">

            <div class="col-12">

              <table class="table table-hover table-bordered">
                <thead class="colorfondo2 text-white">

                  <tr class="table animated fadeIn">

                    <th>Nombre de usuario</th>
                    <th>Puesto Asignado</th>

                    <th style="width: 180px;" class="text-center">Editar puesto </th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $query = "SELECT u.nombreUs, u.Id_Puesto, p.Puesto , u.Id_Usuario 
                  FROM usuario u 
                  LEFT JOIN puesto p ON P.Id_Puesto=u.Id_Puesto
                   WHERE u.Id_Estado = 1";
                  $result_tasks = mysqli_query($conn, $query);

                  // $query2 = "SELECT usuario.Id_Puesto, puesto.Puesto
                  // FROM puesto
                  // INNER JOIN usuario ON usuario.Id_Puesto=puesto.Id_Puesto;";
                  // $result_tasks2 = mysqli_query($conn, $query2);

                  while ($row = mysqli_fetch_assoc($result_tasks)) { ?>
                    <tr>
                      <td><?php echo $row['nombreUs']; ?></td>
                      <td><?php echo $row['Puesto']; ?></td>
                      <td class="text-center">
                        <a href="carga_puesto.php?id=<?php echo $row['Id_Usuario'] ?>" class="btn btn-primary">
                          <img src="<?php echo URL_PROJECT ?>/global/dist/img/editar.png">
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
                <h4><span class="glyphicon glyphicon-lock ">Puestos</span></h4>
                <button class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body" style="padding:40px 50px;">

                <!-- ADD TASK FORM -->
                <div class="card card-body">
                  <form id="cargar_categoria_form" method="POST">
                    <div class="form-group">
                      <h6 class="">Puestos disponibles:</h6>
                      <select class="form-control" name="puesto" id="sel1" required>
                        <?php $query = "SELECT Id_Puesto,Puesto,Estado_puesto FROM puesto";
                        $result = mysqli_query($conn, $query);

                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
                          <option value="<?php if ($row['Estado_puesto'] == 1) {
                                            echo $row['Id_Puesto'];
                                          } ?>"><?php if ($row['Estado_puesto'] == 1) {
                                                  echo $row["Puesto"];
                                                } ?>
                          </option>
                        <?php } ?>
                      </select>
                    </div>
                    <span id="btn_cargar" class="btn btn-success btn-block" value="">Asignar</span>
                  </form>
                </div>

              </div>
            </div>
          </div>
        </div>

        <script type="text/javascript">
          function ConfirmDelete() {
            var respuesta = confirm("¿Esta seguro de remover todos los puestos?")

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