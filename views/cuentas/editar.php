<?php

require_once __DIR__ . '/../layout/menu.php';
require_once __DIR__ . '/../../controllers/CuentaController.php';

$controller = new CuentaController();

$id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;

$cuenta = $controller->buscar($id);

if (!$cuenta) {

    die("La cuenta no existe.");

}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $resultado = $controller->actualizar($id, [

        "tipo" => $_POST["tipo"],

        "saldo" => $_POST["saldo"],

        "estado" => $_POST["estado"]

    ]);

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

<title>Editar Cuenta</title>

</head>

<body>

<h2>Editar Cuenta</h2>

<?php if($error!=""): ?>

<p style="color:red;">

<?= $error ?>

</p>

<?php endif; ?>

<form method="POST">

<p>

<label>Número de Cuenta</label>

<br>

<input
type="text"
value="<?= $cuenta["numero_cuenta"] ?>"
readonly>

</p>

<p>

<label>Tipo</label>

<br>

<select name="tipo">

<option value="Ahorros" <?= $cuenta["tipo"]=="Ahorros"?"selected":"" ?>>

Ahorros

</option>

<option value="Corriente" <?= $cuenta["tipo"]=="Corriente"?"selected":"" ?>>

Corriente

</option>

</select>

</p>

<p>

<label>Saldo</label>

<br>

<input
type="number"
name="saldo"
step="0.01"
min="0"
value="<?= $cuenta["saldo"] ?>"
required>

</p>

<p>

<label>Estado</label>

<br>

<select name="estado">

<option value="Activa" <?= $cuenta["estado"]=="Activa"?"selected":"" ?>>

Activa

</option>

<option value="Inactiva" <?= $cuenta["estado"]=="Inactiva"?"selected":"" ?>>

Inactiva

</option>

</select>

</p>

<p>

<button type="submit">

Guardar Cambios

</button>

</p>

</form>

<hr>

<a href="index.php?vista=cuentas">

Volver al listado

</a>

</body>

</html>