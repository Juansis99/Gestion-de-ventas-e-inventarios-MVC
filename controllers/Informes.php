<?php
	
	class InformesController {

		// Constructor		
		public function __construct() {
			require_once "models/InformesModel.php";
		}
		
		// Metodos
		public function index() {
			require_once "views/informes/informes.php";	
		}

        public function informeClientes() {

            $informes = new Informes_Model();
			[$informesClientes["informesClientes"], $informesClientesProductos["informesClientesProductos"]] = $informes -> informeClientes();

			require_once "views/informes/informes_clientes.php";
        }

		public function informeProductos() {

            $informes = new Informes_Model();
			$informesProductos["informesProductos"] = $informes -> informeProductos();

			require_once "views/informes/informes_productos.php";
        }

		public function informeCiudades() {

            $informes = new Informes_Model();
			$informesCiudadesCantidad["informesCiudadesCantidad"] = $informes -> informeCiudades();

			require_once "views/informes/informes_ciudades.php";
        }
	}
?>