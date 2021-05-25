<?php
require_once('../../config/db.php');

function buscaRepetido($puesto, $conn)
{
  $sql = "SELECT * FROM puesto  WHERE Estado_Puesto IN (0,1) AND Puesto='$puesto'";
  $result = mysqli_query($conn, $sql);

  if (!$result) {
    die("Query Failed.");
  }

  if (mysqli_num_rows($result) > 0) {
    return 1;
  } else {
    return 0;
  }
}

$puesto = ucwords(strtolower(trim($_POST['pue'])));
$estado = $_POST['est'];


if (buscaRepetido($puesto, $conn) == 1) {

  echo 2;
} else {

  $query = "INSERT INTO puesto(Puesto,Estado_Puesto) VALUES ( '$puesto','$estado')";
  $result = mysqli_query($conn, $query);
  if (!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Puesto Cargado Correctamente';
  $_SESSION['message_type'] = 'success';

  echo 1;
}
