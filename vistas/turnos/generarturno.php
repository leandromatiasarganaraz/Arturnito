<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');

$modulo = $_POST['modulo'];

require_once('../../config/db.php');

$resultados = mysqli_query($conn, "SELECT Id_Modulo,Cod_Modulo FROM modulo  where Modulo= '$modulo'");
while ($consulta = mysqli_fetch_array($resultados)) {

   $contenido0 = $consulta[0];
   $contenido1 = $consulta[1];
}

//$str="12345678901234567890123456789012345678901234567890123456789012";
// $codigo="";
// for($i=0;$i<3;$i++){
//  $codigo .=substr($str,rand(0,62),1);
// }

$estado = 1;



$resultados = mysqli_query($conn, "SELECT Max_Num_Turno,Fecha_Turno FROM control_turnos  where Modulo= '$contenido1'");
while ($consulta = mysqli_fetch_array($resultados)) {

   $contenido10 = $consulta[0];
   $contenido11 = $consulta[1];
}
$fecha = date('Y-m-d');
if ($fecha > $contenido11) {
   $max = 1;
   $_UPDATE_SQL = "UPDATE control_turnos Set Max_Num_Turno='$max', Fecha_Turno = '$fecha' WHERE Modulo= '$contenido1'";

   mysqli_query($conn, $_UPDATE_SQL);

   mysqli_query($conn, "INSERT INTO  turnos_tomados
(Id_Estado,Id_Modulo) 
values 
('$estado','$contenido0')");

   $resultados = mysqli_query($conn, "SELECT max(id_TTomados) FROM turnos_tomados");
   while ($consulta = mysqli_fetch_array($resultados)) {

      $contenido2 = $consulta[0];
   }

   $turno = $contenido1 . $max;


   $_UPDATE_SQL = "UPDATE turnos_tomados Set Turno='$turno' WHERE id_TTomados= '$contenido2'";

   mysqli_query($conn, $_UPDATE_SQL); // hacemos la conexion para poder efectuar los cambios


} else {

   $max = $contenido10 + 1;

   $_UPDATE_SQL = "UPDATE control_turnos Set Max_Num_Turno='$max' WHERE Modulo= '$contenido1'";

   mysqli_query($conn, $_UPDATE_SQL);



   mysqli_query($conn, "INSERT INTO  turnos_tomados
(Id_Estado,Id_Modulo) 
values 
('$estado','$contenido0')");



   $resultados = mysqli_query($conn, "SELECT max(id_TTomados) FROM turnos_tomados");
   while ($consulta = mysqli_fetch_array($resultados)) {

      $contenido2 = $consulta[0];
   }

   $turno = $contenido1 . $max;


   $_UPDATE_SQL = "UPDATE turnos_tomados Set Turno='$turno' WHERE id_TTomados= '$contenido2'";

   mysqli_query($conn, $_UPDATE_SQL); // hacemos la conexion para poder efectuar los cambios

}

require('pdf/fpdf.php');

class PDF extends FPDF
{
   // Cabecera de página
   function Header()
   {
      // Logo
      $this->image('pdf/imagenes/logo1.png', 15, 0, -200);
      $this->Ln(5);
      // Arial bold 
      $this->SetFont('Arial', 'B', 20); //Cambio la letra y el tamaño de la palabra Artutnito
      // Movernos a la derecha
      $this->Cell(5);
      // Título
      $this->Cell(25, 10, ' Arturnito ', 0, 'c', 0);
      // Salto de línea
      $this->Ln(4);
      // Linea 
      $this->Cell(34, 10, ' ---------------- ', 0, 'c', 0);
      // Salto de línea
      $this->Ln(8);
      $this->SetFont('Arial', 'B', 15); //Cambio la letra y el tamaño de la palabra TURNO
      $this->cell(0, 10, 'TURNO', 1, 1, 'c', 0);
   }
}
$consulta = "SELECT * FROM turnos_tomados where id_TTomados='$contenido2'";
$resultado = $conn->query($consulta);

$pdf = new PDF($orientation = 'P', $unit = 'mm', array(45, 350));
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 20);
$textypos = 32;
while ($row = $resultado->fetch_assoc()) {

   $pdf->cell(0, 10, $row['Turno'], 1, 1, 'c', 0);
   $textypos = 1;
   $pdf->setX(2);
   $pdf->SetFont('Arial', 'B', 6);
   $textypos = 4;
   $pdf->setX(2);
   $pdf->Cell(1, $textypos + 2, '******');
   $pdf->Cell(5, $textypos + 8, 'GRACIAS POR RETIRAR SU TICKET');
   $pdf->setX(2);
   $pdf->Cell(1, $textypos + 14, '******');
   $pdf->setX(2);
   $pdf->Cell(10, 22, 'Fecha', 0, 0, 'C');
   $pdf->Cell(10, 22, date('d/m/Y'), 0);
   $pdf->setX(2);
   $pdf->Cell(10, 28, 'Hora', 0, 0, 'C');
   $pdf->Cell(10, 28, date("h:i"), 0);
   $pdf->setX(2);
}

$pdf->Output();
