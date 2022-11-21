<div class="col-xs-12">
	<h1>Editar cliente con el ID <?php echo $cliente['clientes']['id']; ?></h1>
	<form method="post" action="index.php?c=Clientes&a=guardarClienteModificado">
		<input type="hidden" name="id" value="<?php echo $cliente['clientes']['id']; ?>">

		<label for="nombres">Nombres:</label>
		<input value="<?php echo $cliente['clientes']['nombres'] ?>" class="form-control" name="nombres" required type="text" id="nombres" placeholder="Escribe los nombres del cliente">

		<label for="apellidos">Apellidos:</label>
		<input required id="apellidos" name="apellidos" cols="30" rows="5" class="form-control" value="<?php echo $cliente['clientes']['apellidos'] ?>"></input>

		<label for="fechaNacimiento">Fecha de nacimiento:</label>
		<input value="<?php echo $cliente['clientes']['fecha_nacimiento'] ?>" class="form-control" name="fechaNacimiento" required type="date" id="fechaNacimiento">

		<label for="correo">Correo:</label>
		<input value="<?php echo $cliente['clientes']['correo'] ?>" class="form-control" name="correo" required type="text" id="correo" placeholder="ejemplo@ejemplo.com">

		<label for="ciudad">Ciudad:</label>
		<input value="<?php echo $cliente['clientes']['ciudad'] ?>" class="form-control" name="ciudad" required type="text" id="ciudad" placeholder="Ciudad">
		<br><br><input class="btn btn-info" type="submit" value="Guardar">
		<a class="btn btn-warning" href="index.php?c=Clientes">Cancelar</a>
	</form>
</div>
