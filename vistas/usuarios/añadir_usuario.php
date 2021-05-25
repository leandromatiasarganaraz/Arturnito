<?php 
require_once ('../../config/dbMongo.php');

    $bulk = new MongoDB\Driver\BulkWrite;

    $nombre = ucwords(strtolower(trim($_POST['nombre'])));
    $apellido= ucwords(strtolower(trim($_POST['apellido'])));
    $nombreUs = ucwords(strtolower(trim($_POST['nombreUs'])));
    $email = trim($_POST["email"]);
    $contraseña = trim($_POST["contraseña"]);
    $clave = md5($contraseña);
    $rol = $_POST["rol"];
    $estado = trim($_POST["estado"]);
    $InsertaDia = date("Y-m-d H:i:s");
    $ip = $_SERVER['SERVER_ADDR'];

   

    $filterUs = [

        'nombreUs' => $nombreUs, 
    
    ];

    $filterEmail = [
        'email' => $email
    ];
 
    $query = new MongoDB\Driver\Query($filterUs);
    $query2= new MongoDB\Driver\Query($filterEmail);

    try{
        if (isset($_POST['añadir_usuario'])){
        $result = $manager->executeQuery($dbname, $query);
        $row = $result->toArray();
        if($row[0]->nombreUs)
         {
                $_SESSION['message'] = 'El NOMBRE DE USUARIO que acaba de ingresar ya se encuentra registrado en el sistema';
                $_SESSION['message_type'] = 'danger';
               header('Location: usuarios.php');

         }elseif(isset($_POST['añadir_usuario'])){

            $result = $manager->executeQuery($dbname, $query2);
            $row2 = $result->toArray();
            if($row2[0]->email){
            $_SESSION['message'] = 'El EMAIL que acaba de ingresar ya se encuentra registrado en el sistema';
            $_SESSION['message_type'] = 'danger';
           header('Location: usuarios.php');
            
         }else{
            $usuario = [

                '_id' => new MongoDB\BSON\ObjectId,
                'nombre' => $nombre, 
                'apellido' => $apellido, 
                'nombreUs' => $nombreUs, 
                'email' => $email,
                'contraseña' => $clave,
                'rol' => $rol,
                'estado' => $estado,
                'dia' => $InsertaDia,
                'ip_admin' => $ip
                
                
            ];

        


             $bulk->insert($usuario);
             $result = $manager->executeBulkWrite($dbname, $bulk);
             
             //Insert en MySQL
             $conn = mysqli_connect(
                'db',
                'root',
                'root',
                'arturnito'

             ) or die(mysqli_error($mysqli));

             $nameus = ['nombreUs' => $nombreUs];
             $queryMongo = new MongoDB\Driver\Query($nameus);
             $r = $manager->executeQuery($dbname, $queryMongo);
             $rows = $r->toArray();
             foreach ($rows as $rou) {
             $ID = $rou->_id;
             }

             $query = "INSERT INTO usuario(Id_Usuario,NombreUs,Cod_Usuario,Rol,Id_Estado,Id_Puesto) VALUES (NULL, '$nombreUs','$ID','$rol',$estado,NULL)";

             $result = mysqli_query($conn, $query); 
             
             if (!$result) {
                die("Query Failed.");
            }

             $_SESSION['message'] = 'Usuario añadido correctamente';
             $_SESSION['message_type'] = 'success';
             header('Location: usuarios.php');
             
         }
        }
    }
    }   catch(MongoDB\Driver\Exception\Exception $e){
        die("Error Encountered: ".$e);
    }
