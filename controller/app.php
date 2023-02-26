<?php
//En un futuro tendra metodos para conectar las vistas con el modelo, esta pensando para administrar las vistas despues del logeo
class appController{
    public $page_title;
	public $view;
	public function __construct() {
		$this->view = 'c_panel';
		$this->page_title = 'Control panel';
	}

}