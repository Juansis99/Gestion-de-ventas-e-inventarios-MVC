<div class="col-xs-12">
	<h1>Editar producto con el ID <?php echo $producto['productos']['id']; ?></h1>
	<form method="post" action="index.php?c=Productos&a=guardarProductoModificado">
		<input type="hidden" name="id" value="<?php echo $producto['productos']['id']; ?>">

		<label for="codigo">Código de barras:</label>
		<input value="<?php echo $producto['productos']['codigo'] ?>" class="form-control" name="codigo" required type="text" id="codigo" placeholder="Escribe el código">

		<label for="descripcion">Descripción:</label>
		<textarea required id="descripcion" name="descripcion" cols="30" rows="5" class="form-control"><?php echo $producto['productos']['descripcion'] ?></textarea>

		<label for="precioVenta">Precio de venta:</label>
		<input value="<?php echo $producto['productos']['precioVenta'] ?>" class="form-control" name="precioVenta" required type="number" id="precioVenta" placeholder="Precio de venta">

		<label for="precioCompra">Precio de compra:</label>
		<input value="<?php echo $producto['productos']['precioCompra'] ?>" class="form-control" name="precioCompra" required type="number" id="precioCompra" placeholder="Precio de compra">

		<label for="existencia">Existencia:</label>
		<input value="<?php echo $producto['productos']['existencia'] ?>" class="form-control" name="existencia" required type="number" id="existencia" placeholder="Cantidad o existencia">
		<br><br><input class="btn btn-info" type="submit" value="Guardar">
		<a class="btn btn-warning" href="index.php?c=Productos">Cancelar</a>
	</form>
</div>
