<?php

    if((!isset($_GET['c']) || ($_GET['c'] <> 'Ventas')) || (!isset($_GET['a']) || ($_GET['a'] <> 'imprimirTicket'))) {
        require_once 'views/layout/encabezado.php';
    }    
    require_once 'config/config.php';
    require_once 'core/routes.php';
    require_once 'config/database.php';
    require_once 'controllers/Productos.php';
    require_once 'controllers/Clientes.php';
    
    if(isset($_GET['c'])) {
        $controlador = cargarControlador($_GET['c']);
        if(isset($_GET['a'])) {
            if(isset($_GET['id'])){
                cargarAccion($controlador, $_GET['a'], $_GET['id']); 
            } else {
                cargarAccion($controlador, $_GET['a']); 
            }
        } else { 
            cargarAccion($controlador, ACCION_PRINCIPAL);
        }
    } else {
        $controlador = cargarControlador(CONTROLADOR_PRINCIPAL);
        cargarAccion($controlador, ACCION_PRINCIPAL);  
    }

    if((!isset($_GET['c']) || ($_GET['c'] <> 'Ventas')) || (!isset($_GET['a']) || ($_GET['a'] <> 'imprimirTicket'))) {
        require_once 'views/layout/pie.php';
    }
    
?>