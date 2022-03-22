<?php

class Producto
{
    public $producto_id;
    public $nombre;
    public $descripcion;
    public $precio;
    public $imagen;
    public $categoria;
   
   
    function productosTodos($db)
    {
        $query = "SELECT * FROM productos";

        $res = mysqli_query($db, $query);

        $salida = [];

        while ($fila = mysqli_fetch_assoc($res)) {
            $salida[] = $fila;
           
        }

        return $salida;
    }


    /**
     * @param mixed $Producto_id
     */
    public function setProducto_id($producto_id)
    {
        $this->producto_id = $producto_id;
    }

    /**
     * @return mixed
     */
    public function getProducto_id()
    {
        return $this->getProducto_id;
    }

 
    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

     /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }
  /**
     * @param mixed $precio
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    /**
     * @return mixed
     */
    public function getPrecio()
    {
        return $this->precio;
    }

     /**
     * @param mixed $categoria
     */
    public function seCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    /**
     * @return mixed
     */
    public function geCategoria()
    {
        return $this->categoria;
    }
    /**
     * @param mixed $imagen
     */
    public function setImgaen($imagen)
    {
        $this->imagen = $imagen;
    }

    /**
     * @return mixed
     */
    public function getImagen()
    {
        return $this->imagen;
    }

}