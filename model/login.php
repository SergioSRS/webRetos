<?php
use Shuchkin\SimpleXLSX;
require "simpleXLSX/SimpleXLSX.php";
class Login{

	private $table = 'profesores';
	private $conection;

	public function __construct() {
		
	}

	public function getConection(){
		$dbObj = new Db();
		$this->conection = $dbObj->conection;
	}

	public function validarUsuario($parametros){
		$this->getConection();
	
		//Nos aseguramos de que si nos llega algo vacio, se quede nulo a la hora de hacer la consulta
		if(isset($parametros["correo"]) and !empty($parametros["correo"]))
		{
			$correo = $parametros["correo"];
		} 
		else if (empty($parametros["correo"])){
			$correo = NULL;
		}
		if(isset($parametros["pass"]) and !empty($parametros["pass"]))
		{
			$pass = $parametros["pass"];
		} 
		else if (empty($parametros["pass"])){
			$pass = NULL;
		}

		$consulta =  $this->conection->prepare("SELECT * FROM profesores where correo = ? and password = ?");
		$consulta->bind_param("ss", $correo, $pass);
		$consulta->execute();
		$resultado = $consulta->get_result();
		//Si el numero de filas de un resultado es igual a 1
		if($resultado->num_rows == 1){
		
		$fila = $resultado ->fetch_array();
	
				@session_start();
				$_SESSION['nombre'] = $fila['nombre'];
				$_SESSION['id'] = $fila['id'];
				return true;
			} else {
				return false;
			}
		}
	public function insertarProfesoresExcel(){
		$this->getConection();
        $nombres = array();
        $correos = array();
        $passwords = array();

        if (isset($_FILES['profesores']))
        {
            $xlsx = new SimpleXLSX($_FILES['profesores']['tmp_name']);     
            list($cols,) = $xlsx->dimension();

            foreach($xlsx->rows() as $k)
            {
                array_push($nombres, $k[0]);
                array_push($correos, $k[1]);
                array_push($passwords, $k[2]);
            }

            if((count($nombres) == count($correos)) && (count($correos) == count($passwords)))
            {
                $sql = "INSERT INTO profesores(nombre, correo, password) VALUES(?, ?, ?)";
        
                $consulta = $this->conection->prepare($sql);
        
                $nombre = '';
                $correo = '';
                $password = '';
        
                $consulta->bind_param('sss', $nombre, $correo, $password);
        
                for($i=0; $i<count($nombres); $i++) 
                {
                    $nombre = $nombres[$i];
                    $correo = $correos[$i];
                    $password = password_hash($passwords[$i], PASSWORD_DEFAULT);
        
                    $consulta->execute();
                }
    
        
				return "ok";
            }
            else
            {
                return "not ok";
            }
        }
	}
}


   