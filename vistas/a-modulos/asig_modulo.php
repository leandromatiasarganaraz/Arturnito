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

          <div class="d-flex justify-content-between">

            <h2 class="p-1 rounded mt-2 "><i class="nav-icon fas fa-plus-square"></i> Asignación de Categorías </h2>
            <!-- <button type="button" class="btn btn-success m-2" id="myBtn">+ Cargar Nueva</button> -->
          </div>

          <div class="row">

            <div class="col-12">
              <table class="table table-hover table-bordered">
                <thead class="colorfondo2 text-white">
                  <tr class="table animated fadeIn">
                    <th >Nombre de Usuario</th>
                    <th style="width: 200px;" class="text-center">Editar Categorías</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $query = "SELECT * FROM usuario WHERE Id_Estado=1 ORDER BY 1";


                  $result_tasks = mysqli_query($conn, $query);

                  while ($row = mysqli_fetch_assoc($result_tasks)) { ?>
                    <tr>
                      <td><?php echo $row['NombreUs']; ?></td>
                      <td class="text-center">
                        <a href="edit.php?id=<?php echo $row['Id_Usuario'] ?>" class="btn btn-primary">
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