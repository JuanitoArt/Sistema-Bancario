<?php

require_once __DIR__ . '/../layout/menu.php';
require_once __DIR__ . '/../../controllers/TransaccionController.php';

$controller = new TransaccionController();

$transacciones = $controller->listar();

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Transacciones</title>

</head>

<body>

<h2>Historial de Transacciones</h2>

<p>

    <a href="index.php?vista=deposito">Nuevo Depósito</a> |

    <a href="index.php?vista=retiro">Nuevo Retiro</a> |

    <a href="index.php?vista=transferencia">Nueva Transferencia</a>

</p>

<table border="1" cellpadding="8">

<tr>

    <th>ID</th>

    <th>Fecha</th>

    <th>Tipo</th>

    <th>Cuenta Origen</th>

    <th>Cuenta Destino</th>

    <th>Valor</th>

    <th>Estado</th>

</tr>

<?php foreach($transacciones as $t): ?>

<tr>

    <td><?= $t["id"] ?></td>

    <td><?= $t["fecha"] ?></td>

    <td><?= $t["tipo"] ?></td>

    <td><?= $t["cuenta_origen"] ?? "-" ?></td>

    <td><?= $t["cuenta_destino"] ?? "-" ?></td>

    <td>$<?= number_format((float)$t["valor"], 2, ",", ".") ?></td>

    <td><?= $t["estado"] ?></td>

</tr>

<?php endforeach; ?>

</table>

<br>

<a href="index.php?vista=clientes">Clientes</a> |

<a href="index.php?vista=cuentas">Cuentas</a>

</body>

</html>