<?php

require_once __DIR__ . '/../layout/menu.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "Entrando editar<br>";

require_once __DIR__ . "/../../controllers/ClienteController.php";

echo "Controlador cargado<br>";

$controller = new ClienteController();

echo "Objeto creado<br>";

$error = "";

$id = $_GET["id"] ?? null;


if(!$id){

    echo "Cliente no encontrado.";
    exit;

}



$cliente = $controller->buscar((int)$id);



if(!$cliente){

    echo "Cliente no encontrado.";
    exit;

}



if($_SERVER["REQUEST_METHOD"] === "POST"){


    $datos = [

        "nombre" => $_POST["nombre"],

        "apellido" => $_POST["apellido"],

        "documento" => $_POST["documento"],

        "telefono" => $_POST["telefono"],

        "correo" => $_POST["correo"]

    ];



    $resultado = $controller->actualizar(
        (int)$id,
        $datos
    );



    if($resultado["success"]){


        header(
            "Location: /Sistema-Bancario/index.php?vista=clientes"
        );

        exit;


    }else{


        $error = $resultado["mensaje"];

    }


}


?>


<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Editar Cliente</title>


<style>

body{

    font-family:Arial;
    margin:40px;

}



form{

    width:400px;
    margin:auto;

}



input{

    width:100%;
    padding:10px;
    margin:8px 0;

}



button{

    width:100%;
    padding:10px;
    background:#198754;
    color:white;
    border:none;
    cursor:pointer;

}



.error{

    color:red;

}


</style>


</head>


<body>


<h1 align="center">
Editar Cliente
</h1>



<?php if($error): ?>

<p class="error">
<?= $error ?>
</p>

<?php endif; ?>



<form method="POST">


<input
type="text"
name="nombre"
value="<?= $cliente["nombre"] ?>"
required
>



<input
type="text"
name="apellido"
value="<?= $cliente["apellido"] ?>"
required
>



<input
type="text"
name="documento"
value="<?= $cliente["documento"] ?>"
required
>



<input
type="text"
name="telefono"
value="<?= $cliente["telefono"] ?>"
required
>



<input
type="email"
name="correo"
value="<?= $cliente["correo"] ?>"
required
>



<button type="submit">

Guardar cambios

</button>



</form>



<br>


<center>

<a href="/Sistema-Bancario/index.php?vista=clientes">

Volver

</a>

</center>



</body>

</html>