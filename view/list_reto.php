<div class="row">
	<div class="col-md-12 text-right">
		<a href="index.php?controller=reto&action=edit" class="btn btn-outline-primary">Crear reto</a>
		<hr/>
	</div>
	<?php
	if(count($dataToView["data"])>0){
		foreach($dataToView["data"] as $reto){
			?>
			<div class="col-md-3">
				<div class="card-body border border-secondary rounded">
					<h5 class="card-title"><?php echo $reto['nombre']; ?></h5>
					<div class="card-text"><?php echo nl2br($reto['dirigido']); ?></div>
					<hr class="mt-1"/>
					<a href="index.php?controller=reto&action=edit&id=<?php echo $reto['id']; ?>" class="btn btn-primary">Editar</a>
					<a href="index.php?controller=reto&action=confirmDelete&id=<?php echo $reto['id']; ?>" class="btn btn-danger">Eliminar</a>
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
</div>