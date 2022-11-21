<div class="col-xs-12">
	<h1>Productos mas comprados: </h1>
	<div>
		<a class="btn btn-primary" href="index.php?c=Informes">Regresar<i class="fa fa-undo"></i></a>
	</div>
	<br>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Producto</th>
				<th>Cantidad</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($informesProductos["informesProductos"] as $producto){ ?>
				<tr>
					<td><?php echo $producto['CodProducto']." - ".$producto['Producto'] ?></td>
					<td><?php echo $producto['Cantidad'] ?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>