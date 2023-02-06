<?php
	require 'modelo/modelo_categorias.php';
    require 'modelo/categorias.php';
    require_once 'config.php';

	//Si la sesion no esta activa, la sesion se activa
	session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();
	
    class controladorCategoria 
	{
 		function __construct() 
		{          
			$this->objconfig = new config();
            //Le pasa la configuracion al modelo para que se pueda conectar este a la bbdd
			$this->modelo =  new modeloCategoria($this->objconfig);
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
		public function checkValidation($categoria)
        {    $noerror=true;               
            // Validamos nombre          
			if(empty($categoria->nombre) ){
                $noerror=false;     
            }
              
            return $noerror;
        }
		 // Insertar fila
		 public function insert()
		 {
			 try{
				 $categoria=new Categoria();
				 if (isset($_POST['addbtn'])) 
				 {   
		
					 //Elimina espacio en blanco (u otro tipo de caracteres) del inicio y el final de la cadena
					 $categoria->nombre = trim($_POST['nombre']);
					 //llamamos a la validacion
					 $check=$this->checkValidation($categoria);                    
					 if($check)
					 {   
						 //llamamos al metodo de insertar del modelo          
						 $codigoConexion = $this -> modelo ->insertRecord($categoria);
						 if($codigoConexion>0){			
							 $this->list();
						 }else{
							 echo "Algo salió mal intentelo de nuevo";
						 }
					 }else
					 {              
						
						$this->pageRedirect("vistas/alta.php");                
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
					$categoria=unserialize($_SESSION['categoria']);
					 $categoria->id = trim($_POST['id']);
					 $categoria->nombre = trim($_POST['nombre']);
			       
					 // Validamos los campos actualizados 
					 $check=$this->checkValidation($categoria);
					 if($check)
					 {
						 $respuesta = $this -> modelo ->updateRecord($categoria);	                        
						 if($respuesta){			
							 $this->list();                           
						 }else{
							 echo "Algo ha salido mal";
						 }
					 }else
					 {         
						$_SESSION['categoria']=serialize($categoria);  //guardamos en la sesión la categoria a modificar
						 $this->pageRedirect("vistas/modificar.php");                
					 }
					 //Si no esta pulsado el boton de modificar quiero este escenario
				 }elseif(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
					 $id=$_GET['id'];
					 $result=$this->modelo->selectRecord($id);
					 $fila=mysqli_fetch_array($result);  
					 $categoria=new Categoria();                  
					 $categoria->id=$fila["id"];
					 $categoria->nombre=$fila["nombre"];
					 $_SESSION['categoria']=serialize($categoria);  //guardams en la sesion la categoría a modificar 
					 $this->pageRedirect('vistas/modificar.php');
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
						 $this->pageRedirect('index.php');
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
			 include "vistas/listar.php";                                        
		 }
	 }
		 
	 
 ?>