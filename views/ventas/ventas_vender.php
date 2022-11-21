<?php
$granTotal = 0;
?>
<div class="col-xs-12">
	<h1>Vender</h1>
	<?php
	if (isset($_GET["status"])) {
		if (($_GET["status"] === "6") || ($_GET["status"] === "5") || ($_GET["status"] === "4") ||($_GET["status"] === "3")) {

		} else if ($_GET["status"] === "1") {
			?>
			<div class="alert alert-success">
				<strong>¡Correcto!</strong> Venta realizada correctamente
			</div>
		<?php
		} else if ($_GET["status"] === "2") {
		?>
			<div class="alert alert-info">
				<strong>Venta cancelada</strong>
			</div>
		<?php
		//Fin adicional Juansis99
		} else {
		?>
			<div class="alert alert-danger">
				<strong>Error:</strong> Algo salió mal mientras se realizaba la venta
			</div>
		<?php
		}
	}
	?>
	<br>
	<!-- Adicional Juansis99 -->
	<h2>Seleccion cliente:</h2>
	<?php
	if (isset($_GET["status"])) {
		// Adicional Juansis99
		 if ($_GET["status"] === "6") {
		?>
			<div class="alert alert-warning">
				<strong>Error:</strong> El cliente que buscas no existe
			</div>
		<?php
		//Fin adicional Juansis99
		}
	}
	?>
	<br>
	<label for="idcliente">Buscar cliente:</label>
	<form method="post" action="index.php?c=Clientes&a=buscarCliente">
		<label for="idcliente"></label>
		<input autocomplete="off" autofocus class="form-control" name="idCliente" required type="text" id="idCliente" placeholder="Escribe el código del cliente">
		<br>
		<br>
	</form>
	<label>Seleccionar cliente:</label>
	<div class="table-wrapper-scroll-y my-custom-scrollbar">
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
					<th>Agregar</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($clientes["Clientes"] as $cliente) { 
					$idCliente = $cliente['id']
				?>
					<tr>
						<td><?php echo $cliente['id'] ?></td>
						<td><?php echo $cliente['nombres'] ?></td>
						<td><?php echo $cliente['apellidos'] ?></td>
						<td><?php echo $cliente['fecha_nacimiento'] ?></td>
						<td><?php echo $cliente['edad'] ?></td>
						<td><?php echo $cliente['correo'] ?></td>
						<td><?php echo $cliente['ciudad'] ?></td>
						<td><a class="btn btn-info" href="<?php echo "index.php?c=Clientes&a=seleccionarCliente&id=" . $cliente['id'] ?>"><i class="fa fa-plus-square" aria-hidden="true"></i></a></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
	<br>
	<br>
	<label for="idcliente">Cliente seleccionado:</label>
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
			</tr>
		</thead>
		<tbody>
			<?php foreach ($_SESSION["cliente"] as $cliente) { 
				$idCliente = $cliente->id
			?>
				<tr>
					<td><?php echo $cliente->id ?></td>
					<td><?php echo $cliente->nombres ?></td>
					<td><?php echo $cliente->apellidos ?></td>
					<td><?php echo $cliente->fecha_nacimiento ?></td>
					<td><?php echo $cliente->edad ?></td>
					<td><?php echo $cliente->correo ?></td>
					<td><?php echo $cliente->ciudad ?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
	<br>
	<br>
	<!-- Fin adicional JS-->		
	<h2>Seleccion productos:</h2>
	<?php
	if (isset($_GET["status"])) {
 		if ($_GET["status"] === "3") {
		?>
			<div class="alert alert-info">
				<strong>Ok</strong> Producto quitado de la lista
			</div>
		<?php
		} else if ($_GET["status"] === "4") {
		?>
			<div class="alert alert-warning">
				<strong>Error:</strong> El producto que buscas no existe
			</div>
		<?php
		} else if ($_GET["status"] === "5") {
		?>
			<div class="alert alert-danger">
				<strong>Error: </strong>El producto está agotado
			</div>
		<?php
		//Fin adicional Juansis99
		}
	}
	?>
	<br>

	<form method="post" action="index.php?c=Productos&a=agregarProductoCarrito">
		<label for="codigo">Buscar producto:</label>
		<input autocomplete="off" autofocus class="form-control" name="codigo" required type="text" id="codigo" placeholder="Escribe el código del producto">
	</form>
	<br>
	<label>Seleccionar producto:</label>
	<div class="table-wrapper-scroll-y my-custom-scrollbar">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>ID</th>
					<th>Código</th>
					<th>Descripción</th>
					<th>Precio de venta</th>
					<th>Existencia</th>
					<th>Agregar</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($productos["Productos"] as $producto){ ?>
				<tr>
					<td><?php echo $producto['id'] ?></td>
					<td><?php echo $producto['codigo'] ?></td>
					<td><?php echo $producto['descripcion'] ?></td>
					<td><?php echo $producto['precioVenta'] ?></td>
					<td><?php echo $producto['existencia'] ?></td>
					<td><a class="btn btn-info" href="<?php echo "index.php?c=Productos&a=seleccionarProductoCarrito&id=" . $producto['codigo']?>"><i class="fa fa-plus-square"></i></a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
	<br>
	<br>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>ID</th>
				<th>Código</th>
				<th>Descripción</th>
				<th>Precio de venta</th>
				<th>Cantidad</th>
				<th>Total</th>
				<th>Quitar</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($_SESSION["carrito"] as $indice => $producto) {
				$granTotal += $producto->total;
			?>
				<tr>
					<td><?php echo $producto->id ?></td>
					<td><?php echo $producto->codigo ?></td>
					<td><?php echo $producto->descripcion ?></td>
					<td><?php echo $producto->precioVenta ?></td>
					<td>
						<form action="index.php?c=Productos&a=modificarCantidadProductoCarrito&indice=" method="post">
							<input name="indice" type="hidden" value="<?php echo $indice; ?>">
							<input min="1" name="cantidad" class="form-control" required type="number" step="0.1" value="<?php echo $producto->cantidad; ?>">
						</form>
					</td>
					<td><?php echo $producto->total ?></td>
					<td><a class="btn btn-danger" href="<?php echo "index.php?c=Productos&a=eliminarProductoCarrito&indice=" . $indice ?>"><i class="fa fa-trash"></i></a></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>

	<h3>Total: <?php echo $granTotal; ?></h3>
	<form action="index.php?c=Ventas&a=terminarVenta" method="POST">
		<input name="total" type="hidden" value="<?php echo $granTotal; ?>">
		<input name="idCliente" type="hidden" value="<?php echo $idCliente; ?>">
		<button type="submit" class="btn btn-success">Terminar venta</button>
		<a href="index.php?c=Ventas&a=cancelarVenta" class="btn btn-danger">Cancelar venta</a>
	</form>
	<br>
	<br>
	<br>
	<br>
	<br>
</div>