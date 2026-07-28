<?php

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$vista = $_GET["vista"] ?? "clientes";

switch ($vista) {

    // ==========================
    // CLIENTES
    // ==========================
    case "clientes":
        require_once "views/clientes/index.php";
        break;

    case "crearCliente":
        require_once "views/clientes/crear.php";
        break;

    case "editarCliente":
        require_once "views/clientes/editar.php";
        break;

    // ==========================
    // CUENTAS
    // ==========================
    case "cuentas":
        require_once "views/cuentas/index.php";
        break;

    case "crearCuenta":
        require_once "views/cuentas/crear.php";
        break;

    case "editarCuenta":
        require_once "views/cuentas/editar.php";
        break;

    // ==========================
    // TRANSACCIONES
    // ==========================
    case "transacciones":
        require_once "views/transacciones/index.php";
        break;

    case "deposito":
        require_once "views/transacciones/deposito.php";
        break;

    case "retiro":
        require_once "views/transacciones/retiro.php";
        break;

    case "transferencia":
        require_once "views/transacciones/transferencia.php";
        break;

    default:
        echo "<h2>404 - Página no encontrada</h2>";
        break;
}

?>