<?php
//
// llamada a archivo base (conexión mysql)
require('../../config/db.php');

// PARTE SUPERIOR DEL DASHBOARD HTML
require_once('../../global/header.php');

$nombreUs = $_SESSION['usuario']->nombreUs;
$consul= mysqli_query($conn, "SELECT * FROM usuario WHERE NombreUs = '$nombreUs'");
$result= mysqli_fetch_array($consul, MYSQLI_ASSOC);
$puesto = $result['Id_Puesto'];
$idUsuario = $result['Id_Usuario'];



//Query usuarios_modulos
$umsql= "SELECT 
`usuario_modulo`.`Id_Usuario`,
`usuario_modulo`.`Id_Modulo`,
`modulo`.`Modulo`
FROM `usuario_modulo` 
INNER JOIN `modulo` ON `modulo`.`Id_Modulo`= `usuario_modulo`.`Id_Modulo` 
WHERE `usuario_modulo`.`Id_Usuario`= $idUsuario";
// $umsql= "SELECT *
// FROM `modulo`  
// WHERE `Estado_Modulo`=1";
//validar con session a consulta $umsql
$umexecute= mysqli_query($conn, $umsql);
?>

<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">
      <div class="row">

        <!-- AREA DE TRABAJO -->


        <main class="container-fluid">

            <?php 
            if(isset($_GET['sinturnos']) == 1){ ?>
              <div class='alert alert-info'>
              <strong>¡No hay turnos pendientes!</strong> Espere.
              <button type="button" class="close" data-hide="alert">&times;</button>
              <script type="text/javascript">
              $(function(){
              $("[data-hide]").on("click", function(){
               $(this).closest("." + $(this).attr("data-hide")).hide();
                });
              });
              </script>
              </div>
              <meta http-equiv="refresh" content="30"/>
              <script>
                setTimeout(function() {
                location.reload();
                }, 5000);
                
              </script>
              <?php } ?>
              
              <?php 
              if(isset($_GET['finalizado']) == 1){ ?> 
              <div class='alert alert-info'>
              <strong>¡Turno finalizado!</strong>
              <button type="button" class="close" data-hide="alert">&times;</button>
              <script type="text/javascript">
              $(function(){
              $("[data-hide]").on("click", function(){
               $(this).closest("." + $(this).attr("data-hide")).hide();
                });
              });
              </script>
              </div>
              <?php }
              
              if(isset($_GET['anulado']) == 1){ ?>
                <div class='alert alert-danger'>
                <strong>¡Turno anulado!</strong>
                <button type="button" class="close" data-hide="alert">&times;</button>
                <script type="text/javascript">
                $(function(){
                $("[data-hide]").on("click", function(){
                 $(this).closest("." + $(this).attr("data-hide")).hide();
                });
                });
              </script>
                </div>
              
            <?php } ?>
            
            <!-- Vista cuando puesto designado tenga algun dato cargado (con la que hay que trabajar) -->

            <?php 
              if(!empty($result["Id_Puesto"]) || $result["Id_Puesto"] != null){
                
            ?>
            <section class="content" id="atencionSecAtencionturnos">
            <div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title hidden-xs"><i class="fa fa-bullhorn"></i> Atención de Turnos</h3>
                    </div>
                    <div class="box-body">
                    <div class="row">
                        <div class="col-sm-6" id="log">
                            <div class="form-group">
                                <label for="">Turno Actual:</label>
                                <div class="input-group">
                                  <div class="input-group-prepend"> 
                                    <span class="input-group-text bg-dark">@</span>
                                  </div>
                                    <input id="esperaTxtTramiteActual" name="turnoactual" value="<?php if(!empty($_SESSION['resultado']["Turno"])){ echo $_SESSION['resultado']["Turno"]; }else{echo "Sin turnos";} ?>" type="text" class="form-control pull-right text-uppercase atencionTxtClassCampos" disabled="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Modulo Actual:</label>
                                <div class="input-group">
                                  <div class="input-group-prepend"> 
                                    <span class="input-group-text bg-dark">@</span>
                                  </div>
                                  <input id="esperaTxtTurnoActual" value="<?php if(!empty($_SESSION['ejecutar']["Modulo"])){ echo $_SESSION['ejecutar']["Modulo"];}elseif(empty($_SESSION['ejecutar']["Modulo"])){ echo "Seleccione Modulo";}else{echo "Sin turnos";} ?>" type="text" class="form-control pull-right text-uppercase atencionTxtClassCampos" disabled="">
                                </div>
                            </div>
                            
                            <div class="row">
                              <div class="col-sm-6">
                                <div><label for="">Turnos general en espera:</label></div>
                                  <div class="input-group-prepend">
                                  <span class="input-group-text bg-dark">@</span>
                                    <div class="input-group-prepend">
                                      <input type="text" class="form-control" name="tespera" value="<?php 
                                      $qery = "SELECT Turno FROM turnos_tomados WHERE Id_Estado= 1";
                                      if ($smt = mysqli_prepare($conn, $qery)) {
                                          /* execute query */
                                          mysqli_stmt_execute($smt);
                                          /* store result */
                                          mysqli_stmt_store_result($smt);
                                          printf("%d\n", mysqli_stmt_num_rows($smt));
                                      }?>" disabled>
                                    </div>
                                    </div>
                                  </div>
                              
                            <div class="form-group col-sm-6 ">
                                <label for="">Turnos Atendidos:</label>
                                <div class="input-group ">
                                  <div class="input-group-prepend"> 
                                    <span class="input-group-text bg-dark">@</span>
                                  </div>
                                    <input id="esperaTxtTurnoAtendidos" type="text" value="<?php 
                                    $query = "SELECT Turno FROM turnos_tomados WHERE Id_Estado= 6";
                                    if ($stmt = mysqli_prepare($conn, $query)) {
                                        /* execute query */
                                        mysqli_stmt_execute($stmt);
                                        /* store result */
                                        mysqli_stmt_store_result($stmt);
                                        printf("%d\n", mysqli_stmt_num_rows($stmt));
                                    }?>" class="form-control pull-right text-uppercase atencionTxtClassCampos" disabled="">
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Turnos Anulados:</label>
                                <div class="input-group">
                                  <div class="input-group-prepend"> 
                                    <span class="input-group-text bg-dark">@</span>
                                  </div>
                                  <input id="esperaTxtTurnoAnulados" type="text"  class="form-control pull-right text-uppercase atencionTxtClassCampos" disabled="" value="<?php 
                                    $query = "SELECT Turno FROM turnos_tomados WHERE Id_Estado= 4";
                                    if ($stmt = mysqli_prepare($conn, $query)) {
                                        /* execute query */
                                        mysqli_stmt_execute($stmt);
                                        /* store result */
                                        mysqli_stmt_store_result($stmt);
                                        printf("%d\n", mysqli_stmt_num_rows($stmt));
                                    }?>">
                                
                            
                                   </div>
                                    <br>
                                   <form action="consul.php" method="post">
                                   <label for="modul">Modulo asignados:</label>
                                    <select name="modulo" id="" class="form-control pull-right text-uppercase align-end">
                                    <?php
                                      while($umarray= mysqli_fetch_array($umexecute, MYSQLI_ASSOC)){?>
                                     <option value="<?php echo $umarray['Id_Modulo'] ?>"> <?php echo $umarray["Modulo"] ?> </option>
                                    <?php } ?>
                                    <?php if($_SESSION["tt"]["Id_Estado"] == 3 || $_SESSION["tt"]["Id_Estado"] == 5 || mysqli_stmt_num_rows($smt) == 0){?>
                                    <input type="submit" name="llamar" value="Siguiente" class="btn btn-success mt-3" disabled>
                                    </select>
                                    <?php }else{ ?>
                                      <input type="submit" name="llamar" value="Siguiente" class="btn btn-success mt-3" >
                                    </select> 
                                    <?php } ?> 
                                    </form>
                            </div></div>
                        </div>
                                                    
                        <div class="box-body col-sm-6" id="atencionDivContenedorMenu">
                            <section class="content">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <br>
                                        <?php if($_SESSION["tt"]["Id_Estado"] == 5 || $_SESSION["tt"]["Id_Estado"] == 6 || empty($_SESSION["tt"]["Id_Estado"]) || $_SESSION["tt"]["Id_Estado"] == 4) { ?>
                                        <button class="info-box bg-olive btn atender" name="sonido" disabled>
                                            <span class="info-box-icon"></span>
                                            <div class="info-box-content puntero" id="atencionBtnLlamar">
                                                <br>
                                                <span class="info-box-text text-center">
                                                <script>
                                                    let boton = document.querySelector(".atender")
                                                    boton.addEventListener("click", () => {
                                                    let etiquetaAudio = document.createElement("audio")
                                                    etiquetaAudio.setAttribute("src", "./audio.mp3")
                                                    etiquetaAudio.play()
                                                  })
                                                </script>
                                                
                                                    <h4 class="mr-3"><i class="fa fa-phone mr-3"></i><b>Llamar</b></h4>
                                                </span>                  
                                            </div>
                                        </button>
                                                <?php }else{ ?>
                                                  <button class="info-box bg-olive btn atender" name="sonido">
                                            <span class="info-box-icon"></span>
                                            <div class="info-box-content puntero" id="atencionBtnLlamar">
                                                <br>
                                                <span class="info-box-text text-center">
                                                <script>
                                                    let boton = document.querySelector(".atender")
                                                    boton.addEventListener("click", () => {
                                                    let etiquetaAudio = document.createElement("audio")
                                                    etiquetaAudio.setAttribute("src", "./audio.mp3")
                                                    etiquetaAudio.play()
                                                  })
                                                </script>
                                                
                                                    <h4 class="mr-3"><i class="fa fa-phone mr-3"></i><b>Llamar</b></h4>
                                                </span>                  
                                            </div>
                                        </button>
                                                <?php } ?>

                                          <form action='consul.php' method='post'>
                                          <?php if($_SESSION["tt"]["Id_Estado"] == 5 || $_SESSION["tt"]["Id_Estado"] == 6 || $_SESSION["tt"]["Id_Estado"] == 4 || empty($_SESSION["tt"]["Id_Estado"])) { ?>
                                          <button class='info-box bg-green btn' name='atender' onClick='sigue()' disabled>
                                            <span class='info-box-icon'></span>
                                               <div class='info-box-content puntero' id='atencionBtnAtender'>
                                                 <br>
                                                   <span class='info-box-text text-center'>                     
                                                    <h4 class="mr-3"><i class='fa fa-check mr-3'></i><b>Atender</b></h4>
                                                   </span>                  
                                                </div>
                                            </button>
                                          <?php }else{ ?>
                                            <button class='info-box bg-green btn' name='atender' onClick='sigue()' >
                                            <span class='info-box-icon'></span>
                                               <div class='info-box-content puntero' id='atencionBtnAtender'>
                                                 <br>
                                                   <span class='info-box-text text-center'>                     
                                                    <h4 class="mr-3"><i class='fa fa-check mr-3'></i><b>Atender</b></h4>
                                                   </span>                  
                                                </div>
                                            </button>

                                          <?php } ?>               
                                        </form>                                                        
                                    </div>
                                    
                                    <div class="col-sm-6"><br>
                                        <form action="consul.php" method="post">
                                        <?php if($_SESSION["tt"]["Id_Estado"] == 3 || $_SESSION["tt"]["Id_Estado"] == 1 || $_SESSION["tt"]["Id_Estado"] == 6 || $_SESSION["tt"]["Id_Estado"] == 4 || empty($_SESSION["tt"]["Id_Estado"])) { ?>
                                        <button class="info-box bg-orange btn" name="finalizar" onClick="para()" disabled>
                                            <span class="info-box-icon"></span>
                                            <div class="info-box-content puntero" id="atencionBtnFinalizar">
                                                <br>
                                                <span class="info-box-text text-center">                      
                                                    <h4 class="mr-2"><i class="fa fa-ban mr-3"></i><b>Finalizar</b></h4>
                                                </span>                  
                                            </div>
                                        </button>
                                        <?php }else{ ?>
                                          <button class="info-box bg-orange btn" name="finalizar" >
                                            <span class="info-box-icon"></span>
                                            <div class="info-box-content puntero" id="atencionBtnFinalizar">
                                                <br>
                                                <span class="info-box-text text-center">                      
                                                    <h4 class="mr-2"><i class="fa fa-ban mr-3"></i><b>Finalizar</b></h4>
                                                </span>                  
                                            </div>
                                        <?php }  ?>
                                        </form>


                                        <form action="consul.php" method="post">
                                        <?php if($_SESSION["tt"]["Id_Estado"] == 5 || $_SESSION["tt"]["Id_Estado"] == 6 || $_SESSION["tt"]["Id_Estado"] == 4 || empty($_SESSION["tt"]["Id_Estado"])) { ?>
                                        <button class="info-box bg-red btn" name="anular" disabled>
                                            <span class="info-box-icon"></span>
                                            <div class="info-box-content puntero" id="atencionBtnAnular">
                                                <br>
                                                <span class="info-box-text text-center">                      
                                                    <h4 class="mr-4"><i class="fa fa-trash mr-3"></i><b>Anular</b></h4>
                                                </span>                  
                                            </div>
                                            </button>
                                        <?php }else{ ?>
                                        <button class="info-box bg-red btn" name="anular">
                                            <span class="info-box-icon"></span>
                                            <div class="info-box-content puntero" id="atencionBtnAnular">
                                                <br>
                                                <span class="info-box-text text-center">                      
                                                    <h4 class="mr-4"><i class="fa fa-trash mr-3"></i><b>Anular</b></h4>
                                                </span>                  
                                            </div>
                                            </button>
                                        <?php } ?>
                                        </form>
                                    </div>
                                 
                                </div>
                            </section>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </section>                       







        <!-- Atentos a esto -->                                    






        <?php
          //Cierre if vista cuando Id_Puesto no esta vacio
          }else{
            ?>
          <!-- Vista en caso tener Id_Puesto vacio o null -->
          <section class="content" id="atencionSecAtencionturnos">
            <div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title hidden-xs"><i class="fa fa-bullhorn"></i> Atención de Turnos</h3>
                    </div>
                    <div class="box-body">
                    <div class="row">
                        <div class="col-sm-6" id="log">
                            <div class="form-group">
                                <label for="">Turno Actual:</label>
                                <div class="input-group">
                                  <div class="input-group-prepend"> 
                                    <span class="input-group-text bg-dark">@</span>
                                  </div>
                                    <input id="esperaTxtTramiteActual" name="turnoactual" value="Se debe asignar un puesto" type="text" class="form-control pull-right text-uppercase atencionTxtClassCampos" disabled="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Modulo Actual:</label>
                                <div class="input-group">
                                  <div class="input-group-prepend"> 
                                    <span class="input-group-text bg-dark">@</span>
                                  </div>
                                  <input id="esperaTxtTurnoActual" value="Se debe asignar puesto" type="text" class="form-control pull-right text-uppercase atencionTxtClassCampos" disabled="">
                                </div>
                            </div>
                            
                            <div class="row">
                              <div class="col-sm-6">
                                <div><label for="">Turnos general en espera:</label></div>
                                  <div class="input-group-prepend">
                                  <span class="input-group-text bg-dark">@</span>
                                    <div class="input-group-prepend">
                                      <input type="text" class="form-control text-uppercase" name="tespera" value="Deshabilitado" disabled>
                                    </div>
                                    </div>
                                  </div>
                              
                            <div class="form-group col-sm-6 ">
                                <label for="">Turnos Atendidos:</label>
                                <div class="input-group ">
                                  <div class="input-group-prepend"> 
                                    <span class="input-group-text bg-dark">@</span>
                                  </div>
                                    <input id="esperaTxtTurnoAtendidos" type="text" value="Deshabilitado" class="form-control pull-right text-uppercase atencionTxtClassCampos" disabled="">
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Turnos Anulados:</label>
                                <div class="input-group">
                                  <div class="input-group-prepend"> 
                                    <span class="input-group-text bg-dark">@</span>
                                  </div>
                                  <input id="esperaTxtTurnoAnulados" type="text"  class="form-control pull-right text-uppercase atencionTxtClassCampos" disabled="" value="Deshabilitado">
                                   </div>
                                    <br>
                                   <form action="consul.php" method="post">
                                   <label for="modul">Modulo asignados:</label>
                                   <select name="modulo" id="" class="form-control pull-right text-uppercase align-end">
                                    <?php
                                      while($umarray= mysqli_fetch_array($umexecute, MYSQLI_ASSOC)){?>
                                     <option value="<?php echo $umarray['Id_Modulo'] ?>"> <?php echo $umarray["Modulo"] ?> </option>
                                    <?php } ?>
                                      <input type="submit" name="llamar" value="Siguiente" class="btn btn-success mt-3" disabled><br>
                                    </select> 
                                    </form>
                            </div></div>
                        </div>
                                                    
                        <div class="box-body col-sm-6" id="atencionDivContenedorMenu">
                            <section class="content">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <br>
                                        <!-- <form method="post"> -->
                                        
                                        <button class="info-box bg-olive btn atender" name="sonido" disabled>
                                            <span class="info-box-icon"></span>
                                            <div class="info-box-content puntero" id="atencionBtnLlamar">
                                                <br>
                                                <span class="info-box-text text-center">
                                                <script>
                                                    let boton = document.querySelector(".atender")
                                                    boton.addEventListener("click", () => {
                                                    let etiquetaAudio = document.createElement("audio")
                                                    etiquetaAudio.setAttribute("src", "./audio.mp3")
                                                    etiquetaAudio.play()
                                                  })
                                                </script>
                                                
                                                    <h4 class="mr-3"><i class="fa fa-phone mr-3"></i><b>Llamar</b></h4>
                                                </span>                  
                                            </div>
                                        </button>
                           
                                        <!-- </form> -->
                                        
                                          <form action='consul.php' method='post'>
                                          <button class='info-box bg-green btn' name='atender' onClick='sigue()' disabled>
                                            <span class='info-box-icon'></span>
                                               <div class='info-box-content puntero' id='atencionBtnAtender'>
                                                 <br>
                                                   <span class='info-box-text text-center'>                     
                                                    <h4 class="mr-3"><i class='fa fa-check mr-3'></i><b>Atender</b></h4>
                                                   </span>                  
                                                </div>
                                            </button>               
                                        </form>
                                                        
                                    </div>
                                    <div class="col-sm-6"><br>
                                        <form action="consul.php" method="post">
                                        <button class="info-box bg-orange btn" name="finalizar" onClick="para()" disabled>
                                            <span class="info-box-icon"></span>
                                            <div class="info-box-content puntero" id="atencionBtnFinalizar">
                                                <br>
                                                <span class="info-box-text text-center">                      
                                                    <h4 class="mr-2"><i class="fa fa-ban mr-3"></i><b>Finalizar</b></h4>
                                                </span>                  
                                            </div>
                                        </button>
                                        </form>
                                        <form action="consul.php" method="post">
                                        <button class="info-box bg-red btn" name="anular" disabled>
                                            <span class="info-box-icon"></span>
                                            <div class="info-box-content puntero" id="atencionBtnAnular">
                                                <br>
                                                <span class="info-box-text text-center">                      
                                                    <h4 class="mr-4"><i class="fa fa-trash mr-3"></i><b>Anular</b></h4>
                                                </span>                  
                                            </div>
                                            </button>
                                        </form>
                                    </div>
                                 
                                </div>
                            </section>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </section>
          <?php  
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