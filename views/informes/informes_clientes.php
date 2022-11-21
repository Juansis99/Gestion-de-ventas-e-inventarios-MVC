<div class="col-xs-12">
	<h1>Productos comprados por los clientes que mas han comprado: </h1>
	<div>
		<a class="btn btn-primary" href="index.php?c=Informes">Regresar<i class="fa fa-undo"></i></a>
	</div>
	<br>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Cliente</th>
				<th>Cantidad total</th>
				<th>Compras</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($informesClientes["informesClientes"] as $cliente){
				$ID = $cliente["ID"]; 
				?>
				<tr>
					<td><?php echo $cliente['Cliente'] ?></td>
					<td><?php echo $cliente['Cantidad'] ?></td>
					<td>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Producto</th>
									<th>Cantidad</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($informesClientesProductos["informesClientesProductos"] as $producto){ 
									if ($producto["CodCliente"] == $ID) {
										?>
											<tr>
												<td><?php echo $producto['Producto'] ?></td>
												<td><?php echo $producto['Cantidad'] ?></td>
											</tr>
										<?php }
									} ?>
							</tbody>
						</table>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>