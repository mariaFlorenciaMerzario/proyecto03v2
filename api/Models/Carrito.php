<?php

 $vacio='';
class Carrito
{
    public $carrito_id;
    public $usuario_id;
    public $producto_nombre;
    public $precio;
    public $cantidad;
   
    function carritoCrear($data)
    {
       
        $db = mysqli_connect('localhost', 'root', '', 'coder');
        mysqli_set_charset($db, 'utf8mb4');
          
        foreach ($data as $index => $objeto)
            { 
              if (isset($objeto['email'])) {
                  $email = $objeto['email'];
              };
            };    

        foreach ($data as $index => $objeto)
            {
                
                $producto_nombre =$objeto['nombre_storage']; 
                $precio =$objeto['precio_storage'];  
                $cantidad =$objeto['cantidad_storage'];  
                
                $query = "INSERT INTO carrito (email, producto_nombre, precio, cantidad)
                VALUES ('$email', '$producto_nombre', '$precio', '$cantidad')";
                   $exito = mysqli_query($db, $query);           
             };    
            //comentario
             if(!$exito) {
                 return false;
            }else{
                 return true;
             }
    }
    /**
     * @param mixed $usuario_id
     */
    public function setUsuario_id($usuario_id)
    {
        $this->usuario_id = $usuario_id;
    }

    /**
     * @return mixed
     */
    public function getUsuario_id()
    {
        return $this->usuario_id;
    }


        /**
     * @param mixed $producto_id
     */
    public function setproducto_id($producto_id)
    {
        $this->producto_id = $producto_id;
    }


    /**
     * @return mixed
     */
    public function getproducto_id()
    {
        return $this->producto_id;
    }



            /**
     * @param mixed $precio
     */
    public function setprecio($precio)
    {
        $this->precio = $precio;
    }


    /**
     * @return mixed
     */
    public function getprecio()
    {
        return $this->precio;
    }


             /**
     * @param mixed $precio
     */
    public function setcantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }


    /**
     * @return mixed
     */
    public function getemail()
    {
        return $this->email;
    }

              /**
     * @param mixed $precio
     */
    public function setemail($email)
    {
        $this->email = $email;
    }


}
  

   