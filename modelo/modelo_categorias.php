<?php
	
	class modeloCategoria
	{
		// set database config for mysql
		function __construct($consetup)
		{
			$this->host = $consetup->host;
			$this->user = $consetup->user;
			$this->pass =  $consetup->pass;
			$this->db = $consetup->db;            					
		}
		// Para abrir la base de datos 
		public function open_db()
		{
			$this->conexion=new mysqli($this->host,$this->user,$this->pass,$this->db);
			if ($this->conexion->connect_error) 
			{
    			die("Error en conexion " . $this->conexion->connect_error);
			}
		}
		// Metodo para cerrar conexion de la base de datos
		public function close_db()
		{
			$this->conexion->close();
		}	

		// Insertar registro
		public function insertRecord($obj)
		{
			try
			{	
				$this->open_db();
				$query=$this->conexion->prepare("INSERT INTO categorias (nombre) VALUES (?)");
				$query->bind_param("s",$obj->nombre);
				$query->execute();
				$res= $query->get_result();
                //inser_id Devuelve el id autogenerado que se utilizó en la última consulta
				$codigoConexion=$this->conexion->insert_id;
				$query->close();
				$this->close_db();
				return $codigoConexion;
			}
			catch (Exception $e) 
			{
				$this->close_db();	
            	throw $e;
        	}
		}
        //Modificar registro
		public function updateRecord($obj)
		{
			try
			{	
				$this->open_db();
				$query=$this->conexion->prepare("UPDATE categorias SET nombre=? WHERE id=?");
				$query->bind_param("si",$obj->nombre,$obj->id);
				$query->execute();
				$res=$query->get_result();						
				$query->close();
				$this->close_db();
				return true;
			}
			catch (Exception $e) 
			{
            	$this->close_db();
            	throw $e;
        	}
        }
         // Eliminar registro
		public function deleteRecord($id)
		{	
			try{
				$this->open_db();
				$query=$this->conexion->prepare("DELETE FROM categorias WHERE id=?");
				$query->bind_param("i",$id);
				$query->execute();
				$res=$query->get_result();
				$query->close();
				$this->close_db();
				return true;	
			}
			catch (Exception $e) 
			{
            	$this->closeDb();
            	throw $e;
        	}		
        }   
        // Listar
		public function selectRecord($id)
		{
			try
			{
                $this->open_db();
                if($id>0)
				{	
					$query=$this->conexion->prepare("SELECT * FROM categorias WHERE id=?");
					$query->bind_param("i",$id);
				}
                else
                {$query=$this->conexion->prepare("SELECT * FROM categorias");	}		
				
				$query->execute();
				$res=$query->get_result();	
				$query->close();				
				$this->close_db();                
                return $res;
			}
			catch(Exception $e)
			{
				$this->close_db();
				throw $e; 	
			}
			
		}
	}

