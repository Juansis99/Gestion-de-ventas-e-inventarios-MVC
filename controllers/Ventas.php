<?php
	
	class VentasController {

		// Constructor		
		public function __construct() {
			require_once "models/VentasModel.php";
			require_once "models/ClientesModel.php";
			require_once "models/ProductosModel.php";
		}
		
		// Metodos
		public function index() {

            $ventasModel = new Ventas_Model();
			[$ventas["ventas"], $productosVendidos["productos"]] = $ventasModel -> getVentas();

			require_once "views/ventas/ventas.php";	
		}

		public function vender() {

			session_start();

			if (!isset($_SESSION["carrito"])) $_SESSION["carrito"] = [];
			//Adicional Juansis99
			if (!isset($_SESSION["cliente"])) $_SESSION["cliente"] = [];
			//Fin adicional Juansis99

			$clientesModel = new Clientes_Model();
			$clientes["Clientes"] = $clientesModel -> getClientes();

			$productosModel = new Productos_Model();
			$productos["Productos"] = $productosModel -> getProductosCarrito();

			require_once "views/ventas/ventas_vender.php";	
		}

		public function ventasCliente() {

			if(!isset($_GET["id"])) exit();

			$id = $_GET["id"];

			$ventasModel = new Ventas_Model();
			[$ventas["ventas"], $productos["productos"]] = $ventasModel -> getVentasCliente($id);

			require_once "views/ventas/ventas_cliente.php";
		}

		public function cancelarVenta() {
			
			$ventasModel = new Ventas_Model();
			$ventasModel -> cancelarVenta();

		}

		public function terminarVenta() {

			if(!isset($_POST["total"]) || !isset($_POST["idCliente"])) exit;

			session_start();

			$total = $_POST["total"];
			$idCliente = $_POST["idCliente"];

			$ventasModel = new Ventas_Model();
			$ventasModel -> nuevaVenta($total, $idCliente);

			$ventasModel -> terminarVenta();
			
			require_once "views/ventas/ventas_vender.php";
		}

		public function anularVenta() {

			if(!isset($_GET["id"])) exit();

			$id = $_GET["id"];

            $venta = new Ventas_Model();
            $venta -> anularVenta($id);
        }

		public function imprimirTicket() {

			if (!isset($_GET["id"])) {
				exit("No hay id");
			}

			$id = $_GET["id"];

			$ventasModel = new Ventas_Model();
			[$productos["productos"], $venta] = $ventasModel -> imprimirTicket($id);

			require_once "views/ventas/ventas_ticket.php";
		}
	}
?>