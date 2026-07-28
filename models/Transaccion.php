<?php

require_once __DIR__ . '/../config/JsonManager.php';

class Transaccion
{

    private string $archivo = __DIR__ . '/../DB/transacciones.json';

    // Obtener todas las transacciones
    public function obtenerTodos(): array
    {

        return JsonManager::leer($this->archivo);

    }

    // Buscar una transacción por ID
    public function buscarPorId(int $id): ?array
    {

        $transacciones = $this->obtenerTodos();

        foreach ($transacciones as $transaccion) {

            if ($transaccion["id"] == $id) {

                return $transaccion;

            }

        }

        return null;

    }

    // Registrar una nueva transacción
    public function crear(array $datos): array
    {

        if ($datos["valor"] <= 0) {

            throw new Exception("El valor debe ser mayor que cero.");

        }

        $transacciones = $this->obtenerTodos();

        $nueva = [

            "id" => JsonManager::siguienteId($transacciones),

            "tipo" => $datos["tipo"],

            "valor" => (float)$datos["valor"],

            "cuenta_origen" => $datos["cuenta_origen"],

            "cuenta_destino" => $datos["cuenta_destino"],

            "fecha" => date("Y-m-d H:i:s"),

            "estado" => "Completada"

        ];

        $transacciones[] = $nueva;

        JsonManager::guardar(

            $this->archivo,

            $transacciones

        );

        return $nueva;

    }

    // Historial de una cuenta
    public function historialCuenta(string $numeroCuenta): array
    {

        $resultado = [];

        foreach ($this->obtenerTodos() as $transaccion) {

            if (

                $transaccion["cuenta_origen"] == $numeroCuenta ||

                $transaccion["cuenta_destino"] == $numeroCuenta

            ) {

                $resultado[] = $transaccion;

            }

        }

        return $resultado;

    }

    // Filtrar por tipo
    public function filtrarTipo(string $tipo): array
    {

        $resultado = [];

        foreach ($this->obtenerTodos() as $transaccion) {

            if ($transaccion["tipo"] == $tipo) {

                $resultado[] = $transaccion;

            }

        }

        return $resultado;

    }

    // Eliminar una transacción
    public function eliminar(int $id): bool
    {

        $transacciones = $this->obtenerTodos();

        foreach ($transacciones as $indice => $transaccion) {

            if ($transaccion["id"] == $id) {

                unset($transacciones[$indice]);

                JsonManager::guardar(

                    $this->archivo,

                    array_values($transacciones)

                );

                return true;

            }

        }

        return false;

    }

}