<?php

class Cuenta {


    private $archivo;


    public function __construct(){

        $this->archivo = "../database/cuenta.json";

    }



    // Leer cuentas

    private function leer(){

        if(!file_exists($this->archivo)){
            return [];
        }

        $datos = file_get_contents($this->archivo);

        return json_decode($datos,true);

    }



    // Guardar cuentas

    private function guardar($datos){

        file_put_contents(
            $this->archivo,
            json_encode($datos,JSON_PRETTY_PRINT)
        );

    }



    // Crear cuenta

    public function crearCuenta(
        $numero,
        $tipo,
        $saldo,
        $cliente
    ){

        $cuentas=$this->leer();


        $nuevaCuenta=[

            "id"=>count($cuentas)+1,
            "numero_cuenta"=>$numero,
            "tipo"=>$tipo,
            "saldo"=>$saldo,
            "id_cliente"=>$cliente

        ];


        $cuentas[]=$nuevaCuenta;


        $this->guardar($cuentas);


        return "Cuenta creada correctamente";

    }




    // Buscar cuenta

    public function buscarCuenta($numero){


        $cuentas=$this->leer();


        foreach($cuentas as $cuenta){

            if($cuenta["numero_cuenta"]==$numero){

                return $cuenta;

            }

        }


        return null;

    }




    // Actualizar saldo

    public function actualizarSaldo(
        $numero,
        $nuevoSaldo
    ){


        $cuentas=$this->leer();


        foreach($cuentas as &$cuenta){


            if($cuenta["numero_cuenta"]==$numero){


                $cuenta["saldo"]=$nuevoSaldo;


            }


        }


        $this->guardar($cuentas);


    }




}

?>