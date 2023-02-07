<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Alta</title>
    <link type="text/css" rel="stylesheet" >
</head>
<body>
    <div>
        <div>
            <div>
                <div>
                    <div>
                        <h2>Añadir reto</h2>
                    </div>
                    <p>Rellena el formulario y acepta para enviar los datos a la base de datos</p>
                    <form action="../../facade.php?actP=reto&act=add" method="post" >
                        <div >
                            <label>Nombre</label>
                            <input type=text name="nombre">
                            <label>Dirigido</label>
                            <input type=text name="dirigido">
                            <label>Descripcion</label>
                            <input type=text name="descripcion">
                            <label>fechaFinInscripcion</label>
                            <input type=date name="fechaFinInscripcion">
                            <label>fechaInicioInscripcion</label>
                            <input type=date name="fechaInicioInscripcion">
                            <label>fechaFinReto</label>
                            <input type=date name="fechaFinReto">
                            <label>fechaInicioReto</label>
                            <input type=date name="fechaInicioReto">
                            <label>fechaPublicacion</label>
                            <input type=date name="fechaPublicacion">
                            <label>publicado</label>
                            <input value=1 type=text name="publicado">
                        </div>
                        <input type="submit" name="addbtn" value="Submit">
                        <a href="../index.php">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>