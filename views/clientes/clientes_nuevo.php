<div class="col-xs-12">
	<h1><?php echo $clientes["Titulo"] ?></h1>
	<form method="post" action="index.php?c=Clientes&a=guardarCliente">
		<label for="nombres">Nombres:</label>
		<input class="form-control" name="nombres" required type="text" id="nombres" placeholder="Escriba los nombres del cliente">

		<label for="apellidos">Apellidos:</label>
		<input required type="text" id="apellidos" name="apellidos" cols="30" rows="5" class="form-control" placeholder="Escriba los apellidos del cliente"></input>

		<label for="fechaNacimiento">Fecha de nacimiento:</label>
		<input class="form-control" name="fechaNacimiento" required type="date" id="fechaNacimiento">

		<label for="correo">Correo electronico:</label>
		<input class="form-control" name="correo" required type="email" id="correo" placeholder="ejemplo@ejemplo.com">

		<label for="ciudad">Ciudad:</label>
		<input class="form-control" name="ciudad" required type="text" id="ciudad" placeholder="Ciudad de residencia">
		<br><br><input class="btn btn-info" type="submit" value="Guardar">
		<a href="index.php?c=Clientes" class="btn btn-danger">Regresar</a>
	</form>
</div>