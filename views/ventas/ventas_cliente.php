<div class="col-xs-12">
	<h1>Compras del cliente <?php echo $id ?></h1>
	<div>
		<a class="btn btn-success" href="index.php?c=Clientes">Regresar<i class="fa fa-undo"></i></a>
	</div>
	<br>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Código de venta</th>
				<th>Fecha</th>
				<th>Productos vendidos</th>
				<th>Total</th>
				<th>Ticket</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($ventas["ventas"] as $venta){ 
				$IDV = $venta["id"]; ?>
				<tr>
					<td><?php echo $venta['id'] ?></td>
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
								<?php foreach($productos["productos"] as $producto){ 
								if ($producto['IDV'] == $IDV) {
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
					<td><a class="btn btn-info" href="<?php echo "index.php?c=Ventas&a=imprimirTicket&id=" . $venta['id'].'$r=rc'?>"><i class="fa fa-print"></i></a></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
	<div>
		<a class="btn btn-success" href="index.php?c=Clientes">Regresar<i class="fa fa-undo"></i></a>
	</div>
</div>