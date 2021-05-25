<?php
// llamada a archivo db (conexión mysql)
require_once('../../config/db.php');


if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $query = "SELECT 
    UM.Id as Id_User_Mod,
    UM.Id_Usuario,
    U.NombreUs,
    UM.Id_Modulo,
    M.Modulo
    FROM usuario_modulo UM
    LEFT JOIN usuario U ON UM.Id_Usuario=u.Id_Usuario
    LEFT JOIN modulo M ON M.Id_Modulo=UM.Id_Modulo
    WHERE UM.Id_Usuario=$id";
    $result = mysqli_query($conn, $query);
    $result_b = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result_b);

    if ($row == null) {
        $row = array(
            "Id_Usuario" => 0
        );
    }


    $query2 = "SELECT M.* 
    FROM Modulo M
    WHERE M.Estado_Modulo=1
    AND Id_Modulo NOT IN (
    SELECT DISTINCT Id_Modulo FROM usuario_modulo WHERE Id_Usuario=$row[Id_Usuario])";
    $result2 = mysqli_query($conn, $query2);
}

if (isset($_POST['asignar'])) {

    $id_usuario = $_POST['id_usuario'];
    $id_modulo = $_POST['id_modulo'];
    $query = "INSERT INTO usuario_modulo(Id_Usuario,Id_Modulo) VALUES ('$id_usuario', '$id_modulo')";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Query Failed.");
    }

    header("Location: edit.php?id=$id_usuario");
}

if (isset($_POST['volver'])) {
    header('Location: asig_modulo.php');
}

if (isset($_POST['quitar'])) {

    $id_user_mod = $_POST['id_user_mod'];
    $id_usuario = $_POST['id_usuario'];
    $query = "DELETE  FROM usuario_modulo WHERE Id=$id_user_mod";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Query Failed.");
    }
    header("Location: edit.php?id=$id_usuario");
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

                <main class="container p-4">
                    <div class="row">
                        <div class="col-md-4">
                            <!-- ADD TASK FORM -->
                            <div class="card card-body">
                                <form action="edit.php" method="POST">

                                    <input type="hidden" name="id_usuario" class="form-control form-group" value="<?php echo $id ?>">

                                    <h6 class="mb-2">Categorías Habilitadas :</h6>
                                    <select name="id_modulo" class="form-control form-group pull-right text-uppercase align-end" required>
                                        <?php
                                        while ($umarray = mysqli_fetch_assoc($result2)) { ?>
                                            <option value="<?php echo $umarray['Id_Modulo'] ?>"> <?php echo $umarray["Modulo"] ?> </option>
                                        <?php } ?>

                                    </select>

                                    <input type="submit" name="asignar" class="btn btn-success btn-block mb-1" value="Asignar Categoría">
                                </form>
                                <form action="edit.php" method="POST">
                                <input type="submit" name="volver" class="btn btn-primary btn-block" value="Volver">
                                </form>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Usuario</th>
                                        <th>Categorías Asignadas</th>
                                        <th style="width: 75px;">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    while ($row1 = mysqli_fetch_assoc($result)) { ?>
                                        <tr>
                                            <td><?php echo $row1['NombreUs']; ?></td>
                                            <td><?php echo $row1['Modulo']; ?></td>
                                            <td>
                                                <form action="edit.php" method="POST">
                                                    <input type="hidden" name="id_user_mod" class="form-control form-group" value="<?php echo $row1['Id_User_Mod'] ?>">
                                                    <input type="hidden" name="id_usuario" class="form-control form-group" value="<?php echo $id ?>">
                                                    <input type="submit" name="quitar" class="btn btn-danger" value="Quitar">
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </main>


                <!-- <div class="col-md-4 mx-auto">
                    <div class="card card-body">

                        <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <h6 class="">ID:</h6>
                                <input name="idmodulo" type="number" class="form-control" value="<?php echo $id; ?>" readonly="readonly">
                            </div>
                            <div class="form-group">
                                <h6 class="">Categoría:</h6>
                                <input autocomplete="off" name="categoria" type="text" class="form-control" value="<?php echo $modulo; ?>" placeholder="Escribir categoría aquí" readonly="readonly>
              </div>
              <div class=" form-group">
                                <h6 class="">Código:</h6>
                                <input autocomplete="off" name="codigo" type="text" class="form-control" value="<?php echo $cod_modulo; ?>" placeholder="Escribir código aquí" readonly="readonly>
              </div>
              <div class=" form-group">
                                <h6 class="">Estado:</h6>
                                <select class="form-control" name="estado" id="sel1" required>
                                    <option <?php if ($row['Estado_Modulo'] == 1) {
                                                echo "selected";
                                            } ?> value="1">Habilitado</option>
                                    <option <?php if ($row['Estado_Modulo'] == 0) {
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
                </div> -->



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