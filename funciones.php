<?php

// ------------- Validar campos vacios (Login) -------------

function validar_campos_vacios_login ($datos) {

  $error = [];

  if(empty($datos['usuario']))
  {
    $error['usuario'] = 'El campo de usuario está vacío';
  }
  if(empty($datos['password']))
  {
    $error['password'] = 'El campo de contraseña está vacío';
  }

  return $error;

}



// ------------- Verificar si el usuario ya existe (login) -------------

function verificarUsuario($verificar) {

  if($verificar) {
    require_once('config/dbMongo.php');
    $query = new MongoDB\Driver\Query([]);
    $consultmongo = $manager->executeQuery($dbname, $query);
    
    //verifica el usuario y la contraseña
    foreach($consultmongo as $verificarmongo) {
      $hashmongo=$verificarmongo->contraseña;
      $pass=md5($verificar['password']);
      if(($verificar['usuario'] === $verificarmongo->nombreUs)&&($pass === $hashmongo)) {
        return $verificarmongo;
      }
    }
   return false;
  }

  
}
