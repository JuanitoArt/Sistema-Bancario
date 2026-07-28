<?php

require_once __DIR__ . '/../config/JsonManager.php';

class Cuenta
{

    private string $archivo = __DIR__ . '/../DB/cuentas.json';

    // Obtener todas las cuentas
    public function obtenerTodos(): array
    {

        return JsonManager::leer($this->archivo);

    }

    // Buscar por ID
    public function buscarPorId(int $id): ?array
    {

        foreach ($this->obtenerTodos() as $cuenta) {

            if ($cuenta["id"] == $id) {

                return $cuenta;

            }

        }

        return null;

    }

    // Buscar por número de cuenta
    public function buscarPorNumero(string $numero): ?array
    {

        foreach ($this->obtenerTodos() as $cuenta) {

            if ($cuenta["numero_cuenta"] == $numero) {

                return $cuenta;

            }

        }

        return null;

    }

    // Crear cuenta
    public function crear(array $datos): array
    {

        if ($datos["saldo"] < 0) {

            throw new Exception("El saldo inicial no puede ser negativo.");

        }     

        $cuentas = $this->obtenerTodos();

        $nuevaCuenta = [

            "id" => JsonManager::siguienteId($cuentas),

            "numero_cuenta" => $this->generarNumeroCuenta(),

            "tipo" => $datos["tipo"],

            "saldo" => (float)$datos["saldo"],

            "id_cliente" => (int)$datos["id_cliente"],

            "fechaCreacion" => date("Y-m-d H:i:s"),

            "estado" => "Activa"

        ];

        $cuentas[] = $nuevaCuenta;

        JsonManager::guardar($this->archivo, $cuentas);

        return $nuevaCuenta;

    }

    // Actualizar cuenta
    public function actualizar(int $id, array $datos): bool
    {

        $cuentas = $this->obtenerTodos();

        foreach ($cuentas as &$cuenta) {

            if ($cuenta["id"] == $id) {

                $cuenta["tipo"] = $datos["tipo"];

                $cuenta["saldo"] = (float)$datos["saldo"];

                $cuenta["estado"] = $datos["estado"];

                JsonManager::guardar($this->archivo, $cuentas);

                return true;

            }

        }

        return false;

    }

    // Actualizar saldo
    public function actualizarSaldo(string $numero, float $saldo): bool
    {

        $cuentas = $this->obtenerTodos();

        foreach ($cuentas as &$cuenta) {

            if ($cuenta["numero_cuenta"] == $numero) {

                $cuenta["saldo"] = $saldo;

                JsonManager::guardar($this->archivo, $cuentas);

                return true;

            }

        }

        return false;

    }

    // Eliminar
    public function eliminar(int $id): bool
    {

        $cuentas = $this->obtenerTodos();

        foreach ($cuentas as $indice => $cuenta) {

            if ($cuenta["id"] == $id) {

                unset($cuentas[$indice]);

                JsonManager::guardar(
                    $this->archivo,
                    array_values($cuentas)
                );

                return true;

            }

        }

        return false;

    }

    // Generar número de cuenta automático
    private function generarNumeroCuenta(): string
    {

        $cuentas = $this->obtenerTodos();

        if (empty($cuentas)) {

            return "100001";

        }

        $ultimo = end($cuentas);

        return (string)((int)$ultimo["numero_cuenta"] + 1);

    }

}