<?php
	
	class ClientesController {
		
		// Constructor
		public function __construct() {
			require_once "models/ClientesModel.php";
		}

		// Metodos		
		public function index() {
		
			$clientesModel = new Clientes_Model();
			$clientes["Titulo"] = "Clientes";
			$clientes["Clientes"] = $clientesModel -> getClientes();

			require_once "views/clientes/clientes.php";
		}

		public function nuevoCliente() {
            
            $clientes["Titulo"] = "Cliente Nuevo";

            require_once "views/clientes/clientes_nuevo.php";
        }

		public function guardarCliente() {

			if(!isset($_POST["nombres"]) || !isset($_POST["apellidos"]) || !isset($_POST["fechaNacimiento"]) || !isset($_POST["correo"]) || !isset($_POST["ciudad"])) exit();
			
			$nombres = $_POST["nombres"];
			$apellidos = $_POST["apellidos"];
			$fechaNacimiento = $_POST["fechaNacimiento"];
			$correo = $_POST["correo"];
			$ciudad = $_POST["ciudad"];

			$cliente = new Clientes_Model;
			$cliente -> nuevoCliente($nombres, $apellidos, $fechaNacimiento, $correo, $ciudad);
        }

		public function modificarCliente($id) {

			$clientes = new Clientes_Model();
            $cliente["clientes"] = $clientes -> getCliente($id);

            require_once "views/clientes/clientes_modificar.php";
        }

		public function guardarClienteModificado() {

			if(!isset($_POST["id"]) || !isset($_POST["nombres"]) || !isset($_POST["apellidos"]) || !isset($_POST["fechaNacimiento"]) || !isset($_POST["correo"]) || !isset($_POST["ciudad"])) exit();
			
			$id = $_POST["id"];
			$nombres = $_POST["nombres"];
			$apellidos = $_POST["apellidos"];
			$fechaNacimiento = $_POST["fechaNacimiento"];
			$correo = $_POST["correo"];
			$ciudad = $_POST["ciudad"];

			$cliente = new Clientes_Model;
			$cliente -> modificarCliente($nombres, $apellidos, $fechaNacimiento, $correo, $ciudad, $id);
        }

		public function eliminarCliente($id) {

			if(!isset($_GET["id"])) exit();

			$id = $_GET["id"];

            $cliente = new Clientes_Model();
            $cliente -> eliminarCliente($id);
        }

		public function seleccionarCliente() {

			if (!isset($_GET["id"])) {
				return;
			}

			$idCliente = $_GET["id"];

            $clienteModel = new Clientes_Model();
			$clienteModel -> seleccionarCliente($idCliente);

			require_once "views/ventas/ventas_vender.php";
        }

		public function buscarCliente() {

			if (!isset($_POST["idCliente"])) {
				return;
			}

			$idCliente = $_POST["idCliente"];

            $clienteModel = new Clientes_Model();
			$clienteModel -> seleccionarCliente($idCliente);

			require_once "views/ventas/ventas_vender.php";
        }
	}
?>