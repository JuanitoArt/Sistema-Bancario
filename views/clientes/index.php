<?php



require_once __DIR__ . "/../../controllers/ClienteController.php";

$controller = new ClienteController();

if(isset($_GET["accion"]) && $_GET["accion"] == "eliminar"){

    $id = $_GET["id"];

    $resultado = $controller->eliminar($id);

    $_SESSION["mensaje"] = $resultado["mensaje"];
    $_SESSION["success"] = $resultado["success"];

    header("Location: /Sistema-Bancario/index.php?vista=clientes");

    exit;

}

$clientes = $controller->listar();

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Clientes</title>

<style>

body{

    font-family: Arial, sans-serif;
    margin:40px;
    background:#f4f4f4;

}

.contenedor{

    background:white;
    padding:25px;
    border-radius:10px;

}

h1{

    text-align:center;

}

.boton{

    display:inline-block;
    background:#198754;
    color:white;
    padding:10px 15px;
    text-decoration:none;
    border-radius:5px;

}

table{

    width:100%;
    border-collapse:collapse;
    margin-top:20px;

}

th{

    background:#0d6efd;
    color:white;

}

th, td{

    border:1px solid #ddd;
    padding:10px;
    text-align:center;

}

.editar{

    color:green;
    text-decoration:none;

}

.eliminar{

    color:red;
    text-decoration:none;

}

.mensaje{

    padding:12px;
    margin-bottom:20px;
    border-radius:6px;
    text-align:center;
    font-weight:bold;

}

.exito{

    background:#d1e7dd;
    color:#0f5132;

}

.error{

    background:#f8d7da;
    color:#842029;

}

</style>

</head>

<body>

<div class="contenedor">

<h1>Sistema Bancario</h1>

<?php require_once __DIR__ . '/../layout/menu.php'; ?>

<?php

if(isset($_SESSION["mensaje"])){

    $clase = $_SESSION["success"] ? "exito" : "error";

    echo "<div class='mensaje $clase'>".$_SESSION["mensaje"]."</div>";

    unset($_SESSION["mensaje"]);
    unset($_SESSION["success"]);

}

?>

<h2 style="text-align:center;">Clientes Registrados</h2>

<a class="boton" href="/Sistema-Bancario/index.php?vista=crearCliente">

➕ Nuevo Cliente

</a>

<table>

<tr>

<th>ID</th>

<th>Nombre</th>

<th>Apellido</th>

<th>Documento</th>

<th>Teléfono</th>

<th>Correo</th>

<th>Estado</th>

<th>Acciones</th>

</tr>

<?php if(empty($clientes)): ?>

<tr>

<td colspan="8">

No hay clientes registrados.

</td>

</tr>

<?php else: ?>

<?php foreach($clientes as $cliente): ?>

<tr>

<td><?= $cliente["id"] ?></td>

<td><?= $cliente["nombre"] ?></td>

<td><?= $cliente["apellido"] ?></td>

<td><?= $cliente["documento"] ?></td>

<td><?= $cliente["telefono"] ?></td>

<td><?= $cliente["correo"] ?></td>

<td><?= $cliente["estado"] ?></td>

<td>

<a
class="editar"
href="/Sistema-Bancario/index.php?vista=editarCliente&id=<?= $cliente["id"] ?>">

Editar

</a>

|

<a
class="eliminar"
href="/Sistema-Bancario/index.php?vista=clientes&accion=eliminar&id=<?= $cliente["id"] ?>"
onclick="return confirm('¿Seguro que desea eliminar este cliente?')">

Eliminar

</a>

</td>

</tr>

<?php endforeach; ?>

<?php endif; ?>

</table>

</div>

</body>

</html>