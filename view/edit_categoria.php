<?php

//Siempre ponemos los campos vacios al iniciar la vista

$id = $nombre = "";

//En el caso de que sea una modificación quiero obtener los valores
if(isset($dataToView["data"]["idCategoria"])) $id = $dataToView["data"]["idCategoria"];

if(isset($dataToView["data"]["nombreCategoria"])) $nombre = $dataToView["data"]["nombreCategoria"];

?>
<div class="row">
	<?php
	if(isset($_GET["response"]) and $_GET["response"] === true){
		?>
		<div class="alert alert-success">
			Operación realizada correctamente. <a href="index.php?controller=categoria&action=list">Volver al listado</a>
		</div>
		<?php
	}
	if(isset($_GET["duplicado"]) and $_GET["duplicado"] === true){
		?>
		<div class="alert alert-danger">
			Operación Fallida El nombre se encuentra duplicado<a href="index.php?controller=categoria&action=list">Volver al listado</a>
		</div>
		<?php
	}
	if(isset($_GET["check"]) and $_GET["check"] === true){
		?>
		<div class="alert alert-danger">
			Operación Fallida Las fechas de inicio deben de ser anteriores a las fechas de fin <a href="index.php?controller=categoria&action=list">Volver al listado</a>
		</div>
		<?php
	}
	if(isset($_GET["null"]) and $_GET["null"] === true){
		?>
		<div class="alert alert-danger">
			Operación Fallida Asegurate de rellenar el formulario <a href="index.php?controller=categoria&action=list">Volver al listado</a>
		</div>
		<?php
	}
	?>
	<form class="form" action="index.php?controller=categoria&action=save" method="POST">
		<input type="hidden" name="id" value="<?php echo $id; ?>" />
		<div class="form-group">
			<label>Nombre</label>
			<input class="form-control" type="text" name="nombreCategoria" value="<?php echo $nombre; ?>" />
		</div>
		<input type="submit" value="Guardar" class="btn btn-primary"/>
		<a class="btn btn-outline-danger" href="index.php?controller=categoria&action=list">Cancelar</a>
	</form>
</div>