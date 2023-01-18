<?php
require 'model/sportsModel.php';
    require 'model/sports.php';
    require_once 'config.php';
    class sportsController 
	{

 		function __construct() 
		{          
			$this->objconfig = new config();
            //Le pasa la configuracion al modelo para que se pueda conectar este a la bbdd
			$this->objsm =  new sportsModel($this->objconfig);
		}
        // mvc handler request
		public function mvcHandler() 
		{   
            //Shorthand mas actual -> if (isset(($_GET['act'])) else ($_GET['act']) = null//
			
            $accion = isset($_GET['accion']) ? $_GET['accion'] : NULL;
			switch ($accion) 
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
         // metodo para redireccionar
		public function pageRedirect($url)
		{
			header('Location:'.$url);
		}	
        // check validation
		public function checkValidation($sporttb)
        {    $noerror=true;
            // Validate category        
            if(empty($sporttb->category))
               $noerror=false;           
            // Validate name            
            if(empty($sporttb->name))
             $noerror=false;     
            return $noerror;
        }