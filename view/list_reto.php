<div class="row">
	<div class="col-md-12 text-right">
		<a href="index.php?controller=reto&action=edit" class="btn btn-outline-primary">Crear reto</a>
		<form method="post" action="index.php?controller=reto&action=list">
			<input type="text" name="busqueda"/><input type="submit" class="btn btn-outline-primary" value="Filtrar por Nombre">
			<label>
				<select class="form-select" name="busquedaC">
				<option value="">Selecciona una categoria</option>
					<?php
				
						foreach($dataToView['select'] as $categoria){
							?>
								<option value="<?php echo $categoria['nombreCategoria']?>"><?php echo $categoria['nombreCategoria']?></option>
							<?php
							}
						?>
				</select>
			</label><input type="submit" class="btn btn-outline-primary" value="Filtrar por Categoría">
		</form>
		<hr/>
	</div>
	<?php
	if(count($dataToView["data"])>0){
		foreach($dataToView["data"] as $reto){
			?>
			<div class="col-md-3">
				<div class="card-body border border-secondary rounded">
					<h5 class="card-title"><?php echo $reto['nombre']; ?></h5>
					<div class="card-text"><?php echo $reto['dirigido']; ?></div>
					<hr class="mt-1"/>
					<a href="index.php?controller=reto&action=edit&id=<?php echo $reto['id']; ?>" class="btn btn-primary">Editar</a>
					<a href="index.php?controller=reto&action=consultar&id=<?php echo $reto['id']; ?>" class="btn btn-info">Consultar</a>
					<a href="index.php?controller=reto&action=confirmDelete&id=<?php echo $reto['id']; ?>" class="btn btn-danger">Eliminar</a>
					<a href="index.php?controller=reto&action=descargarPDF&id=<?php echo $reto['id']; ?>" class="btn btn-dark">descargarPDF</a>				
				</div>
			</div>
			<?php
		}
	}else{
		?>
		<div class="alert alert-info">
			Actualmente no existen retos.
		</div>
		<?php
	}
?>
	<div class="col-md-3">
		<a href="index.php?controller=app&action=validarUsuario"><button  class="btn btn-info">Volver al cpanel</button></a>
	</div>	
</div>