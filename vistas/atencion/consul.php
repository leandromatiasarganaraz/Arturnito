<?php
require('../../config/db.php');
session_start();
    $nombreUs = $_SESSION['usuario']->nombreUs;
    $consul= mysqli_query($conn, "SELECT Id_Puesto, Id_Usuario FROM usuario WHERE NombreUs = '$nombreUs'");
    $result= mysqli_fetch_array($consul, MYSQLI_ASSOC);
    $puesto = $result['Id_Puesto'];
      $user= $result['Id_Usuario'];
    
  //Query tabla turnos tomados
  if(isset($_POST["llamar"])){
    if($smt == null || empty($smt)){
      header("Location: atencion.php?sinturnos");
    }
    $modulo= $_POST['modulo'];
    $sql= mysqli_query($conn, "SELECT * FROM turnos_tomados WHERE Id_Estado = 1 AND Id_Modulo = $modulo ORDER BY Id_TTomados LIMIT 1");
    $result= mysqli_fetch_array($sql, MYSQLI_ASSOC);
    $queryM= "SELECT * FROM modulo WHERE Id_Modulo = ". $result["Id_Modulo"];
    $resultM=mysqli_query($conn, $queryM);
    $ejecutar=mysqli_fetch_array($resultM, MYSQLI_ASSOC);
    $sqlupdate="UPDATE turnos_tomados SET Id_Puesto='$puesto', Id_Estado=3, Id_Usuario='$user' WHERE id_TTomados= " . $result["id_TTomados"];
    $execute= mysqli_query($conn, $sqlupdate);
    $tt= mysqli_query($conn, "SELECT Id_Estado FROM turnos_tomados WHERE id_TTomados= " . $result["id_TTomados"]);
    $idstate= mysqli_fetch_array($tt, MYSQLI_ASSOC);
    $_SESSION['resultado'] = $result;
    $_SESSION['ejecutar']= $ejecutar; 
    $_SESSION['tt'] = $idstate;
    
  header("Location: atencion.php");
  }
  
  //Query tabla modulos
  
  
  //Acciones para boton finalizar
   if(isset($_POST["finalizar"])){
     $upd= "UPDATE turnos_tomados SET Id_Estado= 6 WHERE id_TTomados=" . $_SESSION['resultado']["id_TTomados"];
     $update= mysqli_query($conn, $upd);
     header('Location: atencion.php?finalizado');
     $tat= mysqli_query($conn, "SELECT Id_Estado FROM turnos_tomados WHERE id_TTomados= " . $_SESSION['resultado']["id_TTomados"]);
    $idstate= mysqli_fetch_array($tat, MYSQLI_ASSOC);
    $_SESSION['tt'] = $idstate;
   }
   
   //Accion atender
   // dentro de esta accion no se actualiza el Id_Puesto ya que en llamado, lo hace.

   if(isset($_POST["atender"])){
    $ins="UPDATE turnos_tomados SET Id_Estado= 5 WHERE id_TTomados="  . $_SESSION['resultado']["id_TTomados"];
    $insert= mysqli_query($conn, $ins);
    $tat= mysqli_query($conn, "SELECT Id_Estado FROM turnos_tomados WHERE id_TTomados= " . $_SESSION['resultado']["id_TTomados"]);
    $idstate= mysqli_fetch_array($tat, MYSQLI_ASSOC);
    $_SESSION['tt'] = $idstate;
    header('Location: atencion.php');
   }
   //Accion boton anular
   if(isset($_POST["anular"])){
    $anu= "UPDATE turnos_tomados SET Id_Estado= 4 WHERE id_TTomados =" . $_SESSION['resultado']["id_TTomados"];
    $anular= mysqli_query($conn, $anu);
    // $idturnotom= $result["id_TTomados"];
    $ta= mysqli_query($conn, "SELECT Id_Estado FROM turnos_tomados WHERE id_TTomados= " . $_SESSION['resultado']["id_TTomados"]);
    $idstate= mysqli_fetch_array($ta, MYSQLI_ASSOC);
    $_SESSION['tt'] = $idstate;
    header('Location: atencion.php?anulado');
   }

?>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
