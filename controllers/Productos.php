<?php
	
	class ProductosController {
		
		// Constructor
		public function __construct() {
			require_once "models/ProductosModel.php";
		}

		// Metodos		
		public function index() {
		
			$productosModel = new Productos_Model();
			$productos["Titulo"] = "Productos";
			$productos["Productos"] = $productosModel -> getProductos();

			require_once "views/productos/productos.php";
		}

		public function nuevoProducto() {
            
            $productos["Titulo"] = "Producto Nuevo";

            require_once "views/productos/productos_nuevo.php";
        }

		public function guardarProducto() {

			if(!isset($_POST["codigo"]) || !isset($_POST["descripcion"]) || !isset($_POST["precioVenta"]) || !isset($_POST["precioCompra"]) || !isset($_POST["existencia"])) exit();
			
			$codigo = $_POST["codigo"];
            $descripcion = $_POST["descripcion"];
            $precioVenta = $_POST["precioVenta"];
            $precioCompra = $_POST["precioCompra"];
            $existencia = $_POST["existencia"];

			$producto = new Productos_Model;
            $producto->nuevoProducto($codigo, $descripcion, $precioVenta, $precioCompra, $existencia);
        }

		public function modificarProducto($id) {

			$productos = new Productos_Model();
            $producto["productos"] = $productos -> getProducto($id);

            require_once "views/productos/productos_modificar.php";
        }

		public function guardarProductoModificado() {

			if(!isset($_POST["codigo"]) || !isset($_POST["descripcion"]) || !isset($_POST["precioCompra"]) || !isset($_POST["precioVenta"]) || !isset($_POST["existencia"]) || 	!isset($_POST["id"])) exit();
			
			$id = $_POST["id"];
			$codigo = $_POST["codigo"];
			$descripcion = $_POST["descripcion"];
			$precioCompra = $_POST["precioCompra"];
			$precioVenta = $_POST["precioVenta"];
			$existencia = $_POST["existencia"];

			$producto = new Productos_Model;
			$producto->modificarProducto($codigo, $descripcion, $precioCompra, $precioVenta, $existencia, $id);
        }

		public function eliminarProducto($id) {

			if(!isset($_GET["id"])) exit();

			$id = $_GET["id"];

            $producto = new Productos_Model;
			$producto->eliminarProducto($id);
        }

		public function agregarProductoCarrito() {

			if (!isset($_POST["codigo"])) {
				return;
			}
			
			$codigo = $_POST["codigo"];

			$productoModel = new Productos_Model;
			$productoModel -> agregarProductoCarrito($codigo);
			
			require_once "views/ventas/ventas_vender.php";
		}

		public function seleccionarProductoCarrito() {

			if (!isset($_GET["id"])) {
				return;
			}
			
			$codigo = $_GET["id"];

			$productoModel = new Productos_Model;
			$productoModel -> agregarProductoCarrito($codigo);
			
			require_once "views/ventas/ventas_vender.php";
		}

		public function eliminarProductoCarrito() {

			if(!isset($_GET["indice"])) return;

			$indice = $_GET["indice"];

			$productoModel = new Productos_Model;
			$productoModel -> eliminarProductoCarrito($indice);
			
			require_once "views/ventas/ventas_vender.php";
		}

		public function modificarCantidadProductoCarrito() {
			if (!isset($_POST["cantidad"])) {
				exit("No hay cantidad");
			}
			if (!isset($_POST["indice"])) {
				exit("No hay índice");
			}

			$cantidad = floatval($_POST["cantidad"]);
			$indice = intval($_POST["indice"]);

			$productoModel = new Productos_Model;
			$productoModel -> modificarCantidadProductoCarrito($cantidad, $indice);

			require_once "views/ventas/ventas_vender.php";
		}
	}
?>