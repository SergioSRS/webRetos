<?php
        require '../modelo/categorias.php'; 
        //Necesito recordar a que categoria hago referencia
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
    <div>
        <div>
            <div>
                <div>
                    <div>
                        <h2>Modificar Categorias</h2>
                    </div>
                    <p>Rellena el formulario para actualizar un registro de categorias.</p>
                    <form action="../index.php?act=update" method="post" >
                        <div>
                            <label>Nombre categoria</label>
                            <input type="text" name="nombre" value="<?php echo $categoria->nombre; ?> ">
                            
                        </div>
                        <input type="hidden" name="id" value="<?php echo $categoria->id; ?>"/>
                        <input type="submit" name="updatebtn" value="Submit">
                        <a href="../index.php">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>