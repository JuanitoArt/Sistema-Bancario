<?php

require_once __DIR__ . '/../layout/menu.php';
require_once __DIR__ . '/../../controllers/CuentaController.php';
require_once __DIR__ . '/../../controllers/ClienteController.php';

$cuentaController = new CuentaController();
$clienteController = new ClienteController();

$clientes = $clienteController->listar();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $resultado = $cuentaController->registrar($_POST);

    if ($resultado["success"]) {

        header("Location: index.php?vista=cuentas");
        exit;

    }

    $error = $resultado["mensaje"];

}

?>

<!DOCTYPE html>

<html lang="es">

<head>

<meta charset="UTF-8">

<title>Registrar Cuenta</title>

</head>

<body>

<h2>Registrar Cuenta</h2>

<?php if($error!=""): ?>

<p style="color:red;">

<?= $error ?>

</p>

<?php endif; ?>

<form method="POST">

<p>

<label>Cliente</label>

<br>

<select name="id_cliente" required>

<option value="">Seleccione...</option>

<?php foreach($clientes as $cliente): ?>

<option value="<?= $cliente["id"] ?>">

<?= $cliente["nombre"] ?> <?= $cliente["apellido"] ?>

</option>

<?php endforeach; ?>

</select>

</p>

<p>

<label>Tipo de Cuenta</label>

<br>

<select name="tipo" required>

<option value="">Seleccione...</option>

<option value="Ahorros">Ahorros</option>

<option value="Corriente">Corriente</option>

</select>

</p>

<p>

<label>Saldo Inicial</label>

<br>

<input
type="number"
name="saldo"
step="0.01"
min="0"
required>

</p>

<p>

<button type="submit">

Registrar Cuenta

</button>

</p>

</form>

<hr>

<a href="index.php?vista=cuentas">

Volver al listado

</a>

</body>

</html>