<?php

require_once __DIR__ . '/../models/Cuenta.php';
require_once __DIR__ . '/../models/Transaccion.php';

class TransaccionController
{

    private Cuenta $cuentaModel;
    private Transaccion $transaccionModel;

    public function __construct()
    {

        $this->cuentaModel = new Cuenta();
        $this->transaccionModel = new Transaccion();

    }

    // ==========================
    // DEPÓSITO
    // ==========================
    public function depositar(string $numeroCuenta, float $valor): array
    {

        $cuenta = $this->cuentaModel->buscarPorNumero($numeroCuenta);

        if ($valor <= 0) {

            return [
             "success" => false,
             "mensaje" => "El valor debe ser mayor que cero."

    ];

}

        if (!$cuenta) {

            return [
                "success" => false,
                "mensaje" => "La cuenta no existe."
            ];

        }

        if ($cuenta["estado"] != "Activa") {

            return [
                "success" => false,
                "mensaje" => "La cuenta está inactiva."
            ];

        }

        $nuevoSaldo = $cuenta["saldo"] + $valor;

        $this->cuentaModel->actualizarSaldo(
            $numeroCuenta,
            $nuevoSaldo
        );

        $this->transaccionModel->crear([
            "tipo" => "Depósito",
            "valor" => $valor,
            "cuenta_origen" => $numeroCuenta,
            "cuenta_destino" => null
        ]);

        return [
            "success" => true,
            "mensaje" => "Depósito realizado correctamente."
        ];

    }

    // ==========================
    // RETIRO
    // ==========================
    public function retirar(string $numeroCuenta, float $valor): array
    {

        $cuenta = $this->cuentaModel->buscarPorNumero($numeroCuenta);

        if ($valor <= 0) {

            return [
             "success" => false,
             "mensaje" => "El valor debe ser mayor que cero."

    ];

}

        if (!$cuenta) {

            return [
                "success" => false,
                "mensaje" => "La cuenta no existe."
            ];

        }

        if ($cuenta["estado"] != "Activa") {

            return [
                "success" => false,
                "mensaje" => "La cuenta está inactiva."
            ];

        }

        if ($cuenta["saldo"] < $valor) {

            return [
                "success" => false,
                "mensaje" => "Saldo insuficiente."
            ];

        }

        $this->cuentaModel->actualizarSaldo(
            $numeroCuenta,
            $cuenta["saldo"] - $valor
        );

        $this->transaccionModel->crear([
            "tipo" => "Retiro",
            "valor" => $valor,
            "cuenta_origen" => $numeroCuenta,
            "cuenta_destino" => null
        ]);

        return [
            "success" => true,
            "mensaje" => "Retiro realizado correctamente."
        ];

    }

    // ==========================
    // TRANSFERENCIA
    // ==========================
    public function transferir(
        string $origen,
        string $destino,
        float $valor
    ): array
    {
        if ($valor <= 0) {

            return [
             "success" => false,
             "mensaje" => "El valor debe ser mayor que cero."

    ];

}
        if ($origen == $destino) {

            return [
                "success" => false,
                "mensaje" => "No puede transferir a la misma cuenta."
            ];

        }

        $cuentaOrigen = $this->cuentaModel->buscarPorNumero($origen);
        $cuentaDestino = $this->cuentaModel->buscarPorNumero($destino);

        if (!$cuentaOrigen || !$cuentaDestino) {

            return [
                "success" => false,
                "mensaje" => "Una de las cuentas no existe."
            ];

        }

        if ($cuentaOrigen["estado"] != "Activa") {

            return [
                "success" => false,
                "mensaje" => "La cuenta origen está inactiva."
            ];

        }

        if ($cuentaDestino["estado"] != "Activa") {

            return [
                "success" => false,
                "mensaje" => "La cuenta destino está inactiva."
            ];

        }

        if ($cuentaOrigen["saldo"] < $valor) {

            return [
                "success" => false,
                "mensaje" => "Saldo insuficiente."
            ];

        }

        $this->cuentaModel->actualizarSaldo(
            $origen,
            $cuentaOrigen["saldo"] - $valor
        );

        $this->cuentaModel->actualizarSaldo(
            $destino,
            $cuentaDestino["saldo"] + $valor
        );

        $this->transaccionModel->crear([
            "tipo" => "Transferencia",
            "valor" => $valor,
            "cuenta_origen" => $origen,
            "cuenta_destino" => $destino
        ]);

        return [
            "success" => true,
            "mensaje" => "Transferencia realizada correctamente."
        ];

    }

    // ==========================
    // HISTORIAL
    // ==========================
    public function listar(): array
    {

        return $this->transaccionModel->obtenerTodos();

    }

}