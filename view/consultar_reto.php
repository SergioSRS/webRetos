<?php

//Siempre ponemos los campos vacios al iniciar la vista

$id = $nombre = $dirigido = $descripcion = $fechaInicioInscripcion =
 $fechaFinInscripcion = $fechaInicioReto = $fechaFinReto = $fechaPublicacion = "";
 $idCategoria = "";

 //Obtener el listado de categorias en la vista
 $categorias = $dataToView["select"]; 
//En el caso de que sea una modificación quiero obtener los valores
if(isset($dataToView["data"]["id"])) $id = $dataToView["data"]["id"];
if(isset($dataToView["data"]["nombre"])) $nombre = $dataToView["data"]["nombre"];
if(isset($dataToView["data"]["dirigido"])) $dirigido = $dataToView["data"]["dirigido"];
if(isset($dataToView["data"]["idCategoria"])) $idCategoria = $dataToView["data"]["idCategoria"];
if(isset($dataToView["data"]["descripcion"])) $descripcion = $dataToView["data"]["descripcion"];
if(isset($dataToView["data"]["fechaInicioInscripcion"])) $fechaInicioInscripcion = $dataToView["data"]["fechaInicioInscripcion"];
if(isset($dataToView["data"]["fechaFinInscripcion"])) $fechaFinInscripcion = $dataToView["data"]["fechaFinInscripcion"];
if(isset($dataToView["data"]["fechaInicioReto"])) $fechaInicioReto = $dataToView["data"]["fechaInicioReto"];
if(isset($dataToView["data"]["fechaFinReto"])) $fechaFinReto = $dataToView["data"]["fechaFinReto"];
if(isset($dataToView["data"]["fechaPublicacion"])) $fechaPublicacion = $dataToView["data"]["fechaPublicacion"];


?>
<div class="row">
	<table class="default">
	<tr>
		<th>Nombre</th>
		<th>Dirigido</th>
		<th>Descripcion</th>
		<th>FechaInicioInscripcion</th>
		<th>FechaFinInscripcion</th>
		<th>FechaInicioReto</th>
		<th>FechaFinReto</th>
		<th>FechaPublicacion</th>
	</tr>
	<tr>
		<td><?php echo $nombre; ?></td>
		<td><?php echo $dirigido; ?></td>
		<td><?php echo $descripcion; ?></td>
		<td><?php echo $fechaInicioInscripcion; ?></td>
		<td><?php echo $fechaFinInscripcion; ?></td>
		<td><?php echo $fechaInicioReto; ?></td>
		<td><?php echo $fechaFinReto; ?></td>
		<td><?php echo $fechaPublicacion; ?></td>
	</tr>
	</table>
	<a href="index.php?controller=reto"><button>Volver</button></a>
</div>