<?php
require_once ('../../config/db.php');

if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "UPDATE modulo SET Estado_Modulo=2 WHERE Id_Modulo = $id";
  $query2 = "DELETE FROM usuario_modulo WHERE Id_Modulo = $id";
  $query3 = "DELETE FROM control_turnos WHERE Modulo = (SELECT Cod_Modulo FROM modulo WHERE Id_Modulo=$id)";
  $query4 = "UPDATE turnos_tomados SET Id_Estado=7 WHERE Id_Modulo=$id AND Id_Estado=1";

  mysqli_query($conn, $query2);
  mysqli_query($conn, $query3);
  mysqli_query($conn, $query4);
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Categoría Eliminada';
  $_SESSION['message_type'] = 'danger';
  header('Location: categorias.php');
}

?>
