<?php
// llamada a archivo db (conexión mysql)
require_once('../../config/dbMongo.php');

$id = $_POST["id"];
$nombre = ucwords(strtolower(trim($_POST['nombre'])));
$apellido= ucwords(strtolower(trim($_POST['apellido'])));
$nombreUs = ucwords(strtolower(trim($_POST['nombreUs'])));
$email = $_POST["email"];
$rol = $_POST["rol"];
//$contraseña = $_POST["contraseña"];
$clave = $_POST['clave'];
$estado = $_POST["estado"];
$dia = $_POST["dia"];
$ultima_mod = date("Y-m-d H:i:s");
 


$bulk = new MongoDB\Driver\BulkWrite;

 try {
    $bulk->update(
        ['_id' => new MongoDB\BSON\ObjectId($id)],
        [
            'nombre' => $nombre,
            'apellido' => $apellido,
            'nombreUs' => $nombreUs,
            'email' => $email,
            'rol' => $rol,
            'contraseña' => $clave,
            'estado' => $estado,
            'dia' => $dia,
            'ultima_mod' => $ultima_mod,
         
        ]
    );

    $result = $manager->executeBulkWrite($dbname, $bulk);

      //Update en MySQL
      $conn = mysqli_connect(
        'db',
        'root',
        'root',
        'arturnito'

     ) or die(mysqli_error($mysqli));

 

    $query = "UPDATE usuario set NombreUs = '$nombreUs', Id_Estado = '$estado', Rol = '$rol' WHERE Cod_Usuario = '$id'";
    
   $result1 = mysqli_query($conn, $query);
   if (!$result1) {
    die("Query Failed.");
}

    $_SESSION['message'] = 'Usuario actualizado correctamente';
    $_SESSION['message_type'] = 'warning';

    header("Location: usuarios.php");
} catch (MongoDB\Driver\Exception\Exception $e) {
    die("Error Encountered " . $e);
}



$filterUs = [

    'nombreUs' => $nombreUs,

];

$filterEmail = [
    'email' => $email
];

$query = new MongoDB\Driver\Query($filterUs);
$query2 = new MongoDB\Driver\Query($filterEmail);

try {
    if (isset($_POST['editar_usuario'])) {
        $result = $manager->executeQuery($dbname, $query);
        $row = $result->toArray();
        
        if ($row[0]->nombreUs) {
            $_SESSION['message'] = 'El NOMBRE DE USUARIO que acaba de ingresar ya se encuentra registrado en el sistema';
            $_SESSION['message_type'] = 'danger';
            header('Location: usuarios.php');
        } elseif (isset($_POST['editar_usuario'])) {

            $result = $manager->executeQuery($dbname, $query2);
            $row2 = $result->toArray();
            if ($row2[0]->email) {
                $_SESSION['message'] = 'El EMAIL que acaba de ingresar ya se encuentra registrado en el sistema';
                $_SESSION['message_type'] = 'danger';
                header('Location: usuarios.php');
            } else {

                $bulk->update(
                    ['_id' => new MongoDB\BSON\ObjectId($id)],
                    [
                        'nombre' => $nombre,
                        'apellido' => $apellido,
                        'nombreUs' => $nombreUs,
                        'email' => $email,
                        'rol' => $rol,
                        'contraseña' => $clave,
                        'estado' => $estado,
                        'dia' => $dia,
                        'ultima_mod' => $ultima_mod
                    ]
                );

                $resultado = $manager->executeBulkWrite($dbname, $bulk);
                $_SESSION['message'] = 'Usuario actualizado correctamente';
                $_SESSION['message_type'] = 'warning';

                header('Location: usuarios.php');
            }
        }
    }
} catch (MongoDB\Driver\Exception\Exception $e) {
    die("Error Encountered: " . $e);
}
