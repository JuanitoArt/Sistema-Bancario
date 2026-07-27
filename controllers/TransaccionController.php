<?php

require_once "../models/Cuenta.php";
require_once "../models/Transaccion.php";

class TransaccionController
{
    private $cuenta;
    private $transaccion;

    public function __construct()
    {
        $this->cuenta = new Cuenta();
        $this->transaccion = new Transaccion();
    }

    // ==========================
    // DEPOSITAR
    // ==========================
    public function depositar($numeroCuenta, $valor)
    {
        if ($valor <= 0) {
            return "El valor del depósito debe ser mayor a 0.";
        }

        $cuenta = $this->cuenta->buscarCuenta($numeroCuenta);

        if (!$cuenta) {
            return "La cuenta no existe.";
        }

        $nuevoSaldo = $cuenta["saldo"] + $valor;

        $this->cuenta->actualizarSaldo($numeroCuenta, $nuevoSaldo);

        $this->transaccion->registrar(
            "Depósito",
            $valor,
            $numeroCuenta,
            null
        );

        return "Depósito realizado correctamente.";
    }

    // ==========================
    // RETIRAR
    // ==========================
    public function retirar($numeroCuenta, $valor)
    {
        if ($valor <= 0) {
            return "El valor del retiro debe ser mayor a 0.";
        }

        $cuenta = $this->cuenta->buscarCuenta($numeroCuenta);

        if (!$cuenta) {
            return "La cuenta no existe.";
        }

        if ($cuenta["saldo"] < $valor) {
            return "Saldo insuficiente.";
        }

        $nuevoSaldo = $cuenta["saldo"] - $valor;

        $this->cuenta->actualizarSaldo($numeroCuenta, $nuevoSaldo);

        $this->transaccion->registrar(
            "Retiro",
            $valor,
            $numeroCuenta,
            null
        );

        return "Retiro realizado correctamente.";
    }

    // ==========================
    // TRANSFERIR
    // ==========================
    public function transferir($cuentaOrigen, $cuentaDestino, $valor)
    {
        if ($valor <= 0) {
            return "El valor de la transferencia debe ser mayor a 0.";
        }

        if ($cuentaOrigen == $cuentaDestino) {
            return "No puede transferir a la misma cuenta.";
        }

        $origen = $this->cuenta->buscarCuenta($cuentaOrigen);
        $destino = $this->cuenta->buscarCuenta($cuentaDestino);

        if (!$origen) {
            return "La cuenta origen no existe.";
        }

        if (!$destino) {
            return "La cuenta destino no existe.";
        }

        if ($origen["saldo"] < $valor) {
            return "Saldo insuficiente.";
        }

        // Actualizar saldo de origen
        $this->cuenta->actualizarSaldo(
            $cuentaOrigen,
            $origen["saldo"] - $valor
        );

        // Actualizar saldo de destino
        $this->cuenta->actualizarSaldo(
            $cuentaDestino,
            $destino["saldo"] + $valor
        );

        // Registrar movimiento
        $this->transaccion->registrar(
            "Transferencia",
            $valor,
            $cuentaOrigen,
            $cuentaDestino
        );

        return "Transferencia realizada correctamente.";
    }

    // ==========================
    // HISTORIAL
    // ==========================
    public function historial()
    {
        return $this->transaccion->historial();
    }
        // Buscar una transacción por ID
    public function buscarPorId($id)
    {
        return $this->transaccion->buscarPorId($id);
    }

    // Historial de una cuenta
    public function historialCuenta($numeroCuenta)
    {
        return $this->transaccion->historialCuenta($numeroCuenta);
    }

    // Filtrar transacciones por tipo
    public function filtrarTipo($tipo)
    {
        return $this->transaccion->filtrarTipo($tipo);
    }

    // Total de transacciones
    public function total()
    {
        return $this->transaccion->totalTransacciones();
    }
}

?>