<?php

header('Content-Type: application/json; charset=UTF-8');
                                     
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: VAL, GET, POST, PUT, PATCH, DELETE, OPTIONS');
header('Access-Control-Allow-Credentials: true');

header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Origin: http://localhost:8080');


$db = mysqli_connect('localhost', 'root', '', 'coder');
mysqli_set_charset($db, 'utf8mb4');