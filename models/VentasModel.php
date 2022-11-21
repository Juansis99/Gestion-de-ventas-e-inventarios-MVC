<?php

    class Ventas_Model {
        // Atributos
        private $db;
        private $ventas;

        // Constructor
        public function __construct () {
            $this->db = Conectar::conexion(); //Clase conectar (database.php) junto con su metodo conexion()
            $this->ventas = array();
        }

        // Metodos
        public function getVentas () {

            $sql = "SELECT * FROM ventas";
            $resultado = $this-> db -> query($sql);

            while($row = $resultado -> fetch_assoc()) {
                $this-> ventas[] = $row; //asignacion de cada resultado al array
            }

            $sql = "SELECT v.id AS IDV, CONCAT(p.id , ' - ', p.descripcion) AS Producto, pv.cantidad AS Cantidad FROM productos_vendidos pv JOIN ventas v ON v.id = pv.id_venta JOIN productos p ON pv.id_producto = p.id";
            $resultado = $this-> db -> query($sql);

            while($row = $resultado -> fetch_assoc()) {
                $this-> productosVendidos[] = $row; //asignacion de cada resultado al array
            }   

            return [$this->ventas, $this->productosVendidos];
        }

        public function getVentasCliente($idCliente) {

            $sql = "SELECT * FROM ventas WHERE id_cliente = $idCliente AND ventas.estado = 'Activa'";
            $resultado = $this-> db -> query($sql);

            while($row = $resultado -> fetch_assoc()) {
                $this-> ventas[] = $row; //asignacion de cada resultado al array
            }

            $sql = "SELECT pv.id_venta AS IDV, CONCAT(p.id, ' - ', p.descripcion) AS Producto, pv.cantidad AS Cantidad FROM productos_vendidos pv JOIN productos p ON p.id = pv.id_producto";
            $resultado = $this-> db -> query($sql);

            while($row = $resultado -> fetch_assoc()) {
                $this-> productos[] = $row; //asignacion de cada resultado al array
            }

            return [$this-> ventas, $this->productos];
        }

        public function finalizarSesion() {
            
            session_start();
            unset($_SESSION["carrito"]);
            $_SESSION["carrito"] = [];
            //Adicional Juansis99
            unset($_SESSION["cliente"]);
            $_SESSION["cliente"] = [];
            //Fin adicional Juansis99
        }

        public function cancelarVenta() {

            $this-> finalizarSesion();

            header("Location: ./index.php?c=Ventas&a=vender&status=2");
        }

        public function nuevaVenta ($total, $idCliente) {

            include_once "config/base_de_datos.php";

            $ahora = date("Y-m-d H:i:s");

            $sentencia = $base_de_datos->prepare("INSERT INTO ventas (id_cliente, fecha, total) VALUES (?, ?, ?);");
            $sentencia->execute([$idCliente, $ahora, $total]);
            
            $sentencia = $base_de_datos->prepare("SELECT id FROM ventas ORDER BY id DESC LIMIT 1;");
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_OBJ);

            $idVenta = $resultado === false ? 1 : $resultado->id;

            $base_de_datos->beginTransaction();

            $sentencia = $base_de_datos->prepare("INSERT INTO productos_vendidos(id_producto, id_venta, cantidad) VALUES (?, ?, ?);");
            $sentenciaExistencia = $base_de_datos->prepare("UPDATE productos SET existencia = existencia - ? WHERE id = ?;");

            foreach ($_SESSION["carrito"] as $producto) {

                $total += $producto->total;

                $sentencia->execute([$producto->id, $idVenta, $producto->cantidad]);
                $sentenciaExistencia->execute([$producto->cantidad, $producto->id]);
            }

            $base_de_datos->commit();

            header("Location: ./index.php?c=Ventas&a=vender");
        }

        public function terminarVenta() {
            $this-> finalizarSesion();
            header("Location: ./index.php?c=Ventas&a=vender&status=1");

        }

        public function anularVenta($idVenta) {

            include_once "config/base_de_datos.php";

            //Inicio Modificacion Juansis99
            $sentencia = $base_de_datos->prepare("UPDATE ventas SET estado = 'Anulada' WHERE id = ?;");
            //Fin modificacion Juansis99
            $resultado = $sentencia->execute([$idVenta]);

            if($resultado === TRUE) {
                // Adiconal Juansis99
                // Obtener productos con el id de la venta anulada
                $sentencia = $base_de_datos->prepare("SELECT id_producto AS CodProd, cantidad FROM `productos_vendidos` WHERE id_venta = ?;");
                $resultado = $sentencia->execute([$idVenta]);

                if($resultado === FALSE) {
                    echo "Algo salió mal";
                    header("Location: ./index.php?c=Ventas");
                    exit;
                }

                $productos = $sentencia->fetchAll(PDO::FETCH_OBJ);
                
                foreach ($productos as $producto) {

                    // Definit el nuevo stock del producto de la venta anulada
                    $sentencia = $base_de_datos->prepare("SELECT existencia FROM `productos` WHERE id = ?;");
                    $resultado = $sentencia->execute([$producto->CodProd]);

                    if($resultado === FALSE) {
                        echo "Algo salió mal";
                        header("Location: ./index.php?c=Ventas");
                        exit;
                    }

                    $stock = $sentencia->fetch(PDO::FETCH_OBJ);
                    $stockNuevo = $stock->existencia + $producto->cantidad;

                    // Actualizar el stock en BD
                    $sentencia = $base_de_datos->prepare("UPDATE productos SET existencia = ? WHERE id = ?;");
                    $resultado = $sentencia->execute([$stockNuevo, $producto->CodProd]);

                    if($resultado === FALSE) {
                        echo "Algo salió mal";
                        header("Location: ./index.php?c=Ventas");
                        exit;
                    }		
                }
                // Fin adicional Juansis99
                header("Location: ./index.php?c=Ventas");
                exit;
            }
            
            else echo "Algo salió mal";
        }

        public function imprimirTicket($id) {

            include_once "config/base_de_datos.php";

            $sentencia = $base_de_datos->prepare("SELECT v.id, v.fecha, v.total, CONCAT('ID - ', v.id_cliente) AS idCli, CONCAT('Cliente: ', c.nombres, ' ', c.apellidos) AS Cliente, c.ciudad AS Ciudad FROM ventas v JOIN clientes c ON v.id_cliente = c.id WHERE v.id = ?");
            $sentencia->execute([$id]);
            $venta = $sentencia->fetchObject();


            if (!$venta) {
                exit("No existe venta con el id proporcionado");
            }

            $sentenciaProductos = $base_de_datos->prepare("SELECT p.codigo, p.descripcion,p.precioVenta, pv.cantidad FROM productos p INNER JOIN productos_vendidos pv ON p.id = pv.id_producto WHERE pv.id_venta = ?");
            $sentenciaProductos->execute([$id]);
            $productos = $sentenciaProductos->fetchAll();
            
            if (!$productos) {
                exit("No hay productos");
            }

            return [$productos, $venta];
        }
    }
?>