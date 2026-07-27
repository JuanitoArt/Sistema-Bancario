<?php

require_once "config/JsonManager.php";

$clientes = JsonManager::leer("database/clientes.json");

echo "<pre>";
print_r($clientes);
echo "</pre>";
