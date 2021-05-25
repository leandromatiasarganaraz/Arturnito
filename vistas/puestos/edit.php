<?php
// llamada a archivo db (conexión mysql)
require_once('../../config/db.php');


$row = '';
$puesto = '';
$estado = '';
$fecha_alta = '';


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM puesto WHERE Id_Puesto=$id";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $puesto = $row['Puesto'];
        $estado = $row['Estado_puesto'];
        $fecha_alta = $row['Fecha_Alta'];
    }
}

if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $puesto = ucwords(strtolower($_POST['puesto']));
    $estado = $_POST['estado'];
    $fecha_alta = $_POST['fecha_alta'];

    $query = "UPDATE puesto set Puesto = '$puesto', Estado_puesto = '$estado', Fecha_Alta = '$fecha_alta'  WHERE Id_Puesto='$id'";
    mysqli_query($conn, $query);
    if ($estado == 0) {
        $query2 = "UPDATE usuario SET Id_Puesto=NULL WHERE Id_Puesto = $id";
        mysqli_query($conn, $query2);
    }


    $_SESSION['message'] = 'Puesto actualizado';
    $_SESSION['message_type'] = 'warning';
    header('Location: puestos.php');
}

if (isset($_POST['cancel'])) {

    header('Location: puestos.php');
}

?>

<?php

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
    <!-- CONTENIDO PRINCIPAL --ACA VA SU MODULO -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <!-- AREA DE TRABAJO -->

                <div class="col-md-4 mx-auto">
                    <div class="card card-body">

                        <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="POST" enctype="multipart/form-data">
                            <!-- <div class="form-group">
                <h6 class="">ID:</h6>
                <input name="idPuesto" type="number" class="form-control" value="<?php echo $id; ?>" readonly="readonly">
              </div> -->
                            <div class="form-group">
                                <h6 class="">Puesto:</h6>
                                <input autocomplete="off" name="puesto" type="text" class="form-control" value="<?php echo $puesto; ?>" placeholder="Escribir nombre de puesto aquí" readonly="readonly">
                            </div>
                            <div class="form-group">
                                <h6 class="">Estado:</h6>
                                <select class="form-control" name="estado" id="sel1" required>
                                    <option <?php if ($row['Estado_puesto'] == 1) {
                                                echo "selected";
                                            } ?> value="1">Habilitado</option>
                                    <option <?php if ($row['Estado_puesto'] == 0) {
                                                echo "selected";
                                            } ?> value="0">Deshabilitado</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <h6 class="">Fecha de alta:</h6>
                                <input name="fecha_alta" type="datetime" class="form-control" value="<?php echo $fecha_alta; ?>" readonly="readonly">
                            </div>
                            <button class="btn btn-success" name="update">
                                Actualizar
                            </button>
                            <button class="btn btn-danger" name="cancel">
                                Cancelar
                            </button>
                        </form>
                    </div>
                </div>



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