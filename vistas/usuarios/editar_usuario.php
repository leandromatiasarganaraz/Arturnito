<?php
// llamada a archivo base (conexión mongoDB)
require('../../config/dbMongo.php');

// PARTE SUPERIOR DEL DASHBOARD HTML
require_once('../../global/header.php');


?>
 

<div class="container p-4">
    <div class="row">
        <div class="col-md-5 mx-auto">
            <div class="colorfondo2 card card-body">
                <form action="actualizar_usuario.php" method="POST" enctype="multipart/form-data">
                    <h2 class="colorfondo2 text-center text-white"><i class="fas fa-users-cog"></i> Editar Usuario</h2>
                    <a href="usuarios.php" class="btn btn-primary btn-block mt-3 mb-2">Ir a la lista de usuarios</a>
                    <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
                    <?php

                    $bulk = new MongoDB\Driver\BulkWrite;
                    $id = $_GET["id"];
                    $filter = ['_id' => new MongoDB\BSON\ObjectId($id)];

                    $query = new MongoDB\Driver\Query($filter);

                    $rows = $manager->executeQuery($dbname, $query);
                    foreach ($rows as $row) { ?>

                    <div class="form-group">
                    <h6 class="text-white">Nombre:</h6> 
                    <input autocomplete="off" name="nombre" minlength="2" maxlength="20" pattern="[a-zA-Z ]{2,20}" id="nombre" type="text" class="form-control" value="<?php echo $row->nombre; ?>" placeholder="Escribir nombre aquí" required title="El nombre debe tener entre 2 y 20 caracteres. Sin números, ni símbolos especiales">
                    </div>
                        <div class="form-group">
                        <label class="text-white" for="apellido">Apellido:</label> 
                            <input type="text" class="form-control" id="apellido" minlength="2" maxlength="20" pattern="[a-zA-Z ]{2,20}" name="apellido" value="<?php echo $row->apellido; ?>" placeholder="Escribir apellido aquí" required title="El apellido debe tener entre 2 y 20 caracteres. Sin números, ni símbolos especiales">
                        </div>
                        <div class="form-group">
                         <label class="text-white" for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $row->email; ?>" pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$"  placeholder="Escribir email aquí" required>
                        </div>
                        <div class="form-group">
                       <label class="text-white" for="nombreUs">Nombre de usuario: </label> 
                            <input type="text" class="form-control" id="nombreUs" minlength="2" maxlength="10" pattern="[a-zA-Z ]{2,20}" name="nombreUs" value="<?php echo $row->nombreUs; ?>" placeholder="Escribir nombre de usuario aquí" title="El nombre de usuario debe tener entre 2 y 20 caracteres. Sin números, ni símbolos especiales"> 
                        </div>

                        <input type="hidden" class="form-control" id="clave" minlength="2" maxlength="20" name="clave" value="<?php echo $row->contraseña ?>" placeholder=" " readonly="readonly">

                        <div class="form-group">
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
                        <div class="form-group">
                            <h6 class="text-white" for="estado" class="">Estado:</h6>
                            <select class="form-control" name="estado" id="sel1" required>
                                <option <?php if ($row->estado == 1) {
                                            echo "selected";
                                        } ?> value="1">Habilitado</option>

                                <option <?php if ($row->estado == 0) {
                                            echo "selected";
                                        } ?> value="0">Deshabilitado</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="contraseña" value="<?php echo $_GET["contraseña"]; ?>">
                        </div>
                        <div class="form-group">
                            <h6 class="text-white">Fecha de alta:</h6>
                            <input type="text" name="dia" class="form-control" value="<?php echo $row->dia ?>" placeholder=" " required readonly="readonly">
                        </div>
                        <input type="submit" value="Actualizar" class="btn btn-primary btn-block">
                </form>
            <?php } ?>
            </div>
        </div>
    </div>

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
    </script>



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