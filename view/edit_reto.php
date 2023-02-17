<?php

//Siempre ponemos los campos vacios al iniciar la vista

$id = $nombre = $dirigido = $descripcion = $fechaInicioInscripcion =
 $fechaFinInscripcion = $fechaInicioReto = $fechaFinReto = $fechaPublicacion = "";

//En el caso de que sea una modificación quiero obtener los valores
if(isset($dataToView["data"]["id"])) $id = $dataToView["data"]["id"];
if(isset($dataToView["data"]["idCategoria"])) $id = $dataToView["data"]["idCategoria"];
if(isset($dataToView["data"]["nombreCategoria"])) $nombre = $dataToView["data"]["nombreCategoria"];
if(isset($dataToView["data"]["nombre"])) $nombre = $dataToView["data"]["nombre"];
if(isset($dataToView["data"]["dirigido"])) $dirigido = $dataToView["data"]["dirigido"];
if(isset($dataToView["data"]["descripcion"])) $descripcion = $dataToView["data"]["descripcion"];
if(isset($dataToView["data"]["fechaInicioInscripcion"])) $fechaInicioInscripcion = $dataToView["data"]["fechaInicioInscripcion"];
if(isset($dataToView["data"]["fechaFinInscripcion"])) $fechaFinInscripcion = $dataToView["data"]["fechaFinInscripcion"];
if(isset($dataToView["data"]["fechaInicioReto"])) $fechaInicioReto = $dataToView["data"]["fechaInicioReto"];
if(isset($dataToView["data"]["fechaFinReto"])) $fechaFinReto = $dataToView["data"]["fechaFinReto"];
if(isset($dataToView["data"]["fechaPublicacion"])) $fechaPublicacion = $dataToView["data"]["fechaPublicacion"];
var_dump($dataToView);

?>
<div class="row">
	<?php
	if(isset($_GET["response"]) and $_GET["response"] === true){
		?>
		<div class="alert alert-success">
			Operación realizada correctamente. <a href="index.php?controller=reto&action=list">Volver al listado</a>
		</div>
		<?php
	}
	if(isset($_GET["duplicado"]) and $_GET["duplicado"] === true){
		?>
		<div class="alert alert-danger">
			Operación Fallida El nombre se encuentra duplicado<a href="index.php?controller=reto&action=list">Volver al listado</a>
		</div>
		<?php
	}
	if(isset($_GET["check"]) and $_GET["check"] === true){
		?>
		<div class="alert alert-danger">
			Operación Fallida Las fechas de inicio deben de ser anteriores a las fechas de fin <a href="index.php?controller=reto&action=list">Volver al listado</a>
		</div>
		<?php
	}
	if(isset($_GET["null"]) and $_GET["null"] === true){
		?>
		<div class="alert alert-danger">
			Operación Fallida Asegurate de rellenar el formulario <a href="index.php?controller=reto&action=list">Volver al listado</a>
		</div>
		<?php
	}
	?>
	<form class="form" action="index.php?controller=reto&action=save" method="POST">
		<input type="hidden" name="id" value="<?php echo $id; ?>" />
		<div class="form-group">
			<label>Nombre</label>
			<input class="form-control" type="text" name="nombre" value="<?php echo $nombre; ?>" />
		</div>
		<div class="form-group mb-2">
			<label>Dirigido</label>
			<input type="text" class="form-control" name="dirigido" value="<?php echo $dirigido; ?>" />
		</div>
		<div class="form-group mb-2">
			<label>Descripción</label>
			<textarea class="form-control" style="white-space: pre-wrap;" name="descripcion"><?php echo $descripcion; ?></textarea>
		</div>
		<div class="form-group mb-2">
			<label>Fecha Inicio Inscripcion</label>
			<input type="datetime-local"" class="form-control" name="fechaInicioInscripcion" value="<?php echo $fechaInicioInscripcion; ?>" />
		</div>
		<div class="form-group mb-2">
			<label>Fecha Fin Inscripcion</label>
			<input type="datetime-local"" class="form-control" name="fechaFinInscripcion" value="<?php echo $fechaFinInscripcion; ?>" />
		</div>
		<div class="form-group mb-2">
			<label>Fecha Inicio Reto</label>
			<input type="datetime-local"" class="form-control" name="fechaInicioReto" value="<?php echo $fechaInicioReto; ?>" />
		</div>
		<div class="form-group mb-2">
			<label>Fecha Fin Reto</label>
			<input type="datetime-local" class="form-control" name="fechaFinReto" value="<?php echo $fechaFinReto; ?>" />
		</div>
		<div class="form-group mb-2">
			<label>Fecha Publicacion</label>
			<input type="datetime-local"" class="form-control" name="fechaPublicacion" value="<?php echo $fechaPublicacion; ?>" />
		</div>
		<div class="form-group mb-2">
			<label>Publicar</label>
			<input type="radio" id="radio1" name="publicado" /> Si
			<input type="radio" checked id="radio2" name="publicado" /> No
		</div>
		<input type="submit" value="Guardar" class="btn btn-primary"/>
		<a class="btn btn-outline-danger" href="index.php?controller=reto&action=list">Cancelar</a>
	</form>
</div>