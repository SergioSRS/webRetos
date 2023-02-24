<?php 

require_once 'model/reto.php';

class retoController{
	public $page_title;
	public $view;

	public function __construct() {
		$this->view = 'list_reto';
		$this->page_title = '';
		$this->retoObj = new Reto();
	}
	//Metodo para conseguir las categorias de la bbdd
	public function getCategorias(){
		return $this->retoObj->getCategorias();
	}
	/* Lista de retos*/
	public function list(){
		$this->page_title = 'Listado de retos';
		
		//Control del filtrado por nombre
		if (isset($_POST['busqueda']) and !empty(($_POST['busqueda'])))
		{	
			$busqueda = ($_POST['busqueda']);
			return $this->retoObj->getRetoFiltrado($busqueda);
		}//Control del filtrado por categoria
		else if(isset($_POST['busquedaC']) and !empty(($_POST['busquedaC']))){
			
			$busqueda = ($_POST['busquedaC']);
			return $this->retoObj->getRetoFiltradoCategoria($busqueda);
		}
		else
		{
			return $this->retoObj->getRetos();
		}
	
	}

	/* Carga el reto para editar*/
	public function edit($id = null){
		$this->page_title = 'Editar reto';
		$this->view = 'edit_reto';
		
		if(isset($_GET["id"])) $id = $_GET["id"];
		return $this->retoObj->getRetoById($id);
	}
	/* Carga el reto para consultar*/
	public function consultar($id = null){
		$this->page_title = 'Consultar reto';
		$this->view = 'consultar_reto';
		
		if(isset($_GET["id"])) $id = $_GET["id"];
		return $this->retoObj->getRetoById($id);
	}

	/*Metodo que crea o actualiza un reto */
	public function save(){
		$this->view = 'edit_reto';
		$this->page_title = 'Editar reto';
		
		$id = $this->retoObj->save($_POST);
		//Controles del resultado del alta o del modificar
		//Dependiendo del resultado nos activará un mensaje en la vista
		if ($id=="duplicado"){
			
			$result = "error";
			$_GET["duplicado"] = true;
			return $result;
		}
		if($id=="check"){
			$result = "error";
			$_GET["check"] = true;
			return $result;
		}
		if($id=="null"){
			$result = "error";
			$_GET["null"] = true;
			return $result;
		}
		$result = $this->retoObj->getRetoById($id);
		$_GET["response"] = true;
	
		return $result;
	}

	/* El confirmar para deletear*/
	public function confirmDelete(){
		$this->page_title = 'Eliminar reto';
		$this->view = 'confirm_delete_reto';
		return $this->retoObj->getRetoById($_GET["id"]);
	}

	/* Delete */
	public function delete(){
		$this->page_title = 'Listado de retos';
		$this->view = 'delete_reto';
		return $this->retoObj->deleteRetoById($_POST["id"]);
	}

}

?>