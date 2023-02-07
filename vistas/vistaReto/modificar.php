<?php
        require '../../modelo/retos.php'; 
        //Necesito recordar a que categoria hago referencia
        session_start();
        $categoria=isset($_SESSION['reto'])?unserialize($_SESSION['reto']):new Reto();                
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
                        <h2>Modificar Retos</h2>
                    </div>
                    <p>Rellena el formulario para actualizar un registro de retos.</p>
                    <form action="../facade.php?actP=reto&act=update" method="post" >
                        <div>
                            <label>Nombre reto</label>
                            <input type="text" name="nombre" value="<?php echo $reto->nombre; ?> ">                   
                        </div>
                        <input type="hidden" name="id" value="<?php echo $reto->id; ?>"/>
                        <input type="submit" name="updatebtn" value="Submit">
                        <a href="../index.php">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>