<?php session_unset() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
    <link rel="stylesheet" type="text/css">     
</head>
<body>
    <div>
        <div>
            <div>
                <div>
                    <div>
                        <a href="index.php">Home</a>
                        <h2>Categorias</h2>
                        <a href="vistas/alta.php">Añadir categoria</a>
                    </div>
                    <?php
                        //Si existen resultados en la base de datos queremos que nos salgan listados
                        if($result->num_rows > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>id</th>";                                        
                                        echo "<th>Categoria</th>";
                                        echo "<th>Acciones</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($fila = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $fila['id'] . "</td>";                                        
                                        echo "<td>" . $fila['nombre'] . "</td>";
                                        echo "<td>";
                                        echo "<a href='index.php?act=update&id=". $fila['id'] ."' title='Update Record' data-toggle='tooltip'>🖊️</a>";
                                        echo "<a href='index.php?act=delete&id=". $fila['id'] ."' title='Delete Record' data-toggle='tooltip'>🗑️</a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                         mysqli_free_result($result);
                        } else{
                            //Si no existen registros en la base de datos
                            echo "<p class='lead'>No existen registros de categorias</p>";
                        }
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>