<?php


require_once __DIR__ . '/../models/Cliente.php';
require_once __DIR__ . '/../models/Cuenta.php';



class ClienteController
{


    private Cliente $modelo;



    public function __construct()
    {

        $this->modelo = new Cliente();

    }





    public function registrar(array $datos): array
    {


        foreach(
            ["nombre","apellido","documento","telefono","correo"]
            as $campo
        ){


            if(empty($datos[$campo])){


                return [

                    "success"=>false,

                    "mensaje"=>"Todos los campos son obligatorios."

                ];


            }

        }




        if(!filter_var($datos["correo"], FILTER_VALIDATE_EMAIL)){


            return [

                "success"=>false,

                "mensaje"=>"Correo inválido."

            ];


        }




        if($this->modelo->existeDocumento($datos["documento"])){


            return [

                "success"=>false,

                "mensaje"=>"El documento ya está registrado."

            ];


        }




        if($this->modelo->existeCorreo($datos["correo"])){


            return [

                "success"=>false,

                "mensaje"=>"El correo ya está registrado."

            ];


        }




        $cliente = $this->modelo->crear($datos);




        return [

            "success"=>true,

            "mensaje"=>"Cliente creado correctamente.",

            "data"=>$cliente

        ];



    }






    public function listar(): array
    {

        return $this->modelo->obtenerTodos();

    }





    public function buscar($id)
    {

        return $this->modelo->buscarPorId($id);

    }





    public function actualizar($id, $datos): array
{

    $actualizado = $this->modelo->actualizar($id, $datos);


    return [

        "success" => $actualizado,

        "mensaje" => $actualizado
            ? "Cliente actualizado correctamente."
            : "Cliente no encontrado."

    ];

}





   public function eliminar($id)
{

    $cuentaModel = new Cuenta();

    $cuentas = $cuentaModel->obtenerTodos();

    foreach ($cuentas as $cuenta) {

        if ($cuenta["id_cliente"] == $id) {

            return [

                "success" => false,

                "mensaje" => "No se puede eliminar el cliente porque tiene cuentas asociadas."

            ];

        }

    }

    $eliminado = $this->modelo->eliminar($id);

    return [

        "success" => $eliminado,

        "mensaje" => $eliminado
            ? "Cliente eliminado correctamente."
            : "Cliente no encontrado."

    ];

}


}

?>