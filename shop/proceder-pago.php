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
            <a href="../index.php" class="logo">
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

            </ul>
            <!-- log-in button -->

            <?php


            include_once "../lib/db.php";
            include_once '../api/orden/orden.php';

            session_start();



            if (isset($_SESSION['usuario'])) {
                if (isset($_SESSION['carrito']) && $_SESSION['carrito'] != '[]') {

                    if (isset($_SESSION['subtotal'])) {


                        if (isset($_SESSION['usuario'])) {
                            $respuesta = json_decode($_SESSION['usuario']);

                            echo "<div style='margin-left:10px'>Bienvenido " . $respuesta->nombre . " " . $respuesta->apellido . "</div><br>

                            <a href='logout.php' class='btn'>Cerrar Sesión</a>
                            
                            ";
                        } else {
                            echo '<a href="../login" class="btn">Iniciar Sesion</a>';
                        }



                        //<h2 id="1.5">Subtotal: $1.5</h2>
            
                        /*$id_carrito = $ord->CreaCarrito($usuario);
                        
                        $id_orden = $ord->CreaOrdenCompra($id_carrito);
                        
                        echo $id_orden;*/

                        /*$datos_orden = $ord->GetOrdenValue($ord->CreaOrdenCompra($ord->CreaCarrito($usuario)));
                        
                        $_SESSION['orden'] = json_encode($datos_orden);
                        
                        $orden_compra = json_decode($_SESSION['orden']);
                        
                        $ord->Detalle($orden_compra, $carrito);
                        
                        $datos_orden_act = $ord->Actualiza_Total_OC($orden_compra);
                        
                        $_SESSION['orden'] = json_encode($datos_orden_act);
                        
                        echo $_SESSION['orden'];*/





                    } else {
                        header('location: carrito.php');
                    }


                } else {
                    header('location: index.php');
                }
            } else {
                header('location: ../login');
            }



            ?>
        </div>
    </header>
    <section>

        <?php


        if (isset($_POST['direccion']) != null && isset($_POST['pago']) != null && isset($_POST['telefono2']) != null) {

            $direccion = $_POST['direccion'];
            $pago = $_POST['pago'];
            $telefono = $_POST['telefono2'];

            if ($pago == 'deuna') {
                $id_pago = '1';
            } elseif ($pago == 'transferencia') {
                $id_pago = '2';
            }

            if ($direccion != '' && $pago != '' && $telefono != '') {

                $_SESSION['final'] = [
                    'direccion' => $direccion,
                    'pago' => $pago,
                    'telefono' => $telefono
                ];

                //$recargo = 0.0;
        
                if ($direccion == 'delivery' && /*isset($_POST['nombre2']) && isset($_POST['apellidos2']) && isset($_POST['telefono2'])*/isset($_POST['calle2']) && isset($_POST['avenida2']) && isset($_POST['referencia2'])) {

                    /*$nombre2 = $_POST['nombre2'];
                    $apellidos2 = $_POST['apellidos2'];*/
                    //$telefono2 = $_POST['telefono2'];
                    $calle2 = $_POST['calle2'];
                    $avenida2 = $_POST['avenida2'];
                    $referencia2 = $_POST['referencia2'];

                    $direccionWase = $calle2 . ' ' . $avenida2 . ' Referencia: ' . $referencia2;

                    $recargo = 3.0;

                    $_SESSION['subtotal']['recargo'] = $recargo;
                    $_SESSION['subtotal']['total'] += $recargo;

                    if ( /*$nombre2 != '' && $apellidos2 != '' && $telefono2 != '' &&*/$calle2 != '' && $avenida2 != '' && $referencia2 != '') {
                        $_SESSION['delivery'] = [
                            /*'nombre' => $nombre2,
                            'apellido' => $apellidos2,*/
                            //'telefono' => $telefono2,
                            'calle' => $calle2,
                            'avenida' => $avenida2,
                            'referencia' => $referencia2
                        ];
                    } else {
                        /*echo '<br>incompleto';
                        echo '<br>incompleto';
                        echo '<br>incompleto';
                        echo '<br>incompleto';
                        echo '<br>incompleto';*/
                    }

                }

                $ord = new Orden;
                $usuario = json_decode($_SESSION['usuario']);
                $carrito = json_decode($_SESSION['carrito']);
                $id_carrito = $ord->CreaCarrito($usuario);
                if ($direccion == 'delivery') {
                    $id_orden_compra = $ord->CreaOrdenCompra($id_carrito, $id_pago, $telefono, 'DELIVERY', $_SESSION['subtotal']['subtotal'], $_SESSION['subtotal']['iva'], $_SESSION['subtotal']['total'], $_SESSION['subtotal']['recargo'], $direccionWase);
                } elseif ($direccion == 'pickup') {
                    $id_orden_compra = $ord->CreaOrdenCompra($id_carrito, $id_pago, $telefono, 'PICKUP', $_SESSION['subtotal']['subtotal'], $_SESSION['subtotal']['iva'], $_SESSION['subtotal']['total']);
                }
                $datos_orden = $ord->GetOrdenValue($id_orden_compra);
                $_SESSION['orden'] = json_encode($datos_orden);
                $orden_compra = json_decode($_SESSION['orden']);
                $ord->Detalle($orden_compra, $carrito);

                header('location: final.php');


            } else {
                /*echo "no";
                echo "<br>";
                echo "no";
                echo "<br>";
                echo "no";
                echo "<br>";
                echo "no hay telefono";
                echo "<br>";*/
            }



        } else {
            /*echo "no";
            echo "<br>";
            echo "no";
            echo "<br>";
            echo "no";
            echo "<br>";
            echo "no hay telefono";
            echo "<br>";*/


        }


        ?>


        <div class="contenedorcarro">
            <div class="carro">
                <div class="titulo" style="font-size: 10px;">
                    <p id="wase"></p>
                </div>


                <div class="acordeon">
                    <div class="acorden__item" id="arquitecturaitem">
                        <input type="radio" name="acordeon" id="item1">
                        <label for="item1" class="acordeon__titulo">1 Dirección de envío</label>

                        <div style="display: flex; flex-direction: column;" class="acordeon__contenido">
                            <div class="form-input" style="margin-left:25px">
                                <div class="form-floating mb-3 " style="display: flex; flex-direction: column;">
                                    <label for="telefono">Ingresa tu número de Teléfono:</label>
                                    <input type="text" class="form-control" id="telefono" placeholder="Ej: 0985959365"
                                        name="telefono">

                                </div>
                            </div>
                            <div style="font-size: 25px; font-weight: bold; margin-left: 25px;">
                                Selecciona:
                            </div>
                            <div class="metodo">
                                <div style="margin-left: 20px">
                                    <button id="delivery"><img src="../img/images/delivery.png" width="200"
                                            height="150"></button>
                                </div>
                                <div style="margin: 20px">
                                    <button id="pickup"><img src="../img/images/pickup.png" width="200"
                                            height="150"></button>
                                </div>
                            </div>
                            <div>

                            </div>
                            <div style="padding-left: 25px;">
                                Usted seleccionó: <span id="respuestadireccion"></span>
                            </div>
                            <div class="formulario" id="formulario">
                                <div class="form">
                                    <h1>Registrar Ubicación</h1>
                                    <div class="form-input">
                                        <!--form class="form-input" action="#" method="post"-->



                                        <div class="form-floating mb-3" style="display: flex; flex-direction: column;">
                                            <label for="calle">Calle</label>
                                            <input type="text" class="form-control" id="calle"
                                                placeholder="Ej: Calle 13" name="calle">

                                        </div>
                                        <div class="form-floating mb-3" style="display: flex; flex-direction: column;">
                                            <label for="avenida">Avenida</label>
                                            <input type="text" class="form-control" id="avenida"
                                                placeholder="Ej: Avenida 4-6" name="avenida">
                                        </div>
                                        <div class="form-floating mb-3" style="display: flex; flex-direction: column;">
                                            <label for="referencia">Referencia</label>
                                            <input type="text" class="form-control" id="referencia"
                                                placeholder="Ej: Diagonal a la Iglesia La Merced" name="referencia">

                                        </div>
                                        <!--/form-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="acorden__item" id="arquitecturaitem">
                        <input type="radio" name="acordeon" id="item2">
                        <label for="item2" class="acordeon__titulo">2 Método de pago</label>
                        <div class="acordeon__contenido">
                            <div style="font-size: 25px; font-weight: bold; margin-left: 25px;">
                                Paga con:
                            </div>
                            <div class="metodo">
                                <div style="margin: 20px">

                                    <button id="deuna"><img src="../img/images/deuna.png" width="200"
                                            height="150"></button>
                                </div>
                                <div style="margin: 20px">
                                    <button id="transferencia"><img src="../img/images/Transferencia.png" width="200"
                                            height="150"></button>
                                </div>
                            </div>
                            <div>

                            </div>
                            <div style="padding-left: 25px;">
                                Usted seleccionó: <span id="respuestapago"></span>
                            </div>
                        </div>
                    </div>
                    <div class="acorden__item" id="arquitecturaitem">
                        <input type="radio" name="acordeon" id="item3">
                        <label for="item3" class="acordeon__titulo">3 Revisar los artículos</label>
                        <div class="acordeon__contenido">
                            <div class="contenedor" id="tabla">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lado">
                <div class="pago">
                    <div class="contenedor">
                        <form action="#" method="post">
                            <button class="finaliza" id="finaliza" type="submit" name="finaliza">Finalizar
                                Compra</button>
                            
                            <input type="text" id="direccion" name="direccion" value="" hidden>
                            <input type="text" id="pago" name="pago" value="" hidden>


                            <!--input type="text" id="nombre2" name="nombre2" value="">
                            <input type="text" id="apellidos2" name="apellidos2" value=""-->
                            <input type="text" id="telefono2" name="telefono2" value="" hidden>
                            <input type="text" id="calle2" name="calle2" value="" hidden>
                            <input type="text" id="avenida2" name="avenida2" value="" hidden>
                            <input type="text" id="referencia2" name="referencia2" value="" hidden>


                            <?php



                            ?>
                            <a></a>

                            <div class="paga">
                                <h2>Confirmación del pedido</h2>
                                <!--Suma el subtotal mas el iva y saca el 3%-->
                                <p>Subtotal: $<a id="sub"><?php echo $_SESSION['subtotal']['subtotal']; ?></a></p>
                                <p>Iva (12%): $<a id="iva">
                                        <?php echo $_SESSION['subtotal']['iva']; ?>
                                    </a></p>
                                <p>Recargo por envío: $<a id="recargo">
                                        <?php echo $_SESSION['subtotal']['recargo']; ?>
                                    </a></p>
                                <hr>
                                <h3 style="color: red;">Total del pedido: $<a id="total">
                                        <?php echo $_SESSION['subtotal']['total']; ?>
                                    </a></h3>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!--div style="padding-top:10px; position: absolute; bottom: 0; width: 100%;">
        <section class="footer">
            <div class="copyright">
                <p>&#169;Papeleria "La 13" todos los derechos reservados 2023</p>
            </div>
        </section>
    </div-->
    <script src="proceder_pago.js"></script>
</body>

</html>