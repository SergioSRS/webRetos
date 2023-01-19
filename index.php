<?php
session_unset();
	require_once  'controlador/controlador_categorias.php';		
    $controller = new controladorCategoria();	
    $controller->mvcHandler();
    
?>