<?php
session_unset();
	
    $act  = isset($_GET['actP']) ? $_GET['actP'] : NULL;
    switch ($act) 
    {
        case 'categoria' :                    
            require_once  'controlador/controlador_categorias.php';		
            $controllerCategoria = new controladorCategoria();	
            $controllerCategoria->mvcHandler();
            break;						
        case 'reto':
            require_once  'controlador/controlador_retos.php';		
            $controllerReto = new controladorReto();	
            $controllerReto->mvcHandler();
            break;									
        case 'profesores' :					
            echo "Hola mundo";
            break;								
        default:
         header('Location:index.php');
    }
?>