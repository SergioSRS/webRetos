<?php
 require '../modelo/categorias.php'; 

session_start();
//Este codigo saca el valor almacenado en la sesion y crea la categoria para usarse en este documento
$categoria=isset($_SESSION['categoria'])?unserialize($_SESSION['categoria']):new Categoria();            
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Alta</title>
    <link type="text/css" rel="stylesheet" >
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Añadir categoria</h2>
                    </div>
                    <p>Rellena el formulario y acepta para enviar los datos a la base de datos</p>
                    <form action="../index.php?act=add" method="post" >
                        <div class="form-group">
                            <label>Nombre Categoria</label>
                            <input name="nombre" class="form-control" ">
                        </div>
                        <input type="submit" name="addbtn" class="btn btn-primary" value="Submit">
                        <a href="../index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>