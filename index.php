<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$vista = $_GET["vista"] ?? "clientes";


switch ($vista) {


    case "clientes":

        require_once "views/clientes/index.php";

        break;


    case "crearCliente":

        require_once "views/clientes/crear.php";

        break;


    case "editarCliente":

        require_once "views/clientes/editar.php";

        break;


    default:

        echo "<h2>Página no encontrada</h2>";

        break;

}

?>