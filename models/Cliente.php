<?php


require_once __DIR__ . '/../config/JsonManager.php';



class Cliente
{


    private string $archivo = __DIR__ . '/../DB/clientes.json';



    public function obtenerTodos(): array
    {

        return JsonManager::leer($this->archivo);

    }



    public function buscarPorId(int $id): ?array
    {


        $clientes = $this->obtenerTodos();


        foreach($clientes as $cliente){


            if($cliente["id"] == $id){

                return $cliente;

            }


        }


        return null;


    }



    public function existeDocumento($documento): bool
    {


        foreach($this->obtenerTodos() as $cliente){


            if($cliente["documento"] == $documento){

                return true;

            }


        }


        return false;


    }



    public function existeCorreo($correo): bool
    {


        foreach($this->obtenerTodos() as $cliente){


            if($cliente["correo"] == $correo){

                return true;

            }


        }


        return false;


    }



    public function crear(array $datos): array
    {


        $clientes = $this->obtenerTodos();



        $nuevoCliente = [

            "id" => JsonManager::siguienteId($clientes),

            "nombre" => $datos["nombre"],

            "apellido" => $datos["apellido"],

            "documento" => $datos["documento"],

            "telefono" => $datos["telefono"],

            "correo" => $datos["correo"],

            "fechaRegistro" => date("Y-m-d H:i:s"),

            "estado" => "Activo"

        ];



        $clientes[] = $nuevoCliente;



        JsonManager::guardar(
            $this->archivo,
            $clientes
        );



        return $nuevoCliente;


    }




    public function actualizar(int $id, array $datos): bool
    {


        $clientes = $this->obtenerTodos();



        foreach($clientes as &$cliente){



            if($cliente["id"] == $id){


                $cliente["nombre"] = $datos["nombre"];

                $cliente["apellido"] = $datos["apellido"];

                $cliente["documento"] = $datos["documento"];

                $cliente["telefono"] = $datos["telefono"];

                $cliente["correo"] = $datos["correo"];



                JsonManager::guardar(
                    $this->archivo,
                    $clientes
                );



                return true;


            }


        }



        return false;


    }





    public function eliminar(int $id): bool
    {


        $clientes = $this->obtenerTodos();



        foreach($clientes as $indice=>$cliente){



            if($cliente["id"] == $id){


                unset($clientes[$indice]);



                JsonManager::guardar(
                    $this->archivo,
                    array_values($clientes)
                );



                return true;


            }


        }


        return false;


    }



}

?>