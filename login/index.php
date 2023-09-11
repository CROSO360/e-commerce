<?php

/*if (isset($_SESSION['usuario'])) {
if ($_SESSION['usuario'][7] == "ADMINISTRADOR") {
header('location: main_app/admin');
}else if($_SESSION['usuario'][7] == "CLIENTE"){
header('location: main_app/cliente');
}
}*/

include_once '../api/usuario/usuario.php';

session_start();

if (isset($_SESSION['usuario'])) {
    header('location: ../');
} else {
    if (isset($_POST['usuario']) && isset($_POST['contrasena'])) {
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];

        $user = new Usuario;

        $datosUsuario = $user->login($usuario, $contrasena);

        /*$productos = new Productos();
        $items = $productos->getItemsByCategory($categoria);
        echo json_encode(['statuscode' => 200, 
        'items' => $items]);*/

        if ($datosUsuario == null) {
            echo json_encode([
                'statuscode' => 400,
                'response' => 'Usuario o contrasena incorrectos'
            ]);
        } else {
            session_start();
            $_SESSION['usuario'] = json_encode($datosUsuario);
            echo json_encode([
                'statuscode' => 200,
                'response' => $datosUsuario
            ]);

            if ($datosUsuario['rol'] == 'ADMINISTRADOR') {
                header('location: ../admin');
            } elseif ($datosUsuario['rol'] == 'CLIENTE') {
                header('location: ../');
            }
        }




        /*if (isset($_SESSION['usuario'])) {
        if ($_SESSION['usuario'][7] == "ADMINISTRADOR") {
        //echo 'administrador!!!';
        header('location: ../admin');
        }else if($_SESSION['usuario'][7] == "CLIENTE"){
        //echo 'cliente!!!';
        header('location: ../shop');
        }
        }*/
    }
}



?>

<!--!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>iniciar sesion</title>
    </head>
    <body>

    
        <form action="#" method="post">
            Usuario: <br><input type="text" name="usuario"><br>
            Contraseña: <br><input type="text" name="contrasena"><br>
            <input type="submit" value="Iniciar sesión">
        </form>
        
            

    </body>
</html-->

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../iniciotejena.Css" />
    <link rel="stylesheet" href="../shop/all.min.css" />
    <link rel="shortcut icon" href="../img/images/icon.svg" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Login</title>
</head>

<body>
    <header>
        <div class="nav container">
            <!-- Logo -->
            <a href="../" class="logo">
                <i class="fa-solid fa-house"></i>
                PAPELERIA LA 13
            </a>

            <!-- log-in button -->
            <a href="../register" class="btnss">Sign Up</a>
        </div>
    </header>

    <!-- Log in -->
    <section class="container all">
        <div class="form">
            <h1>¡Bienvenido
                de vuelta!</h1>
            <p>Es un placer tenerte de nuevo por el sitio, esperamos que encuentres lo que busques. </p>
            <form class="form-input" action="#" method="post">
                <div class="form-floating mb-3">
                    <input type="text" name="usuario" class="form-control" id="floatingInput"
                        placeholder="name@example.com">
                    <label for="floatingInput">Usuario o Correo Electrónico</label>
                </div>
                <div class="form-floating">
                    <input type="password" name="contrasena" class="form-control" id="floatingPassword"
                        placeholder="Password">
                    <label for="floatingPassword">Contraseña</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                    <label class="most form-check-label" for="flexCheckChecked">
                        &nbsp;Mostrar Contraseña
                    </label>
                </div>
                <button type="submit">Ingresar</button>
                <a href="#">Olvido su contraseña?</a>
            </form>
        </div>
        <div class="login-img">
            <img src="../img/images/bIENVENIDO.png" />
        </div>
    </section>

    <!-- Footer -->
    <section class="footer">

        <div class="copyright">
            <p>&#169; Papeleria la 13 todos los derechos reservados 2022</p>
        </div>
    </section>
</body>
<script src="../js/login.js"></script>

</html>