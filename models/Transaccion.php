<?php

class Transaccion
{
    private $archivo;

    public function __construct()
    {
        $this->archivo = "../database/transacciones.json";

        if (!file_exists($this->archivo)) {
            file_put_contents($this->archivo, json_encode([], JSON_PRETTY_PRINT));
        }
    }

    // Leer transacciones
    private function leer()
    {
        $datos = file_get_contents($this->archivo);

        if (empty($datos)) {
            return [];
        }

        return json_decode($datos, true) ?? [];
    }

    // Guardar transacciones
    private function guardar($datos)
    {
        file_put_contents(
            $this->archivo,
            json_encode($datos, JSON_PRETTY_PRINT)
        );
    }

    // Registrar movimiento
    public function registrar($tipo, $valor, $origen, $destino)
    {
        $transacciones = $this->leer();

        $nueva = [
            "id" => count($transacciones) + 1,
            "tipo" => $tipo,
            "valor" => $valor,
            "cuenta_origen" => $origen,
            "cuenta_destino" => $destino,
            "fecha" => date("Y-m-d H:i:s")
        ];

        $transacciones[] = $nueva;

        $this->guardar($transacciones);

        return "Movimiento registrado.";
    }

    // Ver historial
    public function historial()
    {
        return $this->leer();
    }
    // Buscar una transacción por ID
public function buscarPorId($id)
{
    $transacciones = $this->leer();

    foreach ($transacciones as $transaccion) {

        if ($transaccion["id"] == $id) {

            return $transaccion;

        }

    }

    return null;
}

// Historial de una cuenta
public function historialCuenta($numeroCuenta)
{
    $transacciones = $this->leer();

    $resultado = [];

    foreach ($transacciones as $transaccion) {

        if (
            $transaccion["cuenta_origen"] == $numeroCuenta ||
            $transaccion["cuenta_destino"] == $numeroCuenta
        ) {

            $resultado[] = $transaccion;

        }

    }

    return $resultado;
}

// Filtrar transacciones por tipo
public function filtrarTipo($tipo)
{
    $transacciones = $this->leer();

    $resultado = [];

    foreach ($transacciones as $transaccion) {

        if ($transaccion["tipo"] == $tipo) {

            $resultado[] = $transaccion;

        }

    }

    return $resultado;
}

// Total de transacciones
public function totalTransacciones()
{
    return count($this->leer());
}

}

?>