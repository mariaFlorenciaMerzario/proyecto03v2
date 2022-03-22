<?php
require_once 'Models/Producto.php';
require_once 'bootstrap/init.php';


switch($_SERVER['REQUEST_METHOD']) {
    case 'GET':
    
            $producto = new Producto;
            $producto = $producto->productosTodos($db);
            echo json_encode([
                'data' => $producto
            ]);
        
        break;

    default:
        die('No existe la acción que estás buscando >:(');
}