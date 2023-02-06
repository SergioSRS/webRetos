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
                        <h2>Añadir categoria</h2>
                    </div>
                    <p>Rellena el formulario y acepta para enviar los datos a la base de datos</p>
                    <form action="../facade.php?actP=categoria&act=add" method="post" >
                        <div >
                            <label>Nombre Categoria</label>
                            <input name="nombre">
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