<?php
session_start();
$manager = new MongoDB\Driver\Manager("mongodb://root:rootpassword@mongodb:27017"); //Conexion con mongo 
$dbname = "dbMongo.usuarios"; // Conexion con la base de datos
?>