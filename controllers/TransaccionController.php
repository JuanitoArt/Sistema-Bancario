<?php


require_once "../models/Cuenta.php";
require_once "../models/Transaccion.php";



class TransaccionController{


private $cuenta;
private $transaccion;



public function __construct(){


$this->cuenta=new Cuenta();

$this->transaccion=new Transaccion();


}





// Depositar

public function depositar(
$numero,
$valor
){


$cuenta=$this->cuenta
->buscarCuenta($numero);



if(!$cuenta){

return "Cuenta no encontrada";

}



$nuevoSaldo=
$cuenta["saldo"]+$valor;



$this->cuenta
->actualizarSaldo(
$numero,
$nuevoSaldo
);



$this->transaccion
->registrar(
"Deposito",
$valor,
$numero,
null
);



return "Deposito exitoso";


}






// Retirar


public function retirar(
$numero,
$valor
){


$cuenta=$this->cuenta
->buscarCuenta($numero);



if(!$cuenta){

return "Cuenta no encontrada";

}



if($cuenta["saldo"]<$valor){

return "Saldo insuficiente";

}



$nuevoSaldo=
$cuenta["saldo"]-$valor;



$this->cuenta
->actualizarSaldo(
$numero,
$nuevoSaldo
);



$this->transaccion
->registrar(
"Retiro",
$valor,
$numero,
null
);



return "Retiro exitoso";


}






// Transferir


public function transferir(

$origen,

$destino,

$valor

){



$cuentaOrigen=
$this->cuenta
->buscarCuenta($origen);



$cuentaDestino=
$this->cuenta
->buscarCuenta($destino);




if(!$cuentaOrigen || !$cuentaDestino){

return "Cuenta no encontrada";

}




if($cuentaOrigen["saldo"]<$valor){

return "Saldo insuficiente";

}





$this->cuenta
->actualizarSaldo(

$origen,

$cuentaOrigen["saldo"]-$valor

);





$this->cuenta
->actualizarSaldo(

$destino,

$cuentaDestino["saldo"]+$valor

);





$this->transaccion
->registrar(

"Transferencia",

$valor,

$origen,

$destino

);



return "Transferencia realizada";


}



}

?>