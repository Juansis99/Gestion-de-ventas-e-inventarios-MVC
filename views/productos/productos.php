<div class="col-xs-12">
	<h1><?php echo $productos["Titulo"] ?></h1>
	<div>
		<a class="btn btn-success" href="index.php?c=Productos&a=nuevoProducto">Nuevo <i class="fa fa-plus"></i></a>
	</div>
	<br>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>ID</th>
				<th>Código</th>
				<th>Descripción</th>
				<th>Precio de compra</th>
				<th>Precio de venta</th>
				<th>Existencia</th>
				<th>Editar</th>
				<th>Eliminar</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($productos["Productos"] as $producto){ ?>
			<tr>
				<td><?php echo $producto['id'] ?></td>
				<td><?php echo $producto['codigo'] ?></td>
				<td><?php echo $producto['descripcion'] ?></td>
				<td><?php echo $producto['precioCompra'] ?></td>
				<td><?php echo $producto['precioVenta'] ?></td>
				<td><?php echo $producto['existencia'] ?></td>
				<td><a class="btn btn-warning" href="<?php echo "index.php?c=Productos&a=modificarProducto&id=" . $producto['id']?>"><i class="fa fa-edit"></i></a></td>
				<td><a class="btn btn-danger" href="<?php echo "index.php?c=Productos&a=eliminarProducto&id=" . $producto['id']?>"><i class="fa fa-trash"></i></a></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>