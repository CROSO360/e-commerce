<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="../img/images/icon.svg" />
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="all.min.css" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <header>

        <div class="nav container">
            <!-- Logo -->
            <a href="../" class="logo">
                <i class="fa-solid fa-house"></i>
                PAPELERIA LA 13
            </a>
            <!-- Menu Icon -->
           
            <input type="checkbox" id="menu" />
            <label for="menu" id="menu-icon"><i class="fa-solid fa-bars"></i></label>
            <!-- Navigation Bar -->
            <ul class="navbar">
                <li><a href="../index.php">Inicio</a></li>
                <li><a href="index.php">Productos</a></li>
                <li><a href="../index.php#about">Sobre</a></li>
                <li><a href="../index.php#properties">Promos</a></li>
      </a></li>
            </ul>
            <!-- log-in button -->
            <?php
            session_start();
            //$_SESSION['orden'];
            //unset($_SESSION['orden']);
            if (isset($_SESSION['usuario'])) {
                $respuesta = json_decode($_SESSION['usuario']);

                echo "<div style='margin-left:10px'>Bienvenido ".$respuesta->nombre." ".$respuesta->apellido."</div><br>

                <a href='logout.php' class='btn'>Cerrar Sesión</a>
                
                ";
            } else {
                echo '<a href="../login" class="btn">Iniciar Sesion</a>';
            }


            unset($_SESSION['subtotal']);

            if (isset($_POST['subtotal'])) {
                $id = $_POST['subtotal'];

                
                
                $subtotal = floatval($id);
                $iva = $subtotal * 0.12;
                $total = $subtotal + $iva;
                $recargo = 0.0;

                $_SESSION['subtotal'] = [
                    'subtotal' => $subtotal,
                    'iva' => $iva,
                    'recargo' => $recargo,
                    'total' => $total
                ];
                
                header('location: proceder-pago.php');
            }

            ?>
        </div>

    </header>
    <section>
    <h3>&nbsp;</h3>
        <div class="contenedorcarro">
            <div class="carro">
                <div class="titulo">
                    
                    <p>Carrito</p>
                </div>
                <div class="contenedor" id="tabla">




                </div>
            </div>
            <div class="lado">
                <div class="pago">
                    <form action="#" method="post">
                        <div class="contenedor" id="subtotal">

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>
    <div style="padding-top:10px">
        <section class="footer">
            <div class="copyright">
                <p>&#169;Papeleria "La 13" todos los derechos reservados 2023</p>
            </div>
        </section>
    </div>
    <script src="carrito.js"></script>
</body>

</html>