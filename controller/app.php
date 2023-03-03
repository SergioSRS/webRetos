<?php
require_once 'model/login.php';

class appController{
    public $page_title;
	public $view;
	public function __construct() {
	
		$this->view = 'app_login';
		if(!$_SESSION || isset($_POST['cerrarSesion'])){
			$this->page_title = "Login de Profesores";
		}else{
			$this->page_title = "Panel de control";
		}
		$this->loginObj = new Login();
	}
	
	public function validarUsuario(){
	
		$this->loginObj->validarUsuario($_POST);
		
		if(!$_SESSION || isset($_POST['cerrarSesion'])){
			session_destroy();
			//$this->view = 'app_login';
			$this->page_title = "Login de Profesores";
		}else{
			$this->page_title = "Panel de control";
		}
	}

}