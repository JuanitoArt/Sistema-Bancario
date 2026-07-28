<?php

require_once __DIR__ . '/../layout/menu.php';
require_once __DIR__ . '/../../controllers/CuentaController.php';
require_once __DIR__ . '/../../controllers/ClienteController.php';

$cuentaController = new CuentaController();
$clienteController = new ClienteController();

$cuentas = $cuentaController->listar();
$clientes = $clienteController->listar();

// Crear un arreglo para relacionar el ID con el nombre del cliente
$listaClientes = [];

foreach ($clientes as $cliente) {

    $listaClientes[$cliente["id"]] = $cliente["nombre"] . " " . $cliente["apellido"];

}

// Eliminar cuenta
if (isset($_GET["eliminar"])) {

    $cuentaController->eliminar((int)$_GET["eliminar"]);

    header("Location: index.php?vista=cuentas");
    exit;

}

?>

<!DOCTYPE html>

<html lang="es">

<head>

<meta charset="UTF-8">

<title>Listado de Cuentas</title>

</head>

<body>

<h2>Gestión de Cuentas</h2>

<p>

<a href="index.php?vista=crearCuenta">

Nueva Cuenta

</a>

</p>

<table border="1" cellpadding="8" cellspacing="0">

<tr>

<th>ID</th>

<th>Número</th>

<th>Cliente</th>

<th>Tipo</th>

<th>Saldo</th>

<th>Estado</th>

<th>Acciones</th>

</tr>

<?php if(empty($cuentas)): ?>

<tr>

<td colspan="7">

No hay cuentas registradas.

</td>

</tr>

<?php endif; ?>

<?php foreach($cuentas as $cuenta): ?>

<tr>

<td><?= $cuenta["id"] ?></td>

<td><?= $cuenta["numero_cuenta"] ?></td>

<td><?= $listaClientes[$cuenta["id_cliente"]] ?? "No encontrado" ?></td>

<td><?= $cuenta["tipo"] ?></td>

<td>$<?= number_format((float)$cuenta["saldo"], 2, ",", ".") ?></td>

<td><?= $cuenta["estado"] ?></td>

<td>

<a href="index.php?vista=editarCuenta&id=<?= $cuenta["id"] ?>">

Editar

</a>

|

<a
href="index.php?vista=cuentas&eliminar=<?= $cuenta["id"] ?>"
onclick="return confirm('¿Eliminar esta cuenta?')">

Eliminar

</a>

</td>

</tr>

<?php endforeach; ?>

</table>

<br>

<a href="index.php?vista=clientes">

Ir a Clientes

</a>

</body>

</html>