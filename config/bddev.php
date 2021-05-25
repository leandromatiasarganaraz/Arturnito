<?php
class  CrudDB{    
    private $host   ="localhost";
    private $usuario="";
    private $clave  ="";
    private $db     ="";
    public $conexion;
    public function __construct(){
        $this->conexion = new mysqli($this->host, $this->usuario, $this->clave,$this->db)
        or die(mysql_error());
        $this->conexion->set_charset("utf8");
    }
    //INSERTAR
    public function insertar($tabla, $datos){
        $resultado =    $this->conexion->query("INSERT INTO $tabla VALUES (null,$datos)") or die($this->conexion->error);
        if($resultado)
            return true;
        return false;
    } 
    //BORRAR
    public function borrar($tabla, $condicion){    
        $resultado  =   $this->conexion->query("DELETE FROM $tabla WHERE $condicion") or die($this->conexion->error);
        if($resultado)
            return true;
        return false;
    }
    //ACTUALIZAR
    public function actualizar($tabla, $campos, $condicion){    
        $resultado  =   $this->conexion->query("UPDATE $tabla SET $campos WHERE $condicion") or die($this->conexion->error);
        if($resultado)
            return true;
        return false;        
    } 
    //BUSCAR
    public function buscar($tabla, $condicion){
        $resultado = $this->conexion->query("SELECT * FROM $tabla WHERE $condicion") or die($this->conexion->error);
        if($resultado)
            return $resultado->fetch_all(MYSQLI_ASSOC);
        return false;
    } 
    //BUSCAR COLUMNA ESPECIFICA
    public function buscar_columna($tabla, $columna){
      $resultado = $this->conexion->query("SELECT $columna FROM $tabla") or die($this->conexion->error);
            return $resultado;
      
  } 
    //SELECCIONAR TODOS LOS DATOS DE UNA TABLA
    public function selec_tabla($tabla){
      $resultado = $this->conexion->query("SELECT * FROM $tabla") or die($this->conexion->error);
            return $resultado;
      
  } 
  public function selec_consultaesp($consulta){
    $resultado = $this->conexion->query("$consulta") or die($this->conexion->error);
          return $resultado;
    
  }
  
}


  /*EJEMPLOS DE USO 
function save_user($post,$cod_act){
$user = new CrudDB();//llama a la clase CrudBD 
$consul=$user->selec_consultaesp("SELECT id_domicilio FROM usuarios ORDER BY id_domicilio DESC LIMIT 1");
$user = new CrudDB();//llama a la clase CrudBD 
$usuariobd=$user->selec_tabla("usuarios");*/