<?php
require_once('../../config/db.php');
date_default_timezone_set('America/Argentina/Buenos_Aires');

$modulo = ucwords(strtolower(trim($_POST['cat'])));
$cod_modulo = strtoupper(trim(str_replace(' ', '', $_POST['cod'])));
$estado = $_POST['est'];

if (buscaRepetido_nom_mod($modulo, $conn) == 1) {
  echo 5;
} elseif (
  $cod_modulo == 'HDP' ||
  $cod_modulo == 'PTE' ||
  $cod_modulo == 'PET' ||
  $cod_modulo == 'OGT' ||
  $cod_modulo == 'GIL' ||
  $cod_modulo == 'GAY' ||
  $cod_modulo == 'SEX' ||
  $cod_modulo == 'PTT' ||
  $cod_modulo == 'RIP' ||
  $cod_modulo == 'PUT' ||
  $cod_modulo == 'LPM'
) {
  echo 4;
} elseif (strlen($cod_modulo) <> 3) {
  echo 3;
} elseif (buscaRepetido($cod_modulo, $conn) == 1) {

  echo 2;
} else {

  $query = "INSERT INTO modulo(Modulo,Cod_Modulo,Estado_Modulo) VALUES ('$modulo', '$cod_modulo','$estado')";
  $result = mysqli_query($conn, $query);
  if (!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Categoría Cargada Correctamente';
  $_SESSION['message_type'] = 'success';

  echo 1;
  // ACA trabajamos con Ale
  $estado = 0;
  $fecha = date('Y-m-d');
  mysqli_query($conn, "INSERT INTO  control_turnos(Modulo,Max_Num_Turno,Fecha_Turno) values ('$cod_modulo','$estado','$fecha')");
  //hasta aca
}




function buscaRepetido($modulo, $conn)
{
  $sql = "SELECT * FROM modulo WHERE Estado_Modulo IN (0,1) AND Cod_Modulo='$modulo'";
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

function buscaRepetido_nom_mod($nom_modulo, $conn)
{
  $sql = "SELECT * FROM modulo WHERE Estado_Modulo IN (0,1) AND Modulo='$nom_modulo'";
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
