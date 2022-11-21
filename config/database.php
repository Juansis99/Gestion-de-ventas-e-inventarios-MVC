<?php

    class Conectar {        
        public static function conexion() {
            require_once 'config/config.php';
            $conexion = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);        
            if ($conexion-> connect_errno) {
                printf("Conexion fallida: %s\n", $conexion->connect_errno);
                exit();
            };          
            return $conexion;
        }
    };

?>