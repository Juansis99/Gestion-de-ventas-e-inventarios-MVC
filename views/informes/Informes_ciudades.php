<div class="col-xs-12">
	<h1>Cliente que mas mas ha comprado por ciudad: </h1>
	<div>
		<a class="btn btn-primary" href="index.php?c=Informes">Regresar<i class="fa fa-undo"></i></a>
	</div>
	<br>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Ciudad</th>
				<th>Cliente</th>
				<th>Compras</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($informesCiudadesCantidad["informesCiudadesCantidad"] as $ciudad){
				?>
				<tr>
					<td><?php echo $ciudad['Ciudad'] ?></td>
					<td><?php echo $ciudad['Cliente'] ?></td>
					<td><?php echo $ciudad['Compras'] ?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>