<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C_Panel</title>
</head>
<body>
    <div>
        <div class="col-md-3">
            <a href="index.php?controller=categoria">Categorias</a>
        </div>
        <div class="col-md-3">
            <a href="index.php?controller=reto">Reto</a>
        </div>
    </div>
    <form method="post" action="index.php?controller=app&action=insertarProfesores" enctype="multipart/form-data">
        <label>Añadir profesores<input type="file" name="profesores"></label>
        <input type="submit" name="enviarFile">
    </form>
    <form method="post" action="index.php?controller=app&action=validarUsuario">
        <input type="submit" value="Cerrar Sesion"name="cerrarSesion"/>
    </form>
</body>
</html>