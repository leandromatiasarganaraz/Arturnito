<?php
// llamada a archivo db (conexión mysql)
require_once('../../config/db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM usuario WHERE Id_Usuario = $id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $nombreUs = $row['NombreUs'];
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query2 = "SELECT usuario.NombreUs, usuario.Id_Puesto, puesto.Puesto
    FROM puesto
    INNER JOIN usuario ON usuario.Id_Puesto=puesto.Id_Puesto WHERE usuario.Id_Usuario = $id";
    $result_task = mysqli_query($conn, $query2);
}

if (isset($_POST['asignar'])) {
    $id = $_POST['id_usuario'];
    $nombreUs = $_POST['nombreUs'];
    $id_puesto = $_POST['puesto'];

    $query = "UPDATE usuario set NombreUs = '$nombreUs', Id_Puesto = '$id_puesto' WHERE Id_Usuario='$id'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Query Failed.");
    }

    header("Location: carga_puesto.php?id=$id");
}

if (isset($_POST['quitar'])) {

    $id = $_POST['id_usuario'];
    $query = "UPDATE usuario set Id_Puesto = NULL WHERE Id_Usuario='$id'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Query Failed.");
    }
    header("Location: carga_puesto.php?id=$id");
}


if (isset($_POST['volver'])) {
    header('Location: asig_puesto.php');
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

            </div>
        </div>
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

                                <form action="carga_puesto.php" method="POST" enctype="multipart/form-data">

                                    <input type="hidden" name="id_usuario" class="form-control form-group" value="<?php echo $id ?>">
                                    <div class="form-group">
                                        <h6>Nombre de usuario:</h6>
                                        <input autocomplete="off" name="nombreUs" type="text" class="form-control" value="<?php echo $nombreUs; ?>" placeholder="Escribir categoría aquí" readonly="readonly">
                                    </div>

                                    <div>
                                        <h6 class="">Puestos disponibles:</h6>
                                        <?php
                                        $query = "SELECT 
                                 p.Id_Puesto,
                                 p.Puesto,
                                 p.Estado_puesto 
                                 FROM puesto p 
                                 WHERE Estado_puesto = 1
                                 AND p.Id_Puesto NOT IN (SELECT DISTINCT CASE WHEN u.Id_Puesto IS NULL THEN 0 ELSE u.Id_Puesto END AS Id_Puesto  FROM usuario u)";
                                        $result = mysqli_query($conn, $query);
                                        ?>
                                        <select class="form-control" name="puesto" required>
                                            <?php

                                            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
                                                <option value="<?php echo $row['Id_Puesto'] ?>">
                                                    <?php echo $row["Puesto"]; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <input type="submit" name="asignar" class="btn btn-success btn-block mb-1 mt-4" value="Asignar Puesto">

                                </form>
                                <form action="carga_puesto.php" method="POST" enctype="multipart/form-data">
                                    <input type="submit" name="volver" class="btn btn-primary btn-block mb-1 mt-1" value="Volver">
                                </form>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Usuario</th>
                                        <th>Modulo Asignado</th>
                                        <th style="width: 75px;">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row1 = mysqli_fetch_assoc($result_task)) { ?>
                                        <tr>
                                            <td><?php echo $row1['NombreUs']; ?></td>
                                            <td><?php echo $row1['Puesto']; ?></td>
                                            <td>
                                                <form action="carga_puesto.php" method="POST">
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