<?php 

class Categoria {
	//Nombre de la tabla categoria
	private $table = 'categoria';
	private $conection;

	public function __construct() {
		
	}

	/* Setear conexion */
	public function getConection(){
		$dbObj = new Db();
		$this->conection = $dbObj->conection;
	}

	/* Coger todos las categorias */
	public function getCategorias(){
		
		$this->getConection();
		$sql = "SELECT * FROM ".$this->table;
		$result = $this->conection->query($sql);

		return $result->fetch_all(MYSQLI_ASSOC);
	}

	/* Coge un registro por id */
	public function getCategoriaById($id){
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
	public function getCategoriaFiltrado($busqueda){
		
		$this->getConection();
		$sql = "SELECT * FROM ".$this->table." WHERE nombre LIKE "."'".$busqueda."'";
		$result = $this->conection->query($sql);

		return $result->fetch_all(MYSQLI_ASSOC);
	}
	/* Guarda la categoria, ya sea actualizado o registrada por primera vez */
	public function save($param){
		$this->getConection();

		/* Queremos que los campos por defectos estén vacios como un alta debería de tener*/
		
		$nombre = "";
		/* Sirve para saber si el registro esta en la bbdd, si está, los atributos se llenan con los de la bbdd*/
		$exists = false;
		if(isset($param["id"])  and $param["id"] !=''){
			$actualReto = $this->getRetoById($param["id"]);
			if(isset($actualReto["id"])){
				$exists = true;	
				/* valores que quiero modificar*/
				$id = $param["id"];
				$nombre = $actualReto["nombreCategoria"];
			}
		}

		/* Valores recibidos de un alta o un modificar */
		/* Con este bloque de codigo me aseguro que lo que venga en blanco se guarde como null*/
		try{
			
			if(isset($param["nombreCategoria"]) and !empty($param["nombreCategoria"]))
			{
				$nombre = $param["nombreCategoria"];
			} 
			else if (empty($param["nombreCategoria"])){
				$nombre = NULL;
			}
		

		/* SQL*/
			
			if($exists){ 
				$sql = "UPDATE ".$this->table." SET nombreCategoria=? WHERE id=?";
				$stmt = $this->conection->prepare($sql);
				$stmt->bind_param('si', $nombre, $id);
				$res = $stmt->execute();
			}else{
				$sql = "INSERT INTO ".$this->table."(nombreCategoria) values (?)";
				$stmt = $this->conection->prepare($sql);
				$stmt->bind_param('s', $nombre);
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
	public function deleteCategoriaById($id){
		$this->getConection();
		$sql = "DELETE FROM ".$this->table. " WHERE id = ?";
		$stmt = $this->conection->prepare($sql);
		$stmt->bind_param('i', $id);
		return $stmt->execute();
	}
}

?>