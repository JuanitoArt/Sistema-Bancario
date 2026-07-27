<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once __DIR__ . '/../../controllers/ClienteController.php';


$controller = new ClienteController();

$error = "";


if ($_SERVER["REQUEST_METHOD"] === "POST") {


    $datos = [

        "nombre" => $_POST["nombre"],

        "apellido" => $_POST["apellido"],

        "documento" => $_POST["documento"],

        "telefono" => $_POST["telefono"],

        "correo" => $_POST["correo"]

    ];



    $resultado = $controller->registrar($datos);



    if($resultado["success"]){


header("Location: /Sistema-Bancario/index.php?vista=clientes");

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

<title>Registrar Cliente</title>


<style>

body{

    font-family:Arial;
    margin:40px;

}


form{

    width:400px;

}


input{

    width:100%;
    padding:10px;
    margin:8px 0;

}


button{

    padding:10px;
    background:#0d6efd;
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


<h1>Registrar Cliente</h1>


<?php if($error): ?>

<p class="error">
<?= $error ?>
</p>

<?php endif; ?>


<form method="POST">


<input 
type="text"
name="nombre"
placeholder="Nombre"
required
>


<input 
type="text"
name="apellido"
placeholder="Apellido"
required
>


<input 
type="text"
name="documento"
placeholder="Documento"
required
>


<input 
type="text"
name="telefono"
placeholder="Teléfono"
required
>


<input 
type="email"
name="correo"
placeholder="Correo"
required
>


<button type="submit">
Guardar Cliente
</button>


</form>


<br>


<a href="/Sistema-Bancario/index.php?vista=clientes">
    Volver
</a>


</body>

</html>