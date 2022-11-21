<?php

    class Clientes_Model {
        // Atributos
        private $db;
        private $clientes;

        // Constructor
        public function __construct () {
            $this->db = Conectar::conexion(); //Clase conectar (database.php) junto con su metodo conexion()
            $this->clientes = array();
        }

        // Metodos
        public function nuevoCliente ($nombres, $apellidos, $fechaNacimiento, $correo, $ciudad) {

            include_once "config/base_de_datos.php";
            
            $edad = $this->calcularEdad ($fechaNacimiento);
            $sentencia = $base_de_datos->prepare(NUEVO_CLIENTE);
            $resultado = $sentencia->execute([$nombres, $apellidos, $fechaNacimiento, $edad, $correo, $ciudad]);

            if($resultado === TRUE){
                header("Location: ./index.php?c=Clientes");
                exit;
            } else {
                echo "Algo salió mal. Por favor verifica que la tabla exista";
            }
        }

        public function calcularEdad ($fechaNacimiento) {

            $edad = (int)date("Y") - (int)explode("-", $fechaNacimiento)[0];
            if (((int)date("m")-(int)explode("-", $fechaNacimiento)[1]) <0 ) {
                $edad --;
            } else if (((int)date("m")-(int)explode("-", $fechaNacimiento)[1]) === 0 ) {
                if (((int)date("d") - (int)explode("-", $fechaNacimiento)[2]) < 0) {
                    $edad --;
                }
            }
            
            return $edad;
        }

        public function modificarCliente ($nombres, $apellidos, $fechaNacimiento, $correo, $ciudad, $id) {

            include_once "config/base_de_datos.php";

            $edad = $this->calcularEdad ($fechaNacimiento);
            $sentencia = $base_de_datos->prepare("UPDATE clientes SET nombres = ?, apellidos = ?, fecha_nacimiento = ?, edad = ?, correo = ?, ciudad = ? WHERE id = ?;");
            $resultado = $sentencia->execute([$nombres, $apellidos, $fechaNacimiento, $edad, $correo, $ciudad, $id]);

            if($resultado === TRUE){
                header("Location: ./index.php?c=Clientes");
                exit;
            }
            else echo "Algo salió mal. Por favor verifica que la tabla exista, así como el ID del producto";
        }

        public function eliminarCliente ($idCliente) {
            
            include_once "config/base_de_datos.php";

            $sentencia = $base_de_datos->prepare("DELETE FROM clientes WHERE id = ?;");
            $resultado = $sentencia->execute([$idCliente]);

            if($resultado === TRUE){
                header("Location: ./index.php?c=Clientes");
                exit;
            }
            else echo "Algo salió mal";
        }

        public function getClientes () {

            $sql = CONSULA_CLIENTES;
            $resultado = $this-> db -> query($sql);
            
            while($row = $resultado -> fetch_assoc()) {
                $this-> clientes[] = $row; //asignacion de cada resultado al array
            }
            return $this->clientes;
        }

        public function getCliente($id){

            $sql = "SELECT * FROM clientes WHERE id='$id' LIMIT 1";
            $resultado = $this-> db -> query($sql);
            $cliente = $resultado -> fetch_assoc();
            
            return $cliente;
        }

        public function seleccionarCliente($idCliente) {

            include_once "config/base_de_datos.php";
            
            $sentencia = $base_de_datos->prepare("SELECT * FROM clientes WHERE id = ?;");
            $sentencia->execute([$idCliente]);
            $cliente = $sentencia->fetch(PDO::FETCH_OBJ);

            if (!$cliente) {
                header("Location: ./index.php?c=Ventas&a=vender&status=6");
                exit;
            }
            
            session_start();
            $_SESSION["cliente"] = []; // Se deja un solo cliente siempre
            array_push($_SESSION["cliente"], $cliente);

            header("Location: ./index.php?c=Ventas&a=vender");
        }


    }

?>