<?php

    class Productos_Model {
        // Atributos
        private $db;
        private $productos;

        // Constructor
        public function __construct () {
            $this->db = Conectar::conexion(); //Clase conectar (database.php) junto con su metodo conexion()
            $this->productos = array();
        }

        // Metodos
        public function nuevoProducto ($codigo, $descripcion, $precioVenta, $precioCompra, $existencia) {

            include_once "config/base_de_datos.php";

            $sentencia = $base_de_datos->prepare("INSERT INTO productos(codigo, descripcion, precioVenta, precioCompra, existencia) VALUES (?, ?, ?, ?, ?);");
            $resultado = $sentencia->execute([$codigo, $descripcion, $precioVenta, $precioCompra, $existencia]);

            if($resultado === TRUE) {
                header("Location: ./index.php?c=Productos");
                exit;
            }
            else echo "Algo salió mal. Por favor verifica que la tabla exista";
        }

        public function modificarProducto ($codigo, $descripcion, $precioCompra, $precioVenta, $existencia, $id) {

            include_once "config/base_de_datos.php";

            $sentencia = $base_de_datos->prepare("UPDATE productos SET codigo = ?, descripcion = ?, precioCompra = ?, precioVenta = ?, existencia = ? WHERE id = ?;");
            $resultado = $sentencia->execute([$codigo, $descripcion, $precioCompra, $precioVenta, $existencia, $id]);

            if($resultado === TRUE){
                header("Location: ./index.php?c=Productos");
                exit;
            }
            else echo "Algo salió mal. Por favor verifica que la tabla exista, así como el ID del producto";
        }

        public function eliminarProducto ($id) {

            include_once "config/base_de_datos.php";

            $sentencia = $base_de_datos->prepare("DELETE FROM productos WHERE id = ?;");
            $resultado = $sentencia->execute([$id]);

            if($resultado === TRUE){
                header("Location: ./index.php?c=Productos");
                exit;
            }
            else echo "Algo salió mal";
        }

        public function getProductos () {

            $sql = "SELECT * FROM productos;";
            $resultado = $this-> db -> query($sql);

            while($row = $resultado -> fetch_assoc()) {
                $this-> productos[] = $row; //asignacion de cada resultado al array
            }
            return $this->productos;
        }

        public function getProducto($id){

            $sql = "SELECT * FROM productos WHERE id='$id' LIMIT 1";
            $resultado = $this-> db -> query($sql);
            $producto = $resultado -> fetch_assoc();
            
            return $producto;
        }

        public function getProductosCarrito () {

            $sql = "SELECT * FROM productos WHERE existencia > 0;";
            $resultado = $this-> db -> query($sql);

            while($row = $resultado -> fetch_assoc()) {
                $this-> productos[] = $row; //asignacion de cada resultado al array
            }
            return $this->productos;
        }

        public function agregarProductoCarrito($codigo) {

            include_once "config/base_de_datos.php";

            $sentencia = $base_de_datos->prepare("SELECT * FROM productos WHERE codigo = ? LIMIT 1;");
            $sentencia->execute([$codigo]);
            $producto = $sentencia->fetch(PDO::FETCH_OBJ);

            # Si no existe, salimos y lo indicamos
            if (!$producto) {
                header("Location: ./index.php?c=Ventas&a=vender&status=4#codigo");
                exit;
            }

            # Si no hay existencia...
            if ($producto->existencia < 1) {
                header("Location: ./index.php?c=Ventas&a=vender&status=5#codigo");
                exit;
            }

            session_start();

            # Buscar producto dentro del cartito
            $indice = false;
            for ($i = 0; $i < count($_SESSION["carrito"]); $i++) {
                if ($_SESSION["carrito"][$i]->codigo === $codigo) {
                    $indice = $i;
                    break;
                }
            }

            # Si no existe, lo agregamos como nuevo
            if ($indice === false) {
                $producto->cantidad = 1;
                $producto->total = $producto->precioVenta;
                array_push($_SESSION["carrito"], $producto);
            } else {
                # Si ya existe, se agrega la cantidad
                # Pero espera, tal vez ya no haya
                $cantidadExistente = $_SESSION["carrito"][$indice]->cantidad;
                # si al sumarle uno supera lo que existe, no se agrega
                if ($cantidadExistente + 1 > $producto->existencia) {
                    header("Location: ./index.php?c=Ventas&a=vender&status=5#codigo");
                    exit;
                }
                $_SESSION["carrito"][$indice]->cantidad++;
                $_SESSION["carrito"][$indice]->total = $_SESSION["carrito"][$indice]->cantidad * $_SESSION["carrito"][$indice]->precioVenta;
            }
            
            header("Location: ./index.php?c=Ventas&a=vender#codigo");
        }

        public function eliminarProductoCarrito($indice) {

            session_start();
            array_splice($_SESSION["carrito"], $indice, 1);
            header("Location: ./index.php?c=Ventas&a=vender&status=3#codigo");
        }

        public function modificarCantidadProductoCarrito($cantidad, $indice) {

            session_start();

            if ($cantidad > $_SESSION["carrito"][$indice]->existencia) {
                header("Location: ./index.php?c=Ventas&a=vender&status=5#codigo");
                exit;
            }
            
            $_SESSION["carrito"][$indice]->cantidad = $cantidad;
            $_SESSION["carrito"][$indice]->total = $_SESSION["carrito"][$indice]->cantidad * $_SESSION["carrito"][$indice]->precioVenta;
            header("Location: ./index.php?c=Ventas&a=vender#codigo");
        }
    }

?>