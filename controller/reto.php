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

	/* LiLista de retos*/
	public function list(){
		$this->page_title = 'Listado de retos';

		if (isset($_POST['busqueda']) and !empty(($_POST['busqueda'])))
		{	
			$busqueda = ($_POST['busqueda']);
			return $this->retoObj->getRetoFiltrado($busqueda);
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
		/* Id can from get param or method param */
		
		if(isset($_GET["id"])) $id = $_GET["id"];
		return $this->retoObj->getRetoById($id);
	}

	/*Metodo que crea o actualiza un reto */
	public function save(){
		$this->view = 'edit_reto';
		$this->page_title = 'Editar reto';
		$id = $this->retoObj->save($_POST);
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