<?php
require_once('../../config/db.php');
date_default_timezone_set('America/Argentina/Buenos_Aires');
$resultado_filtros = '';

$puesto = $_POST['puesto'];
$modulo = $_POST['modulo'];
$estado = $_POST['estado'];
$usuario = $_POST['usuario'];
$turno = strtoupper(trim(str_replace(' ', '', $_POST['turno'])));
$f_desde = $_POST['f_desde'];
$f_hasta = $_POST['f_hasta'];

if ($puesto <> 1) {
    $puesto = "AND Puesto='$puesto'";
} else {
    $puesto = '';
};

if ($modulo <> 1) {
    $modulo = "AND Modulo='$modulo'";
} else {
    $modulo = '';
};

if ($estado <> 1) {
    $estado = "AND Estado='$estado'";
} else {
    $estado = '';
};

if ($usuario <> 1) {
    $usuario = "AND Usuario='$usuario'";
} else {
    $usuario = '';
};

if ($turno <> '') {
    $turno = "AND Turno LIKE '%$turno%'";
} else {
    $turno = '';
};

if ($f_desde <> '') {
    $f_desde = "AND Fecha_Turno>='$f_desde'";
} else {
    $f_desde = '';
};

if ($f_hasta <> '') {
    $f_hasta = "AND Fecha_Turno<='$f_hasta'";
} else {
    $f_hasta = '';
};

$query = trim("SELECT * 
          FROM vista_turnos 
          WHERE 1=1 
          $puesto 
          $modulo
          $estado
          $usuario
          $turno
          $f_desde
          $f_hasta");


$result_tasks = mysqli_query($conn, $query);

$resultado_filtros .= "<div class='container-fluid'>
<div class='row'>
  <div class='col-lg-12'>
    <div class='table-responsive'>
<table id='example' class='table table-bordered table-hover' cellspacing='0' width='100%'>
<thead class='colorfondo2 text-white'>
  <tr>
    <th>#</th>
    <th>Turno</th>
    <th>Estado</th>
    <th>Usuario</th>
    <th>Puesto</th>
    <th>Categoría</th>
    <th>Fecha_Turno</th>
  </tr>
</thead>

<tbody>";
$indice = 1;
while ($row = mysqli_fetch_assoc($result_tasks)) {
    $resultado_filtros .= "<tr>
    			<td>" . $indice . "</td>
    			<td>" . $row['Turno'] . "</td>
    			<td>" . $row['Estado'] . "</td>
                <td>" . $row['Usuario'] . "</td>
                <td>" . $row['Puesto'] . "</td>
                <td>" . $row['Modulo'] . "</td>
                <td>" . $row['Fecha_Turno'] . "</td>
    	  </tr>";
    $indice = $indice + 1;
}
$resultado_filtros .= "</tbody></table></div>
</div>
</div>
</div>
<script type='text/javascript' src='../../global/dist/js/main.js'></script>";

echo $resultado_filtros;
