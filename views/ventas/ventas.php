<div class="col-xs-12">
	<h1>Ventas</h1>
	<div>
		<a class="btn btn-success" href="index.php?c=Ventas&a=vender">Nueva<i class="fa fa-plus"></i></a>
	</div>
	<br>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Código de venta</th>
				<th>Código de Cliente</th>
				<th>Fecha</th>
				<th>Productos vendidos</th>
				<th>Total</th>
				<th>Estado</th>
				<th>Ticket</th>
				<th>Anular</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($ventas["ventas"] as $venta){ 
				$ID = $venta['id'] ?>
				<tr>
					<td><?php echo $venta['id'] ?></td>
					<td><?php echo $venta['id_cliente'] ?></td>
					<td><?php echo $venta['fecha'] ?></td>
					<td>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Producto</th>
									<th>Cantidad</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($productosVendidos["productos"] as $producto) {
								if ($producto['IDV'] == $ID) { 
									?>
									<tr>
										<td><?php echo $producto["Producto"] ?></td>
										<td><?php echo $producto["Cantidad"] ?></td>
									</tr>
								<?php } } ?>
							</tbody>
						</table>
					</td>
					<td><?php echo $venta['total'] ?></td>
					<td><?php echo $venta['estado'] ?></td>
					<!-- Modificacion JS -->
					<?php if($venta['estado'] == "Activa" ) { ?>
						<td><a class="btn btn-info" href="<?php echo "index.php?c=Ventas&a=imprimirTicket&id=" . $venta['id']?>"><i class="fa fa-print"></i></a></td>
						<td><a class="btn btn-danger" href="<?php echo "index.php?c=Ventas&a=anularVenta&id=" . $venta['id']?>"><i class="fa fa-trash"></i></a></td>
					<?php } ?>
					<!-- Fin modificacion JS -->
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>