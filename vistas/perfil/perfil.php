<?php
// llamada a archivo db (conexión mongoDB)
require_once('../../config/dbMongo.php');
require_once('../../config/var_globales.php');
// PARTE SUPERIOR DEL DASHBOARD HTML
require_once('../../global/header.php');

require_once('../../config/db.php');
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

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <?php 
                  $SelectFoto= "SELECT Foto FROM usuario WHERE NombreUs = '".$_SESSION['usuario']->nombreUs."'";
                  $QueryFoto=mysqli_query($conn,$SelectFoto) or die ('No se pudo consultar la foto de perfil en usuarios<br>'.mysqli_error($conn));
                  $PedirDato = $QueryFoto->fetch_assoc();
                  ?>
       

                 <img src="<?php echo $PedirDato['Foto'] ?>" class="img-circle elevation-2" width="300" height="300" alt="User Image">
                
                  
                </div>

                <h3 class="profile-username text-center"><?php echo $nombre = ucwords($_SESSION['usuario']->nombre)." ".$apellido = ucwords($_SESSION['usuario']->apellido)?></h3>
                


                <?php $Id_RolMongo = ucwords($_SESSION['usuario']->rol);

                if($Id_RolMongo == 1){

                  $Rol = 'Administrador';
                }

                elseif ($Id_RolMongo == 2) {
                  $Rol = "Usuario";
                }

                ?>

                <p class="text-muted text-center"><?php echo $Rol?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Email</b> <a class="float-right"><?php echo $email = ucwords($_SESSION['usuario']->email)?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Nombre de usuario</b> <a class="float-right"><?php echo $nombreUs = ucwords($_SESSION['usuario']->nombreUs)?></a>
                  </li>
                </ul>

            
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-foto" style='width:100%'>
                  Cambiar foto de perfil  
                </button>
 

                  <?php

              $bulk = new MongoDB\Driver\BulkWrite;
        
              $filter = ['nombreUs' => $_SESSION['usuario']->nombreUs ];

              $query = new MongoDB\Driver\Query($filter);

              $rows = $manager->executeQuery($dbname, $query);
                foreach ($rows as $row) { ?>

                      <a href="cambiar_contraseña.php?id=<?php echo $row->_id ?>

                      " class="btn btn-secondary" style='width:100%'> <i class="fas fa-key"></i> Cambiar contraseña </a>
            
                
                
                <?php } ?>
         

          
              <!-- /.card-body --> 
          <!-- /.col -->

 

          <div class="modal fade" id="modal-foto">
        <div class="modal-dialog">
          <div class="modal-content bg-primary">
            <div class="modal-header">
            <label class="text-white" for="">Cambiar mi foto de perfil</label>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
          <div class="text-center">
    <?php 
     $SelectFoto= "SELECT Foto FROM usuario WHERE NombreUs = '".$_SESSION['usuario']->nombreUs."'";
     $QueryFoto=mysqli_query($conn,$SelectFoto) or die ('No se pudo consultar la foto de perfil en usuarios<br>'.mysqli_error($conn));
     $PedirDato = $QueryFoto->fetch_assoc();
    ?>
            <img src="<?php echo $PedirDato['Foto'] ?>" class="img-circle elevation-2" alt="User Image" width="150" height="150" ><br>
          </div>
          <form method="POST" action="" enctype="multipart/form-data">
                        <div class="FotoPerfil">
                            <br>
                            <input type="file" class="form-control" name="foto">
                        </div>
            </div>
            <div class="modal-footer justify-content-between">
              <input type="submit" name="Cambiar" value="Guardar cambios" class="btn btn-secondary btn-block">
             


              <!--<button type="button" class="btn btn-default btn-block" data-dismiss="modal">Cancelar</button>-->
                         </div></form>
                         <?php 
      if (isset($_POST['Cambiar'])) {
        $Direccion = "fotoperfil/";
        $Archivo = $Direccion.basename($_FILES['foto']['name']); // basename() retorna el nombre del archivo de una direccion especifica
        $DireccionCompleta = $Direccion.$_SESSION['usuario']->nombreUs.".jpg";
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $DireccionCompleta)) {
        chmod ($DireccionCompleta, 0777);
            $CargarFoto = $conn->query("UPDATE usuario SET Foto = '$DireccionCompleta' WHERE NombreUs = '".$_SESSION['usuario']->nombreUs."'");
            echo '<script type="text/javascript"> window.location="perfil.php";   </script>';
        }
      }
    ?>
 
         

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
