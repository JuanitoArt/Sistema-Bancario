<?php

require_once __DIR__ . '/../layout/menu.php';
require_once __DIR__ . '/../../controllers/TransaccionController.php';
require_once __DIR__ . '/../../models/Cuenta.php';

$controller = new TransaccionController();
$cuentaModel = new Cuenta();

$cuentas = $cuentaModel->obtenerTodos();

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $resultado = $controller->transferir(

        $_POST["origen"],

        $_POST["destino"],

        (float)$_POST["valor"]

    );

    $mensaje = $resultado["mensaje"];

    if ($resultado["success"]) {

        header("Location: index.php?vista=transacciones");

        exit;

    }

}

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Transferencia</title>

</head>

<body>

<h2>Nueva Transferencia</h2>

<?php if($mensaje!=""): ?>

<p style="color:red;">

<?= $mensaje ?>

</p>

<?php endif; ?>

<form method="POST">

<p>

<label>Cuenta Origen</label><br>

<select name="origen" required>

<?php foreach($cuentas as $cuenta): ?>

<option value="<?= $cuenta["numero_cuenta"] ?>">

<?= $cuenta["numero_cuenta"] ?>

</option>

<?php endforeach; ?>

</select>

</p>

<p>

<label>Cuenta Destino</label><br>

<select name="destino" required>

<?php foreach($cuentas as $cuenta): ?>

<option value="<?= $cuenta["numero_cuenta"] ?>">

<?= $cuenta["numero_cuenta"] ?>

</option>

<?php endforeach; ?>

</select>

</p>

<p>

<label>Valor</label><br>

<input
type="number"
name="valor"
min="1"
step="0.01"
required>

</p>

<p>

<button type="submit">

Transferir

</button>

</p>

</form>

<br>

<a href="index.php?vista=transacciones">

Volver

</a>

</body>

</html>