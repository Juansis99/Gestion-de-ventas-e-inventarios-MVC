<?php

    // Conexion BD
    define("DB_HOST", "localhost");
    define("DB_USERNAME", "root");
    define("DB_PASSWORD", "");
    define("DB_NAME", "ventas");

    // Controlador principal (Juansis99)
    define("CONTROLADOR_PRINCIPAL", "Referencias");
    define("ACCION_PRINCIPAL", "index");

    // Queries (Juansis99)
    define("CONSULA_CLIENTES", "SELECT * FROM clientes;");
    define("NUEVO_CLIENTE", "INSERT INTO clientes (nombres, apellidos, fecha_nacimiento, edad, correo, ciudad) VALUES (?, ?, ?, ?, ?, ?);")

?>