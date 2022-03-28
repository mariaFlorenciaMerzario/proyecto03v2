<?php

class Pago
{
    public $pago_id;
    public $email;
    public $total;
    public $fecha;
   
    function pagoCrear($data)
    {
        $db = mysqli_connect('localhost', 'root', '', 'coder');
        mysqli_set_charset($db, 'utf8mb4');

        $email = mysqli_real_escape_string($db, $data['email']);
        $total = mysqli_real_escape_string($db, $data['total']);
        $fecha = date('Y-m-d H:i:s');
       
        // Armo el query.

        $query = "INSERT INTO pagos (fecha, email, total)
                VALUES ('$fecha', '$email', '$total')";
        
        $exito = mysqli_query($db, $query);
        
        $query_pago = "SELECT * FROM pagos where fecha = '$fecha 'and email = '$email'";

        $pago = mysqli_query($db, $query_pago);

        $pago_reg = mysqli_fetch_array($pago);
    
    
        // devuelve pago.email pago.pago_id pago.fecha
        return $pago_reg;
    }


    /**
     * @return mixed
     */
    public function getPago_id()
    {
        return $this->Pago_id;
    }

    /**
     * @param mixed $pago_id
     */
    public function setPago_id($pago_id)
    {
        $this->pago_id = $pago_id;
    }

     /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->Email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

      /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->Total;
    }

    /**
     * @param mixed $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }


       /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->Fecha;
    }

    /**
     * @param mixed $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    
}