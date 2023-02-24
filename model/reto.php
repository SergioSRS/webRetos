<?php 

class Reto {
	//Nombre de la tabla retos
	private $table = 'retos';
	//Nombre de la tabla categoria
	private $table2 = 'categoria';
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
	//Metodo que sirve para realizar una busqueda de un reto por nombre
	public function getRetoFiltrado($busqueda){
		
		$this->getConection();
		$sql = "SELECT * FROM ".$this->table." WHERE nombre LIKE "."'".$busqueda."'";
		$result = $this->conection->query($sql);

		return $result->fetch_all(MYSQLI_ASSOC);
	}
	//Metodo que sirve para realizar un filtrado de retos por categoria
	public function getRetoFiltradoCategoria($busqueda){
		
		$this->getConection();

		$sql = "SELECT * FROM ".$this->table." INNER JOIN ".$this->table2." ON retos.idCategoria = categoria.idCategoria
		where categoria.nombreCategoria LIKE "."'".$busqueda."'";
		$result = $this->conection->query($sql);
		//Usamos el paramatro opcional para tener el array como un array asociativo
		return $result->fetch_all(MYSQLI_ASSOC);
	}

	/* Guarda el reto, ya sea actualizado o registrado por primera vez */
	public function save($param){
		$this->getConection();

		/* Queremos que los campos por defectos estén vacios como un alta debería de tener*/
		
		$nombre = $dirigido = $descripcion = $fechaInicioInscripcion =
		$fechaFinInscripcion = $fechaInicioReto = $fechaFinReto = $fechaPublicacion = $idCategoria = "";
		$publicado = false;

		//Por ahora el id del profesor es este
		$idProfesor = 1;

		/* Sirve para saber si el registro esta en la bbdd, si está, los atributos se llenan con los de la bbdd*/
		$exists = false;
		if(isset($param["id"])  and $param["id"] !=''){
			$actualReto = $this->getRetoById($param["id"]);
			if(isset($actualReto["id"])){
				$exists = true;	
				/* valores que quiero modificar*/
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
				$idCategoria = $actualReto['idCategoria'];
			}
		}

		/* Valores recibidos de un alta o un modificar */
		/* Con este bloque de codigo me aseguro que lo que venga en blanco se guarde como null*/
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
			if(isset($param["idCategoria"]) and !empty($param["idCategoria"]))
			{
				$idCategoria = $param["idCategoria"];
			} 
			else if (empty($param["idCategoria"])){
				$idCategoria = NULL;
			}
		

		/* SQL*/
			
			if($exists){ 
				$sql = "UPDATE ".$this->table." SET nombre=?, dirigido=?, descripcion=?, fechaFinInscripcion=?, fechaInicioInscripcion=?, 
				fechaFinReto=?, fechaInicioReto=?, fechaPublicacion=?,  publicado=?, idCategoria=? , idProfesor=? WHERE id=?";
				$stmt = $this->conection->prepare($sql);
				$stmt->bind_param('ssssssssiiii', $nombre, $dirigido, $descripcion ,$fechaFinInscripcion, $fechaInicioInscripcion, 
				$fechaFinReto, $fechaInicioReto, $fechaPublicacion, $publicado ,  $idCategoria, $idProfesor, $id,);
				$res = $stmt->execute();
			}else{
				$sql = "INSERT INTO ".$this->table."(nombre, dirigido, descripcion, fechaFinInscripcion, fechaInicioInscripcion, fechaFinReto,
				fechaInicioReto, fechaPublicacion, publicado, idCategoria, idProfesor) values (?,?,?,?,?,?,?,?,?,?,?)";
				$stmt = $this->conection->prepare($sql);
			
				$stmt->bind_param('ssssssssiii', $nombre, $dirigido, $descripcion ,$fechaFinInscripcion, $fechaInicioInscripcion, $fechaFinReto, 
				$fechaInicioReto,$fechaPublicacion, $publicado, $idCategoria, $idProfesor);
				$stmt->execute();
				$id = $this->conection->insert_id;
			}	
		}catch(Exception $error){

			$error=$this->conection->errno;
			$error2=$this->conection->error;
			//Codigo de error 1062 al insertar datos duplicados en un campo con restriccion unique
			if ($error == 1062){
				return 'duplicado';
			}
			//Codigo de error 4025 si al insertar datos en un campo no cumple el requisito check especificado en la bbdd
			if ($error == 4025){
				return 'check';
			}
			//Codigo de error 1048 al insertar null en un campo que no permite null.
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
	/* Sacar el listado de categorias */
	public function getCategorias(){
		$this->getConection();
		$sql = "SELECT * FROM ".$this->table2;
		$result = $this->conection->query($sql);
		return $result->fetch_all(MYSQLI_ASSOC);
		
	}
}

?>