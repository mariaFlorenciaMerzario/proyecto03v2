<?php



/**

 * @param string $token
 * @return bool|array
 */


/**

 *
 * @param mysqli $db
 * @param string $email
 * @param string $password
 * @return bool|array
 */
function authLogin($db, $email, $password) {
    $email = mysqli_real_escape_string($db, $email);
    $password = mysqli_real_escape_string($db, $password);


    $query = "SELECT * FROM usuarios
              WHERE email = $email";
    $res = mysqli_query($db, $query);

    if($res)
    {
        $fila = mysqli_fetch_assoc($res);
            if($password = $fila['password']) {
                return [
                    'usuario' => [
                        'id_usuario'=> $fila['id_usuario'],
                        'email'     => $fila['email'],
                        'nombre'    => $fila['nombre'],
                    ],

                ];
            }
    }
     return false;
    }

