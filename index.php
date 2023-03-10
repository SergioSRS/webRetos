<?php 

require_once 'config/config.php';
require_once 'model/db.php';
require_once 'pdf/fpdf.php';

session_start();
if(!isset($_GET["controller"])) $_GET["controller"] = constant("DEFAULT_CONTROLLER");
if(!isset($_GET["action"])) $_GET["action"] = constant("DEFAULT_ACTION");

$controller_path = 'controller/'.$_GET["controller"].'.php';

/* Check if controller exists */
if(!file_exists($controller_path)) $controller_path = 'controller/'.constant("DEFAULT_CONTROLLER").'.php';

/* Load controller */
require_once $controller_path;
$controllerName = $_GET["controller"].'Controller';
$controller = new $controllerName();

/* Check if method is defined */
$dataToView["data"] = array();
//Meto aquí el listado de categorias

if(method_exists($controller,$_GET["action"]) and $controllerName == "retoController") {
   
    $dataToView["data"] = $controller->{$_GET["action"]}();
    $dataToView["select"] = $controller->getCategorias();
    
}else if (method_exists($controller,$_GET["action"])) {
 
    $dataToView["data"] = $controller->{$_GET["action"]}();
    //var_dump( $dataToView);
}



/* Load views */
if(!$_SESSION || isset($_POST['cerrarSesion'])){
    require_once 'view/template/header.php';
    require_once 'view/app_login'.'.php';
    require_once 'view/template/footer.php';
}
else
{
    require_once 'view/template/header.php';
    if ($controller->view == "app_login"){
        require_once 'view/c_panel'.'.php';
    }
    else{
        require_once 'view/'.$controller->view.'.php';
    }
    require_once 'view/template/footer.php';
}


?>