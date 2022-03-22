<?php
require_once 'bootstrap/init.php';
/*
require_once 'Models/Usuario.php';
require_once 'bootstrap/init.php';
require_once 'funciones/auth.php';

header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Origin: http://localhost:8081');
header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS');

header('Content-Type: application/json; charset=UTF-8');

*/

$json = file_get_contents('php://input');
$postData = json_decode($json, true);

$email = isset($postData['email']) ? $email = $postData['email'] : 0;
$password = isset($postData['password']) ? $password = $postData['password'] : 0;

$db = mysqli_connect('localhost', 'root', '', 'coder');
mysqli_set_charset($db, 'utf8mb4');

$query = "SELECT * FROM usuarios
           WHERE email = '$email'";

    $res = mysqli_query($db, $query);

    
    if(mysqli_num_rows($res) == 1) {
     
        // hago el fetch.
        $fila = mysqli_fetch_assoc($res);

            if($password == $fila['password']) {
            
                $_SESSION['usuario_id'] = $fila['usuario_id'];
                $_SESSION['nombre'] = $fila['nombre'];            
                $_SESSION['email'] = $fila['email'];
               
            
             echo json_encode([
              'success' => 'true',
              'error' => 'Los datos ingresados SON correctos.'
            ]);
            exit;
        }else{            
         
            echo json_encode([
                'success' => 'false',
                'error' => 'Los datos ingresados NO son correctos.'
              ]);
              exit;
        };
        
    }else{
        echo json_encode([
            'success' => 'false',
            'error' => 'Los datos ingresados NO NO NOson correctos.'
          ]);
          exit;
          //  'error' => 'Email incorrecto.
       /*   echo json_encode([
            'success' => 'false',
            'error' => 'Los datos ingresados no son correctos.'
        ]);*/

    }
    
