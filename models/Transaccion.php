<?php


class Transaccion{


private $archivo;



public function __construct(){

$this->archivo="../database/transacciones.json";

}




private function leer(){


if(!file_exists($this->archivo)){

return [];

}


return json_decode(
file_get_contents($this->archivo),
true
);


}




private function guardar($datos){


file_put_contents(

$this->archivo,

json_encode(
$datos,
JSON_PRETTY_PRINT
)

);


}




// Registrar movimiento


public function registrar(

$tipo,
$valor,
$origen,
$destino

){


$transacciones=$this->leer();



$nueva=[

"id"=>count($transacciones)+1,

"tipo"=>$tipo,

"valor"=>$valor,

"cuenta_origen"=>$origen,

"cuenta_destino"=>$destino,

"fecha"=>date("Y-m-d H:i:s")

];



$transacciones[]=$nueva;


$this->guardar($transacciones);


}


}


?>