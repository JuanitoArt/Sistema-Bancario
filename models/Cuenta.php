<?php

class Cuenta
{
    private $archivo;

    public function __construct()
    {
        $this->archivo = "../database/cuenta.json";

        // Si el archivo no existe, lo crea vacío
        if (!file_exists($this->archivo)) {
            file_put_contents($this->archivo, json_encode([], JSON_PRETTY_PRINT));
        }
    }

    // Leer todas las cuentas
    private function leer()
    {
        $datos = file_get_contents($this->archivo);

        if (empty($datos)) {
            return [];
        }

        return json_decode($datos, true) ?? [];
    }

    // Guardar cuentas
    private function guardar($datos)
    {
        file_put_contents(
            $this->archivo,
            json_encode($datos, JSON_PRETTY_PRINT)
        );
    }

    // Crear una cuenta
    public function crearCuenta($numero, $tipo, $saldo, $cliente)
    {
        $cuentas = $this->leer();

        // Validar que no exista una cuenta con el mismo número
        foreach ($cuentas as $cuenta) {
            if ($cuenta["numero_cuenta"] == $numero) {
                return "La cuenta ya existe.";
            }
        }

        $nuevaCuenta = [
            "id" => count($cuentas) + 1,
            "numero_cuenta" => $numero,
            "tipo" => $tipo,
            "saldo" => $saldo,
            "id_cliente" => $cliente
        ];

        $cuentas[] = $nuevaCuenta;

        $this->guardar($cuentas);

        return "Cuenta creada correctamente.";
    }

    // Buscar una cuenta
    public function buscarCuenta($numero)
    {
        $cuentas = $this->leer();

        foreach ($cuentas as $cuenta) {
            if ($cuenta["numero_cuenta"] == $numero) {
                return $cuenta;
            }
        }

        return null;
    }

    // Actualizar saldo
    public function actualizarSaldo($numero, $nuevoSaldo)
    {
        $cuentas = $this->leer();

        foreach ($cuentas as &$cuenta) {
            if ($cuenta["numero_cuenta"] == $numero) {
                $cuenta["saldo"] = $nuevoSaldo;
                break;
            }
        }

        $this->guardar($cuentas);
    }

    // Listar todas las cuentas
    public function listarCuentas()
    {
        return $this->leer();
    }

    // Consultar saldo
    public function consultarSaldo($numero)
    {
        $cuenta = $this->buscarCuenta($numero);

        if ($cuenta) {
            return $cuenta["saldo"];
        }

        return "Cuenta no encontrada.";
    }
    // Editar una cuenta
public function editarCuenta($numero, $nuevoTipo)
{
    $cuentas = $this->leer();

    foreach ($cuentas as &$cuenta) {

        if ($cuenta["numero_cuenta"] == $numero) {

            $cuenta["tipo"] = $nuevoTipo;

            $this->guardar($cuentas);

            return "Cuenta actualizada correctamente.";
        }
    }

    return "Cuenta no encontrada.";
}

// Eliminar una cuenta
public function eliminarCuenta($numero)
{
    $cuentas = $this->leer();

    foreach ($cuentas as $indice => $cuenta) {

        if ($cuenta["numero_cuenta"] == $numero) {

            unset($cuentas[$indice]);

            $cuentas = array_values($cuentas);

            $this->guardar($cuentas);

            return "Cuenta eliminada correctamente.";
        }
    }

    return "Cuenta no encontrada.";
}

// Obtener todas las cuentas de un cliente
public function cuentasPorCliente($idCliente)
{
    $cuentas = $this->leer();

    $resultado = [];

    foreach ($cuentas as $cuenta) {

        if ($cuenta["id_cliente"] == $idCliente) {

            $resultado[] = $cuenta;
        }
    }

    return $resultado;
}

// Total de cuentas registradas
public function totalCuentas()
{
    return count($this->leer());
}

}

?>