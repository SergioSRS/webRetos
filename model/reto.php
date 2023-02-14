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
		//meter Validacion de si conseguimos la lista de retos no?
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
		if(isset($param["nombre"])) $nombre = $param["nombre"];
		if(isset($param["dirigido"])) $dirigido = $param["dirigido"];
		if(isset($param["descripcion"])) $descripcion = $param["descripcion"];
		if(isset($param["fechaInicioInscripcion"])) $fechaInicioInscripcion = $param["fechaInicioInscripcion"];
		if(isset($param["fechaFinInscripcion"])) $fechaFinInscripcion = $param["fechaFinInscripcion"];
		if(isset($param["fechaInicioReto"])) $fechaInicioReto = $param["fechaInicioReto"];
		if(isset($param["fechaFinReto"])) $fechaFinReto = $param["fechaFinReto"];
		if(isset($param["fechaPublicacion"])) $fechaPublicacion = $param["fechaPublicacion"];
		if(isset($param["publicado"])) $publicado = $param["publicado"];

		/* SQL*/
		try{

		
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
			 $fechaInicioReto,$fechaPublicacion, $publicado);
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
	/*	if($error == 1064){
			return "null";
		}*/
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