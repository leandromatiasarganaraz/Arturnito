<?php
// llamada a archivo base (conexión mysql)
require('../../config/db.php');

// PARTE SUPERIOR DEL DASHBOARD HTML
require_once('../../global/header.php');
?>
<div class="content-wrapper">
  <section class="content mb-4">
    <div class="container-fluid">
      <div class="row">

        <!-- AREA DE TRABAJO -->

        <main class="container-fluid">

          <!-- ALERTA -->

          <div class="d-flex justify-content-between">
            <h2 class="p-1 rounded mt-2 "><i class="nav-icon fas fa-chart-line"></i> Estadísticas de Atención</h2>
          </div>

          <div class="card card-body">
            <form id="filtros_estadisticas" method="POST">

              <div class="row">
                <div class="form-group col-4">
                  <h6 class="">Puesto:</h6>
                  <select class="form-control" name="puesto" id="puesto">
                    <option value="1">Todos</option>
                    <?php
                    $query_puestos = "SELECT * FROM puesto WHERE Estado_puesto<>2";
                    $result_query_puestos = mysqli_query($conn, $query_puestos);
                    while ($list_puestos = mysqli_fetch_array($result_query_puestos, MYSQLI_ASSOC)) { ?>
                      <option value="<?php echo $list_puestos['Puesto'] ?>"> <?php echo $list_puestos['Puesto'] ?> </option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-4">
                  <h6 class="">Categoría:</h6>
                  <select class="form-control" name="modulo" id="modulo">
                    <option value="1">Todos</option>
                    <?php
                    $query_modulos = "SELECT * FROM modulo WHERE Estado_modulo<>2";
                    $result_query_modulos = mysqli_query($conn, $query_modulos);
                    while ($list_modulos = mysqli_fetch_array($result_query_modulos, MYSQLI_ASSOC)) { ?>
                      <option value="<?php echo $list_modulos['Modulo'] ?>"> <?php echo $list_modulos['Modulo'] ?> </option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-4">
                  <h6 class="">Estado:</h6>
                  <select class="form-control" name="estado" id="estado">
                    <option value="1">Todos</option>
                    <?php
                    $query_estados = "SELECT * FROM estado WHERE Id_Estado NOT IN (0,1,2)";
                    $result_query_estados = mysqli_query($conn, $query_estados);
                    while ($list_estados = mysqli_fetch_array($result_query_estados, MYSQLI_ASSOC)) { ?>
                      <option value="<?php echo $list_estados['Estado'] ?>"> <?php echo $list_estados['Estado'] ?> </option>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <div class="row">
                <div class="form-group col-4">
                  <h6 class="">Usuario de Atención:</h6>
                  <select class="form-control" name="usuario" id="usuario">
                    <option value="1">Todos</option>
                    <?php
                    $query_usuarios = "SELECT * FROM usuario WHERE Id_Estado<>2";
                    $result_query_usuarios = mysqli_query($conn, $query_usuarios);
                    while ($list_usuarios = mysqli_fetch_array($result_query_usuarios, MYSQLI_ASSOC)) { ?>
                      <option value="<?php echo $list_usuarios['NombreUs'] ?>"> <?php echo $list_usuarios['NombreUs'] ?> </option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-2">
                  <h6 class="">Turno:</h6>
                  <input autocomplete="off" name="turno" id="turno" type="text" class="form-control" placeholder="Escribir turno">
                </div>
                <div class="form-group col-3">
                  <h6 class="">Fecha Desde:</h6>
                  <input autocomplete="off" name="f_desde" id=f_desde type="date" class="form-control">
                </div>
                <div class="form-group col-3 ">
                  <h6 class="">Fecha Hasta:</h6>
                  <input autocomplete="off" name="f_hasta" id=f_hasta id="cod" type="date" class="form-control">
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="form-group col-6 ">
                  <span id="aplicar_filtros" class="btn btn-success btn-block" value="">Aplicar Filtros</span>
                </div>
                <div class="form-group col-6 ">
                  <span id="BorrarFiltros" class="btn btn-danger btn-block" value="" >Borrar Filtros </span>
                </div>
              </div>
            </form>
          </div>
      </div>
      <div id='datos'>
        </main>

      </div>
      <script type="text/javascript">
        $(document).ready(function() {
          $('#aplicar_filtros').click(function() {

            cadena = "puesto=" + $('#puesto').val() +
              "&modulo=" + $('#modulo').val() +
              "&estado=" + $('#estado').val() +
              "&usuario=" + $('#usuario').val() +
              "&turno=" + $('#turno').val() +
              "&f_desde=" + $('#f_desde').val() +
              "&f_hasta=" + $('#f_hasta').val();

            $.ajax({
                type: "POST",
                url: "filtrar.php",
                dataType: 'html',
                data: cadena,
              })
              .done(function(respuesta) {
                $("#datos").html(respuesta);


              });
          });
        });
      </script>
      <!-- AREA DE TRABAJO -->
    </div>
  </section>

  <?php
  // PARTE INFERIOR DEL DASHBOARD (FOOTER)
  require_once('../../global/footer.php');
  ?>

  <!-- <script type="text/javascript">
    function BorrarFiltros() {
      window.location.reload();
    }
  </script> -->

  <script type="text/javascript">
    $(document).ready(function() {
      $('#BorrarFiltros').click(function() {
        $('#filtros_estadisticas')[0].reset();
        window.location.reload();
      })
    });
  </script>

  <script src="../../global/dist/js/adminlte.min.js"></script>
  <script src="../../global/dist/jquery/jquery-3.3.1.min.js"></script>
  <script src="../../global/dist/popper/popper.min.js"></script>
  <script src="../../global/dist/bootstrap/js/bootstrap.min.js"></script>

  <!-- datatables JS -->
  <script type="text/javascript" src="../../global/dist/datatables/datatables.min.js"></script>

  <!-- para usar botones en datatables JS -->
  <script src="../../global/dist/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
  <script src="../../global/dist/datatables/JSZip-2.5.0/jszip.min.js"></script>
  <script src="../../global/dist/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
  <script src="../../global/dist/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
  <script src="../../global/dist/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>

  <!-- código JS propìo-->
  <script type="text/javascript" src="../../global/dist/js/main.js"></script>

  </body>

  </html>