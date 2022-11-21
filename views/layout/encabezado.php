<?php
/*
	Pequeño, muy pequeño sistema de ventas en PHP con MySQL

	@author parzibyte (modificado por Juansis99)

	No olvides visitar parzibyte.me/blog para más cosas como esta
*/
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Ventas</title>
	
	<link rel="stylesheet" href="./css/fontawesome-all.min.css">
	<link rel="stylesheet" href="./css/2.css">
	<link rel="stylesheet" href="./css/estilo.css">
	<link rel="stylesheet" href="./css/juansis99CSS.css">
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">POS</a>
			</div>
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li><a href="index.php?c=Clientes">Clientes</a></li>
					<li><a href="index.php?c=Informes">Informes</a></li>
					<li><a href="index.php?c=Productos">Productos</a></li>
					<li><a href="index.php?c=Ventas&a=vender">Vender</a></li>
					<li><a href="index.php?c=Ventas">Ventas</a></li>
					<li><a href="index.php?c=Referencias">Referencia</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container">
		<div class="row">