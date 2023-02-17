<?php 

class Reto {

	private $table = 'retos';
	private $conection;

	public function __construct() {
		
	}

	/* Setear conexion */
	public function getConection(){
		$dbObj = new Db();
		$this->conection = $dbObj->conection;
	}

	/* Coger todos los retos */
	public function getRetos(){
		
		$this->getConection();
		$sql = "SELECT * FROM ".$this->table;
		$result = $this->conection->query($sql);

		return $result->fetch_all(MYSQLI_ASSOC);
	}

	/* Coge un registro por id */
	public function getRetoById($id){
		if(is_null($id)) return false;
		$this->getConection();
		$sql = "SELECT * FROM ".$this->table. " WHERE id = ?";
		$stmt = $this->conection->prepare($sql);
		$stmt->bind_param('i', $id);
		$stmt->execute();

		$result = $stmt->get_result();

		return $result->fetch_assoc();
	}
		/* Coge un registro por id */
		public function getRetoFiltrado($busqueda){
			
			$this->getConection();
			$sql = "SELECT * FROM ".$this->table." WHERE nombre LIKE "."'".$busqueda."'";
			$result = $this->conection->query($sql);
	
			return $result->fetch_all(MYSQLI_ASSOC);
		}

	/* Guarda el reto, ya sea actualizado o registrado por primera vez */
	public function save($param){
		$this->getConection();

		/* Queremos que los campos por defectos estén vacios como un alta debería de tener*/
		
		$nombre = $dirigido = $descripcion = $fechaInicioInscripcion =
		$fechaFinInscripcion = $fechaInicioReto = $fechaFinReto = $fechaPublicacion = "";
		$publicado = false;

		/* Sirve para saber si el registro esta en la bbdd, si está, los atributos se llenan con los de la bbdd*/
		$exists = false;
		if(isset($param["id"])  and $param["id"] !=''){
			$actualReto = $this->getRetoById($param["id"]);
			if(isset($actualReto["id"])){
				$exists = true;	
				/* valores que quiero modificar no?*/
				$id = $param["id"];
				$nombre = $actualReto["nombre"];
				$dirigido = $actualReto["dirigido"];
				$descripcion = $actualReto["descripcion"];
				$fechaInicioInscripcion = $actualReto["fechaInicioInscripcion"];
				$fechaFinInscripcion = $actualReto["fechaFinInscripcion"];
				$fechaInicioReto = $actualReto["fechaInicioReto"];
				$fechaFinReto = $actualReto["fechaFinReto"];
				$fechaPublicacion = $actualReto["fechaPublicacion"];
				$publicado = $actualReto["publicado"];
			}
		}

		/* Valores recibidos de un alta o un modificar */
		try{
			
			if(isset($param["nombre"]) and !empty($param["nombre"]))
			{
				$nombre = $param["nombre"];
			} 
			else if (empty($param["nombre"])){
				$nombre = NULL;
			}
		
			if(isset($param["dirigido"])) 
			{
				$dirigido = $param["dirigido"];
			}
			else if (empty($param["dirigido"])){
				$dirigido = NULL;
			}
		
			if(isset($param["descripcion"]) and !empty($param["descripcion"]))
			{
				$descripcion = $param["descripcion"];
			} 
			else if (empty($param["descripcion"])){
				$descripcion = NULL;
			}
			if(isset($param["fechaInicioInscripcion"]) and !empty($param["fechaInicioInscripcion"]))
			{
				$fechaInicioInscripcion = $param["fechaInicioInscripcion"];
			} 
			else if (empty($param["fechaInicioInscripcion"])){
				$fechaInicioInscripcion = NULL;
			}
			if(isset($param["fechaFinInscripcion"]) and !empty($param["fechaFinInscripcion"]))
			{
				$fechaFinInscripcion = $param["fechaFinInscripcion"];
			} 
			else if (empty($param["fechaFinInscripcion"])){
				$fechaFinInscripcion = NULL;
			}
			if(isset($param["fechaInicioReto"]) and !empty($param["fechaInicioReto"]))
			{
				$fechaInicioReto = $param["fechaInicioReto"];
			} 
			else if (empty($param["fechaInicioReto"])){
				$fechaInicioReto = NULL;
			}
			if(isset($param["fechaFinReto"]) and !empty($param["fechaFinReto"]))
			{
				$fechaFinReto = $param["fechaFinReto"];
			} 
			else if (empty($param["fechaFinReto"])){
				$fechaFinReto = NULL;
			}
			if(isset($param["fechaPublicacion"]) and !empty($param["fechaPublicacion"]))
			{
				$fechaPublicacion = $param["fechaPublicacion"];
			} 
			else if (empty($param["fechaPublicacion"])){
				$fechaPublicacion = NULL;
			}
			if(isset($param["publicado"]) and !empty($param["publicado"]))
			{
				$publicado = $param["publicado"];
			} 
			else if (empty($param["publicado"])){
				$publicado = NULL;
			}
		

		/* SQL*/
		
				if($exists){ 
				$sql = "UPDATE ".$this->table." SET nombre=?, dirigido=?, descripcion=?, fechaFinInscripcion=?, fechaInicioInscripcion=?, 
				fechaFinReto=?, fechaInicioReto=?, fechaPublicacion=?,  publicado=? WHERE id=?";
				$stmt = $this->conection->prepare($sql);
				$stmt->bind_param('ssssssssii', $nombre, $dirigido, $descripcion ,$fechaFinInscripcion, $fechaInicioInscripcion, 
				$fechaFinReto, $fechaInicioReto, $fechaPublicacion, $publicado , $id);
				$res = $stmt->execute();
			}else{
				$sql = "INSERT INTO ".$this->table."(nombre, dirigido, descripcion, fechaFinInscripcion, fechaInicioInscripcion, fechaFinReto,
				fechaInicioReto, fechaPublicacion, publicado) values (?,?,?,?,?,?,?,?,?)";
				$stmt = $this->conection->prepare($sql);
				$stmt->bind_param('ssssssssi', $nombre, $dirigido, $descripcion ,$fechaFinInscripcion, $fechaInicioInscripcion, $fechaFinReto, 
				$fechaInicioReto,$fechaPublicacion, $publicado,);
				$stmt->execute();
				$id = $this->conection->insert_id;
		}	
		}catch(Exception $error){
			$error=$this->conection->errno;
			$error2=$this->conection->error;
			
			if ($error == 1062){
				return 'duplicado';
			}
			if ($error == 4025){
				return 'check';
			}
			/*if($error == 1064){
				return "null";
			}*/
			if($error == 1048){
				return "null";
			}
			else{
				echo $error;
				echo $error2;
			}
		}
			return $id;	

		}

	/* Eliminar reto por id */
	public function deleteRetoById($id){
		$this->getConection();
		$sql = "DELETE FROM ".$this->table. " WHERE id = ?";
		$stmt = $this->conection->prepare($sql);
		$stmt->bind_param('i', $id);
		return $stmt->execute();
	}

}

?>