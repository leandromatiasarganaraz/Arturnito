<?php
// llamada a archivo db (conexión mongoDB)
require_once('../../config/dbMongo.php');

$bulk = new MongoDB\Driver\BulkWrite;

$id = $_POST["id"];
$nombre = ucwords(strtolower(trim($_POST['nombre'])));
$apellido= ucwords(strtolower(trim($_POST['apellido'])));
$nombreUs = ucwords(strtolower(trim($_POST['nombreUs'])));
$email = $_POST["email"];
$rol = $_POST["rol"];
$clave = md5($_POST["contraseña"]);
$estado = $_POST["estado"];
$dia = $_POST["dia"];
$ultima_mod = date("Y-m-d H:i:s");
$ip = $_SERVER['SERVER_ADDR'];



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
            'ip_admin' => $ip
        ]
    );

    $result = $manager->executeBulkWrite($dbname, $bulk);
    $_SESSION['message'] = 'Contraseña actualizada correctamente';
    $_SESSION['message_type'] = 'warning';
    header("Location: perfil.php");
} catch (MongoDB\Driver\Exception\Exception $e) {
    die("Error Encountered " . $e);
}
