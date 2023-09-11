<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="all.min.css" />

    <link rel="shortcut icon" href="../images/icon.svg" />
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
                <li><a href="shop/carrito.php"><i style="font-size: 20px;" class="fa-solid fa-cart-shopping"></i>
                    </a></li>
            </ul>
            <!-- log-in button -->
            <?php
            session_start();
            //unset($_SESSION['orden']);
            if (isset($_SESSION['usuario'])) {
                $respuesta = json_decode($_SESSION['usuario']);

                echo "<div style='margin-left:10px'>Bienvenido " . $respuesta->nombre . " " . $respuesta->apellido . "</div><br>

                <a href='logout.php' class='btn'>Cerrar Sesión</a>
                
                ";
            } else {
                echo '<a href="../login" class="btn">Iniciar Sesion</a>';
            }
            ?>

        </div>

    </header>
    <h1 id="productos">&nbsp;</h1><br>
    <p>&nbsp;</p>
    <div class="fondo" id="fondo">
        <div class="titulo">
            <h4>&nbsp;</h4>
            <h1>Productos</h1>
        </div>

        <h5>Buscador avanzado <!--a href=""><i class="fa-solid fa-magnifying-glass-plus"></i></a>&nbsp;&nbsp;
        <a href=""><i class="fa-solid fa-rotate-right"></i></a--></h5>

        <div class="buscador">
            <!--div>
                <div>
                    Ordenado por:
                </div>
                <div class="filtro">
                    <button>Precio Mayor</button><button>Precio Menor</button><button>Nombre:
                        A-Z</button><button>Nombre: Z-A</button>
                </div>
            </div-->
            <div>
                <div>
                    Ordenar por categoría:
                </div>
                <div class="filtro">
                    <a href="index.php">Todo</a>

                    <!--button class="categoria">Todo</button-->

                    <?php

                    $response = json_decode(file_get_contents('http://localhost:8081/croso3/api/productos/api-productos.php?get-category'), true);
                    if ($response['statuscode'] == 200) {
                        foreach ($response['items'] as $item) {
                            //echo '<option value="'.$item['id'].'">'.$item['categoria'].'</option>';
                            echo '<a href="cat' . $item['id'] . '.php">' . $item['categoria'] . '</a>
                            <!--button class="categoria">' . $item['categoria'] . '</button-->';
                        }
                    } else {
                        echo $response['response'];
                    }

                    ?>

                </div>
            </div>
        </div>

        <div class="contenedor" id="cont">

            <?php



            unset($_SESSION['producto']);

            //unset($_SESSION['pcarro']);
            
            if (isset($_POST['idproducto'])) {
                $id = $_POST['idproducto'];
                $_SESSION['producto'] = $id;
                header('location: detalle_producto.php');
            }

            /*if (isset($_POST['idproducto_carrito'])) {
            $idc = $_POST['idproducto_carrito'];
            $_SESSION['pcarro'] = $idc;
            echo $_SESSION['pcarro'];
            }*/

            $response = json_decode(file_get_contents('http://localhost:8081/croso3/api/productos/api-productos.php?categoria=3'), true);
            if ($response['statuscode'] == 200) {
                foreach ($response['items'] as $item) {
                    include('../layout/items.php');
                }
            } else {
                echo $response['response'];
            }

            ?>

        </div>
    </div>
    <div class="banner">
        <div class="sidebar">
            <div class='contiene' id="tabla">




            </div>
        </div>
    </div>
    <!-- Footer -->
    <div style="padding-top:10px">
        <section class="footer">
            <div class="copyright">
                <p>&#169;Papeleria "La 13" todos los derechos reservados 2023</p>
            </div>
        </section>
    </div>
    <!--script src="wase.js"></script-->
    <script src="inicio.js"></script>
</body>

</html>