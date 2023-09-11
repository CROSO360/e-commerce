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
                <li><a href="carrito.php"><i style="font-size: 20px;" class="fa-solid fa-cart-shopping"></i>
      </a></li>
            </ul>
            <!-- log-in button -->
            <?php
            session_start();
            //unset($_SESSION['orden']);
            if (isset($_SESSION['usuario'])) {
                $respuesta = json_decode($_SESSION['usuario']);

                echo "<div style='margin-left:10px'>Bienvenido ".$respuesta->nombre." ".$respuesta->apellido."</div><br>

                <a href='logout.php' class='btn'>Cerrar Sesión</a>
                
                ";
            }else{
                echo '<a href="../login" class="btn">Iniciar Sesion</a>';
            }
            ?>
        </div>
    
    </header>
    <p>&nbsp;</p>


    <?php


    if ($_SESSION['producto']) {

        $id = $_SESSION['producto'];

        $str = 'http://localhost:8081/croso3/api/productos/api-productos.php?get-item='.$id.'';

        $response = json_decode(file_get_contents($str), true);
        if ($response['statuscode'] == 200) {

            include_once('../layout/detalle.php');

            //echo $response['item']['id'];
            
        } else {
            echo $response['response'];
        }

    }else{
        header('location: index.php');
    }

    
    ?>



    <div class="d-flex flex-column mb-3">
        <div class="suge">
            <p>Carrito de Compras: </p>
        </div>
        <div class="container articulos">
            <div class="sugerencias" >
                <div class="encierro" id="tabla"> 
                
                </div>
            </div>
        </div>
    </div>
    <div style="padding-top:10px">
        <section class="footer">
            <div class="copyright">
              <p>&#169;Papeleria "La 13" todos los derechos reservados 2023</p>
            </div>
          </section>
     </div>
     <script src="detalle_producto.js"></script>
</body>

</html>