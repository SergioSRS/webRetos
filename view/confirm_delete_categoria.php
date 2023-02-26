<div class="row">
	<form class="form" action="index.php?controller=categoria&action=delete" method="POST">
		<input type="hidden" name="idCategoria" value="<?php echo $dataToView["data"]["idCategoria"]; ?>" />
		<div class="alert alert-warning">
			<b>¿Confirma que desea eliminar esta categoria?:</b>
			<i><?php echo $dataToView["data"]["nombreCategoria"]; ?></i>
		</div>
		<input type="submit" value="Eliminar" class="btn btn-danger"/>
		<a class="btn btn-outline-success" href="index.php?controller=categoria&action=list">Cancelar</a>
	</form>
</div>