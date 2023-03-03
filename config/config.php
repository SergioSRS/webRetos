<?php

/* conexion de la base de datos */
define("DB_HOST", "localhost");
define("DB", "paginaRetos");
define("DB_USER", "root");
define("DB_PASS", "");
define("CODIFICACION","UTF8mb4");

/* opciones por defecto*/
define("DEFAULT_CONTROLLER", "app");
define("DEFAULT_ACTION", "list");

ini_set('session.cookie_lifetime',0);// cuando un navegador finaliza, la cookie de ID de sesión se elimina inmediatamente
ini_set('session.cookie_httponly',true);//Este ajuste previene del robo de cookies por inyecciones de JavaScript. 
ini_set('session.use_strict_mode',true);//Para que no puedan usar un id de sesion si no se ha iniciado sesion.
ini_set('session.use_only_cookies',1); //Las cookies deben estar activas incondicionalmente en el lado del usuario, o las sesiones no funcionarán. 
?>