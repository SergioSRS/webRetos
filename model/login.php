<?php

class Login{

	private $table = 'profesores';
	private $conection;

	public function __construct() {
		
	}

	public function getConection(){
		$dbObj = new Db();
		$this->conection = $dbObj->conection;
	}

	public function validarUsuario($parametros)
	{
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
	
		//$comprobar = $fila['password'];
	
			//if($comprobar == $pass){
				/*ini_set('session.cookie_lifetime',0);// cuando un navegador finaliza, la cookie de ID de sesión se elimina inmediatamente
				ini_set('session.cookie_httponly',true);//Este ajuste previene del robo de cookies por inyecciones de JavaScript. 
				ini_set('session.use_strict_mode',true);//Para que no puedan usar un id de sesion si no se ha iniciado sesion.
				ini_set('session.use_only_cookies',1); //Las cookies deben estar activas incondicionalmente en el lado del usuario, o las sesiones no funcionarán. 
				session_start();
				$_SESSION['nombre'] = $fila['nombre'];
				$_SESSION['id'] = $fila['id'];*/
				@session_start();
				$_SESSION['nombre'] = $fila['nombre'];
				$_SESSION['id'] = $fila['id'];
				return true;
			} else {
				return false;
			}
		}
	}


   