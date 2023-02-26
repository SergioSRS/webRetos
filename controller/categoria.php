<?php 

require_once 'model/categoria.php';

class categoriaController{
	public $page_title;
	public $view;

	public function __construct() {
		$this->view = 'list_categoria';
		$this->page_title = '';
		$this->categoriaObj = new Categoria();
	}
	/* Lista de categorias*/
	public function list(){
		$this->page_title = 'Listado de categorias';
        if (isset($_POST['busqueda']) and !empty(($_POST['busqueda'])))
		{	
			$busqueda = ($_POST['busqueda']);
			return $this->categoriaObj->getCategoriaFiltrado($busqueda);
        }else{
            return $this->categoriaObj->getCategorias();
        }
       
	}

	/* Carga la categoria para editar*/
	public function edit($id = null){
		$this->page_title = 'Editar categoria';
		$this->view = 'edit_categoria';
		
		if(isset($_GET["id"])) $id = $_GET["id"];
		return $this->categoriaObj->getCategoriaById($id);
	}
	/* Carga el categoria para consultar*/
	public function consultar($id = null){
		$this->page_title = 'Consultar categoria';
		$this->view = 'consultar_categoria';
		
		if(isset($_GET["id"])) $id = $_GET["id"];
		return $this->categoriaObj->getCategoriaById($id);
	}

	/*Metodo que crea o actualiza un categoria */
	public function save(){
		$this->view = 'edit_categoria';
		$this->page_title = 'Editar categoria';
		
		$id = $this->categoriaObj->save($_POST);
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
		$result = $this->categoriaObj->getCategoriaById($id);
		$_GET["response"] = true;
	
		return $result;
	}

	/* El confirmar para deletear*/
	public function confirmDelete(){
		$this->page_title = 'Eliminar categoria';
		$this->view = 'confirm_delete_categoria';
		return $this->categoriaObj->getCategoriaById($_GET["id"]);
	}

	/* Delete */
	public function delete(){
		$this->page_title = 'Listado de categorias';
		$this->view = 'delete_categoria';
		return $this->categoriaObj->deleteCategoriaById($_POST["idCategoria"]);
	}

}

?>