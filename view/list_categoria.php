<div class="row">
	<div class="col-md-12 text-right">
		<a href="index.php?controller=categoria&action=edit" class="btn btn-outline-primary">Crear categoria</a>
		<form method="post" action="index.php?controller=categoria&action=list">
			<input type="text" name="busqueda"/><input type="submit" class="btn btn-outline-primary" value="Filtrar por Nombre">
		</form>
		<hr/>
	</div>
	<?php
	if(count($dataToView["data"])>0){
		foreach($dataToView["data"] as $categoria){
			?>
			<div class="col-md-3">
				<div class="card-body border border-secondary rounded">
					<h5 class="card-title"><?php echo $categoria['nombreCategoria']; ?></h5>
					<hr class="mt-1"/>
					<a href="index.php?controller=categoria&action=edit&id=<?php echo $categoria['idCategoria']; ?>" class="btn btn-primary">Editar</a>
					<a href="index.php?controller=categoria&action=confirmDelete&id=<?php echo $categoria['idCategoria']; ?>" class="btn btn-danger">Eliminar</a>
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
		<a href=index.php><button  class="btn btn-info">Volver al cpanel</button></a>
	</div>	
</div>