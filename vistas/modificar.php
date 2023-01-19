<?php
        require '../modelo/categorias.php'; 
        session_start();
        $categoria=isset($_SESSION['categoria'])?unserialize($_SESSION['categoria']):new Categoria();                
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modificar</title>
    <link rel="stylesheet" type="text/css">
    
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Modificar Categorias</h2>
                    </div>
                    <p>Rellena el formulario para actualizar un registro de categorias.</p>
                    <form action="../index.php?act=update" method="post" >
                      
                        <div class="form-group">
                            <label>Nombre categoria</label>
                            <input type="text" name="nombre" class="form-control" value="<?php echo $categoria->nombre; ?> ">
                            
                        </div>
                        <input type="hidden" name="id" value="<?php echo $categoria->id; ?>"/>
                        <input type="submit" name="updatebtn" class="btn btn-primary" value="Submit">
                        <a href="../index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>