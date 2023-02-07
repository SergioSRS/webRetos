<?php
	require 'modelo/modelo_retos.php';
    require 'modelo/retos.php';
    require_once 'config.php';

	//Si la sesion no esta activa, la sesion se activa
	session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();
	
    class controladorReto
	{
 		function __construct() 
		{          
			$this->objconfig = new config();
            //Le pasa la configuracion al modelo para que se pueda conectar este a la bbdd
			$this->modelo = new modeloReto($this->objconfig);
		}
        // Se encarga de  elegir la acción dependiendo del input del usuario
		public function mvcHandler() 
		{   
			
            $act  = isset($_GET['act']) ? $_GET['act'] : NULL;
			switch ($act) 
			{
                case 'add' :                    
					$this->insert();
					break;						
				case 'update':
					$this->update();
					break;				
				case 'delete' :					
					$this -> delete();
					break;								
				default:
                    $this->list();
			}
		}		
         // metodo para redireccionar al usuario
		public function pageRedirect($url)
		{
			header('Location:'.$url);
		}	
        // funcion para validar los campos del usuario
		public function checkValidation($reto)
        {    $noerror=true;               
            // Validamos nombre          
			if(empty($reto->nombre) ){
                $noerror=false;     
            }
              
            return $noerror;
        }
		 // Insertar fila
		 public function insert()
		 {
			 try{
				 $reto=new Reto();
			
				 if (isset($_POST['addbtn'])) 
				 {   
		
					 //Elimina espacio en blanco (u otro tipo de caracteres) del inicio y el final de la cadena
					$reto->nombre = trim($_POST['nombre']);
					$reto->dirigido = trim($_POST['dirigido']);
					$reto->descripcion= trim($_POST['descripcion']);
					$reto->fechaFinInscripcion= trim($_POST['fechaFinInscripcion']);
					$reto->fechaInicioInscripcion= trim($_POST['fechaInicioInscripcion']);
					$reto->fechaFinReto= trim($_POST['fechaFinReto']);
					$reto->fechaInicioReto= trim($_POST['fechaInicioReto']);
					$reto->fechaPublicacion= trim($_POST['fechaPublicacion']);
					$reto->publicado= trim($_POST['publicado']);
					 //llamamos a la validacion
					 $check=$this->checkValidation($reto);                    
					 if($check)
					 {   
						 //llamamos al metodo de insertar del modelo          
						 $codigoConexion = $this -> modelo ->insertRecord($reto);
						
						 if($codigoConexion>0){			
							 $this->list();
						 }else{
							//Ver el de categoria
							 echo "Algo salió mal intentelo de nuevo";
						 }
					 }else
					 {              
						
						$this->pageRedirect("vistas/vistaReto/alta.php");                
					 }
				 }
			 }catch (Exception $e) 
			 {
				 $this->close_db();	
				 throw $e;
			 }
		 }
		 // Modificar
		 public function update()
		 {
			 try
			 {
				 
				 if (isset($_POST['updatebtn'])) 
				 {
					$reto=unserialize($_SESSION['reto']);
					$reto->id = trim($_POST['id']);
					$reto->nombre = trim($_POST['nombre']);
					$reto->descripcion= trim($_POST['descripcion']);
					$reto->fechaFinInscripcion= trim($_POST['fechaFinInscripcion']);
					$reto->fechaInicioInscripcion= trim($_POST['fechaInicioInscripcion']);
					$reto->fechaFinReto= trim($_POST['fechaFinReto']);
					$reto->fechaInicioReto= trim($_POST['fechaInicioReto']);
					$reto->fechaPublicacion= trim($_POST['fechaPublicacion']);
					$reto->publicado= trim($_POST['publicado']);
			       
					 // Validamos los campos actualizados 
					 $check=$this->checkValidation($reto);
					 if($check)
					 {
						 $respuesta = $this -> modelo ->updateRecord($reto);	                        
						 if($respuesta){			
							 $this->list();                           
						 }else{
							 echo "Algo ha salido mal";
						 }
					 }else
					 {         
						$_SESSION['reto']=serialize($reto);  //guardamos en la sesión la categoria a modificar
						 $this->pageRedirect("vistas/vistaReto/modificar.php");                
					 }
					 //Si no esta pulsado el boton de modificar quiero este escenario
				 }elseif(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
					 $id=$_GET['id'];
					 $result=$this->modelo->selectRecord($id);
					 $fila = $result->fetch_array();
					 $reto=new Reto();                  
					 $reto->id=$fila["id"];
					 $reto->nombre=$fila["nombre"];
					 $_SESSION['reto']=serialize($reto);  //guardams en la sesion la categoría a modificar 
					 $this->pageRedirect('vistas/vistaReto/modificar.php');
				 }else{
					 echo "No valido";
				 }
			 }
			 catch (Exception $e) 
			 {
				 $this->close_db();				
				 throw $e;
			 }
		 }
		 // Eliminar fila
		 public function delete()
		 {
			 try
			 {
				 if (isset($_GET['id'])) 
				 {
					 $id=$_GET['id'];
					 $respuesta=$this->modelo->deleteRecord($id);                
					 if($respuesta){
						$this->list();
					 }else{
						 echo "Algo salio mal";
					 }
				 }else{
					 echo "Operacion no valida";
				 }
			 }
			 catch (Exception $e) 
			 {
				 $this->close_db();				
				 throw $e;
			 }
		 }
		 public function list(){
			 $result=$this->modelo->selectRecord(0);
			 include "vistas/vistaReto/listar.php";                                        
		 }
	 }
		 
	 
 ?>