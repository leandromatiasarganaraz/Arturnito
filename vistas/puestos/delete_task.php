<?php

require_once ('../../config/db.php');

if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "UPDATE puesto SET Estado_Puesto=2 WHERE Id_Puesto = $id";
  $query2 = "UPDATE usuario SET Id_Puesto=NULL WHERE Id_Puesto = $id";
  mysqli_query($conn, $query2);
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Puesto Eliminado';
  $_SESSION['message_type'] = 'danger';
  header('Location: puestos.php');
}

?>
