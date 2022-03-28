<?php

class Usuario
{
    public $usuario_id;
    public $nombre;
    public $email;
    public $password;
   
    function usuariosCrear($data)
    {
        $json = file_get_contents('php://input');
        $postData = json_decode($json, true);

        $db = mysqli_connect('localhost', 'root', '', 'coder');
        mysqli_set_charset($db, 'utf8mb4');
        
        $email = isset($postData['email']) ? $email = $postData['email'] : 0;

        
        $query = "SELECT * FROM usuarios
        WHERE email = '$email'";
            $res = mysqli_query($db, $query); 
            
            if(mysqli_num_rows($res) == 0){
                
                $nombre = mysqli_real_escape_string($db, $data['nombre']);
                $email = mysqli_real_escape_string($db, $data['email']);
                $password = mysqli_real_escape_string($db, $data['password']);
            
                // Armamos el query.
                $query = "INSERT INTO usuarios (email, password, nombre)
                        VALUES ('$email', '$password', '$nombre')";
                $exito = mysqli_query($db, $query);
            
                return $exito;
            }else{
                return false;
            }
            var_dump(mysqli_num_rows($res));
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

 
    /**
     * @param mixed $id_usuario
     */
    public function Id($usuario_id)
    {
        $this->id_usuario = $usuario_id;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }


    /**
     * @return mixed
     */
    public function getUsuario_id()
    {
        return $this->usuario_id;
    }

  

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }


    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }



    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param mixed $imagen1
     */
   

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

}