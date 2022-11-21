<?php

    class Informes_Model {
        // Atributos
        private $db;
        private $informes;

        // Constructor
        public function __construct() {
            $this->db = Conectar::conexion(); //Clase conectar (database.php) junto con su metodo conexion()
            $this->informesClientes = array();
            $this->productos = array();
        }

        // Metodos
        public function informeClientes() {

            $sql = "SELECT c.id AS ID, CONCAT(c.id, ' - ', c.nombres, ' ',c.apellidos) as Cliente, SUM(pv.cantidad) As Cantidad FROM ventas v JOIN clientes c ON v.id_cliente = c.id JOIN productos_vendidos pv ON v.id = pv.id_venta JOIN productos p ON pv.id_producto = p.id GROUP BY Cliente ORDER BY Cantidad DESC LIMIT 2;";
            $resultado = $this-> db -> query($sql);
            while($row = $resultado -> fetch_assoc()) {
                $this-> informesClientes[] = $row; //asignacion de cada resultado al array
            }

            foreach ($this->informesClientes as $cliente) {
                $ID = $cliente["ID"];
                $sql = "SELECT c.id AS CodCliente, CONCAT(p.id, ' - ', p.descripcion) AS Producto, SUM(pv.cantidad) As Cantidad FROM ventas v JOIN clientes c ON v.id_cliente = c.id JOIN productos_vendidos pv ON v.id = pv.id_venta JOIN productos p ON pv.id_producto = p.id WHERE c.id = '$ID' GROUP BY Producto ORDER BY Cantidad DESC";
                $resultado = $this-> db -> query($sql);
                while($row = $resultado -> fetch_assoc()) {
                    $this-> informesClientesProductos[] = $row; //asignacion de cada resultado al array
                }   
            }
            return [$this->informesClientes, $this->informesClientesProductos];
        }

        public function informeProductos() {

            $sql = "SELECT p.id AS CodProducto, p.descripcion as Producto , SUM(pv.cantidad) as Cantidad FROM productos_vendidos pv JOIN productos p ON pv.id_producto = p.id GROUP BY CodProducto ORDER BY Cantidad DESC LIMIT 2;";
            $resultado = $this-> db -> query($sql);
            while($row = $resultado -> fetch_assoc()) {
                $this-> informesProductos[] = $row; //asignacion de cada resultado al array
            }
            return $this->informesProductos;
        }

        public function informeCiudades() {

            $sql = "SELECT c.ciudad as Ciudad FROM clientes c JOIN ventas v ON c.id = v.id_cliente GROUP BY Ciudad;";
            $resultado = $this-> db -> query($sql);
            while($row = $resultado -> fetch_assoc()) {
                $this-> informesCiudades[] = $row; //asignacion de cada resultado al array
            }

            foreach ($this->informesCiudades as $ciudad) {
                $ciudadQuery = $ciudad["Ciudad"];
                $sql = "SELECT c.ciudad as Ciudad, CONCAT(c.id, ' - ', c.nombres, ' ',c.apellidos) as Cliente, COUNT(*) AS Compras FROM clientes c JOIN ventas v ON c.id = v.id_cliente WHERE Ciudad = '$ciudadQuery' GROUP BY Ciudad, Cliente ORDER BY Compras DESC LIMIT 1;";
                $resultado = $this-> db -> query($sql);
                while($row = $resultado -> fetch_assoc()) {
                    $this-> informesCiudadesCantidad[] = $row; //asignacion de cada resultado al array
                }   
            }
            return $this->informesCiudadesCantidad;
        }

    }

?>