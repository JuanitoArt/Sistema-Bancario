<?php

require_once "../models/Cuenta.php";

class CuentaController
{
    private $cuenta;

    public function __construct()
    {
        $this->cuenta = new Cuenta();
    }

    // Crear cuenta
    public function crear($numero, $tipo, $saldo, $cliente)
    {
        return $this->cuenta->crearCuenta(
            $numero,
            $tipo,
            $saldo,
            $cliente
        );
    }

    // Buscar cuenta
    public function buscar($numero)
    {
        return $this->cuenta->buscarCuenta($numero);
    }

    // Consultar saldo
    public function consultarSaldo($numero)
    {
        return $this->cuenta->consultarSaldo($numero);
    }

    // Listar todas las cuentas
    public function listar()
    {
        return $this->cuenta->listarCuentas();
    }

    // Actualizar saldo
    public function actualizarSaldo($numero, $saldo)
    {
        return $this->cuenta->actualizarSaldo($numero, $saldo);
    }

    // Editar tipo de cuenta
    public function editar($numero, $nuevoTipo)
    {
        return $this->cuenta->editarCuenta($numero, $nuevoTipo);
    }

    // Eliminar cuenta
    public function eliminar($numero)
    {
        return $this->cuenta->eliminarCuenta($numero);
    }

    // Obtener cuentas de un cliente
    public function cuentasCliente($idCliente)
    {
        return $this->cuenta->cuentasPorCliente($idCliente);
    }

    // Total de cuentas registradas
    public function total()
    {
        return $this->cuenta->totalCuentas();
    }
}

?>