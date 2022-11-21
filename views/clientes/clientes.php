<div class="col-xs-12">
	<h1><?php echo $clientes["Titulo"] ?></h1>
	<div>
		<a class="btn btn-success" href="index.php?c=Clientes&a=nuevoCliente">Nuevo <i class="fa fa-plus"></i></a>
	</div>
	<br>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nombres</th>
				<th>Apellidos</th>
				<th>Fecha de nacimiento</th>
				<th>Edad</th>
				<th>Correo</th>
				<th>Ciudad</th>
				<th>Editar</th>
				<th>Eliminar</th>
				<th>Compras</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($clientes["Clientes"] as $cliente){ ?>
			<tr>
				<td><?php echo $cliente['id'] ?></td>
				<td><?php echo $cliente['nombres'] ?></td>
				<td><?php echo $cliente['apellidos'] ?></td>
				<td><?php echo $cliente['fecha_nacimiento'] ?></td>
				<td><?php echo $cliente['edad'] ?></td>
				<td><?php echo $cliente['correo'] ?></td>
				<td><?php echo $cliente['ciudad'] ?></td>
				<td><a class="btn btn-warning" href="<?php echo "index.php?c=Clientes&a=modificarCliente&id=" . $cliente['id'] ?>"><i class="fa fa-edit"></i></a></td>
				<td><a class="btn btn-danger" href="<?php echo "index.php?c=Clientes&a=eliminarCliente&id=" . $cliente['id'] ?>"><i class="fa fa-trash"></i></a></td>
				<td><a class="btn btn-info" href="<?php echo "index.php?c=Ventas&a=ventasCliente&id=" . $cliente['id'] ?>"><i class="fa fa-eye"></i></a></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>