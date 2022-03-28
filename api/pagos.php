<?php
require_once 'Models/Pago.php';
require_once 'bootstrap/init.php';

switch($_SERVER['REQUEST_METHOD']) {
    case 'GET':     
        break;

    case 'POST':
        $contenidoPost = file_get_contents('php://input');
        $postData = json_decode($contenidoPost, true);

        $pago = new Pago;
        $exito = $pago->pagoCrear($postData);

        if($exito) {
            echo json_encode([
                'success' => true
            ]);
        } else {
            echo json_encode([
                'success' => false
            ]);
        }
        break;

    case 'PUT':
       

        break;

    case 'PATCH':
        break;

    
    default:
        die('No existe la acción que estás buscando >:(');
}