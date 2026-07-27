<?php

require_once "../models/Cuenta.php";


class CuentaController{


private $cuenta;



public function __construct(){

    $this->cuenta = new Cuenta();

}



// Crear cuenta

public function crear(
    $numero,
    $tipo,
    $saldo,
    $cliente
){

    return $this->cuenta->crearCuenta(
        $numero,
        $tipo,
        $saldo,
        $cliente
    );

}



// Buscar cuenta

public function buscar($numero){

    return $this->cuenta->buscarCuenta($numero);

}



// Actualizar saldo

public function actualizarSaldo(
    $numero,
    $saldo
){

    return $this->cuenta->actualizarSaldo(
        $numero,
        $saldo
    );

}


}

?>