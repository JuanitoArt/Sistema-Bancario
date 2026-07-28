<?php

require_once __DIR__ . '/../models/Cliente.php';
require_once __DIR__ . '/../models/Cuenta.php';

class CuentaController
{

    private Cuenta $modelo;

    public function __construct()
    {

        $this->modelo = new Cuenta();

    }

    // Registrar cuenta
    public function registrar(array $datos): array
{

    if ($datos["saldo"] < 0) {

        return [

            "success" => false,

            "mensaje" => "El saldo inicial no puede ser negativo."

        ];

    }

    $clienteModel = new Cliente();

    if (!$clienteModel->buscarPorId((int)$datos["id_cliente"])) {

        return [

            "success" => false,

            "mensaje" => "El cliente seleccionado no existe."

        ];

    }

    $cuenta = $this->modelo->crear($datos);

    return [

        "success" => true,

        "mensaje" => "Cuenta registrada correctamente.",

        "data" => $cuenta

    ];

}

    // Listar cuentas
    public function listar(): array
    {

        return $this->modelo->obtenerTodos();

    }

    // Buscar por ID
    public function buscar(int $id): ?array
    {

        return $this->modelo->buscarPorId($id);

    }

    // Buscar por número
    public function buscarNumero(string $numero): ?array
    {

        return $this->modelo->buscarPorNumero($numero);

    }

    // Actualizar
    public function actualizar(int $id, array $datos): array
    {

        if ($datos["saldo"] < 0) {

            return [

                "success" => false,

                "mensaje" => "El saldo no puede ser negativo."

            ];

        }

        $actualizado = $this->modelo->actualizar($id, $datos);

        return [

            "success" => $actualizado,

            "mensaje" => $actualizado
                ? "Cuenta actualizada correctamente."
                : "Cuenta no encontrada."

        ];

    }

    // Actualizar saldo
    public function actualizarSaldo(string $numero, float $saldo): bool
    {

        return $this->modelo->actualizarSaldo($numero, $saldo);

    }

    // Eliminar
    public function eliminar(int $id): array
    {

        $eliminado = $this->modelo->eliminar($id);

        return [

            "success" => $eliminado,

            "mensaje" => $eliminado
                ? "Cuenta eliminada correctamente."
                : "Cuenta no encontrada."

        ];

    }

}

?>