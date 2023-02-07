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
                        <a href="index.php">Volver</a>
                        <h2>Retos</h2>
                        <a href="vistas/vistaReto/alta.php">Añadir reto</a>
                    </div>
                    <?php
                        //Si existen resultados en la base de datos queremos que nos salgan listados
                        if($result->num_rows > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>id</th>";                                        
                                        echo "<th>Reto</th>";
                                        echo "<th>Acciones</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($fila = $result->fetch_array()){
                                    echo "<tr>";
                                        echo "<td>" . $fila['idReto'] . "</td>";                                        
                                        echo "<td>" . $fila['nombre'] . "</td>";
                                        echo "<td>" . $fila['dirigido'] . "</td>";
                                        echo "<td>" . $fila['descripcion'] . "</td>";
                                        echo "<td>" . $fila['fechaFinInscripcion'] . "</td>";
                                        echo "<td>";
                                        echo "<a href='facade.php?actP=reto&act=update&id=". $fila['idReto'] ."' title='Update Record' data-toggle='tooltip'>🖊️</a>";
                                        echo "<a href='facade.php?actP=reto&act=delete&id=". $fila['idReto'] ."' title='Delete Record' data-toggle='tooltip'>🗑️</a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                        } else{
                            //Si no existen registros en la base de datos
                            echo "<p class='lead'>No existen registros de retos</p>";
                        }
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>