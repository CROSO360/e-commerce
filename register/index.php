
<?php
/*if (isset($_SESSION['usuario'])) {
    if ($_SESSION['usuario'][7] == "ADMINISTRADOR") {
        header('location: main_app/admin');
    }else if($_SESSION['usuario'][7] == "CLIENTE"){
        header('location: main_app/cliente');
    }
}*/

include_once '../api/usuario/usuario.php';

//session_start();

if (isset($_SESSION['usuario'])) {
    header('location: ../');
}else{
    if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['cedula']) && isset($_POST['correo']) && isset($_POST['usuario']) && isset($_POST['contrasena']) && isset($_POST['rep_contrasena'])) {

        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $cedula = $_POST['cedula'];
        $correo = $_POST['correo'];
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];
        $rep_contrasena = $_POST['rep_contrasena'];

        if ($contrasena == $rep_contrasena) {
            
            $user = new Usuario;
    
            $datosUsuario = $user->register($nombre, $apellido, $cedula, $correo, $usuario, $contrasena);
        
            /*$productos = new Productos();
                $items = $productos->getItemsByCategory($categoria);
                echo json_encode(['statuscode' => 200, 
                                'items' => $items]);*/
        
            if ($datosUsuario == null) {
                echo json_encode([
                    'statuscode' => 400,
                    'response' => 'Usuario o contrasena incorrectos'
                ]);
            }else{
                session_start();
                $_SESSION['usuario'] = json_encode($datosUsuario);
                echo json_encode([
                    'statuscode' => 200,
                    'response' => $datosUsuario
                ]);
        
                if ($datosUsuario['rol'] == 'ADMINISTRADOR') {
                        header('location: ../admin');
                    }elseif ($datosUsuario['rol'] == 'CLIENTE') {
                        //header('location: ../shop');
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
}



?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../iniciotejena.Css" />
    <link rel="stylesheet" href="../all.min.css" />
    <link rel="shortcut icon" href="../img/images/icon.svg" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    
    <title>Sign Up</title>
    <style>

    </style>
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
        <a href="../login" class="btnss">Log in</a>
      </div>
    </header>
    <!-- Sign Up -->
    <section class="container sign-up">
      <div class="form" >
        <h1>¿No tienes una cuenta?</h1>
        <p>Regístrate ahora y disfruta de los beneficios,
           como descuentos, cupones mensuales, entre muchos otros mas que conocerás después... o <a href="../login">inicia sesion</a></p>

           <form class="form-input" action="#" method="post">
            <div class="row mb-3">
              <div class="col">
                  <div class="form-floating" id="grupo_nombre">
                      <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre">
                      <label for="nombre">Nombre</label>

                  </div>
              </div>
              <div class="col">
                  <div class="form-floating" id="grupo_apellidos">
                      <input type="text" class="formulario_input form-control" id="apellidos" name="apellido"
                          placeholder="Apellido">
                      <label for="apellidos">Apellido</label>
                  </div>
              </div>
              <span>¿Seguro que has introducido el nombre correctamente?</span>
          </div>
          <div class="form-floating mb-3">
              <input type="text" class="form-control" id="cedula" placeholder="1315154846" name="cedula">
              <label for="cedula">Cédula</label>
              <span>Solo puede contener 10 números.</span>
          </div>
          <div class="form-floating mb-3">
              <input type="text" class="form-control" id="usuario" placeholder="Usuario" name="usuario">
              <label for="usuario">Usuario</label>
              <span>El usuario no debe de contener espacios</span>
          </div>
          <div class="form-floating mb-3">
              <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="correo">
              <label for="floatingInput">Correo Electrónico</label>
              <span>Puedes utilizar letras, números y puntos.</span>
          </div>
          <div class="row">
              <div class="col">
                  <div class="form-floating">
                      <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="contrasena">
                      <label for="floatingPassword">Contraseña</label>
                  </div>
              </div>
              <div class="col">
                  <div class="form-floating">
                      <input type="password" class="form-control" id="floatingPassword2" placeholder="Password" name="rep_contrasena">
                      <label for="floatingPassword2">Repetir contraseña</label>
                  </div>
              </div>
              <span>Usa 8 carácteres como mínimo</span>
              <span>Las contraseñas no coinciden. Inténtalo de nuevo.</span>
          </div></br>
          <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
              <label class="most form-check-label" for="flexCheckChecked">
                  &nbsp;Mostrar Contraseña
              </label>
          </div>
          <button type="submit">Registrate</button>
        </form>
      </div>
      <div class="signup-img">
        <img src="../img/images/Registratee.png" />
      </div>
    </section>

    <!-- Footer -->
    <section class="footer">
      <div class="copyright">
        <p>&#169; Papeleria la 13 todos los derechos reservados 2022</p>
      </div>
    </section>
  </body>
  <script src="../js/sign-up.js"></script>
</html>


<!--!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Crear cuenta</title>
    </head>
    <body>

    
        <form action="#" method="post">
            Nombre: <br><input type="text" name="nombre"><br>
            Apellido: <br><input type="text" name="apellido"><br>
            Cedula: <br><input type="text" name="cedula"><br>
            Correo: <br><input type="text" name="correo"><br>
            Usuario: <br><input type="text" name="usuario"><br>
            Contraseña: <br><input type="text" name="contrasena"><br>
            <input type="submit" value="Crear cuenta">
        </form>
        
            

    </body>
</html-->