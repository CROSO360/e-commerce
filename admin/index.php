<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
</head>

<body>

    <?php

    session_start();

    

    if (isset($_SESSION['usuario'])) {

        $obj = json_decode($_SESSION['usuario']);

        if ($obj->rol == 'CLIENTE') {
            header('location: ../index.php');
        }

    } else {
        header('location: ../login');
    }

    ?>

    <h1>Bienvenido administrador <?php echo $obj->usuario ?></h1>

    <a href="logout.php">Cerrar sesión</a>
</body>

</html>