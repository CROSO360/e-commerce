<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="css/all.min.css">
    <script src="final.js"></script>
    <title>Document</title>
</head>

<body>
    <?php

    include_once '../api/orden/orden.php';

    session_start();

    unset($_SESSION['carrito']);

    $id_orden = null;

    foreach (json_decode($_SESSION['orden']) as $valores => $valor) {
        if ($valores == 'id') {
            $id_orden = $valor;
        }
    }

    $ord = new Orden;

    $detalleProductos = json_encode(['items' => $ord->GetDetalleProductos($id_orden)]);
    $datosCliente = $ord->GetDatosDelCliente($id_orden);
    $infoExtra = $ord->GetInfoExtra($id_orden);


    /*echo $detalleProductos;
    echo '<br>';
    echo implode($datosCliente);
    echo '<br>';
    echo implode($infoExtra);*/

    ?>

    <div class="final">
        <div class="titulo">
            <h1>PAPELERÍA LA 13</h1>
        </div>
        <div class="aviso">
            <h1>Aviso:</h1>
            <p>Te recomendamos no cerrar esta página hasta culminar el proceso de la compra, o captura la información
                necesaria.</p>
        </div>
        <div class="metodospago">
            <h3>Importante:</h1>
                <p>Para completar con la compra debes de realizar el pago según lo seleccionado en la orden de
                    compra. Al recibir tu compra debes presentar el comprobante que podrás capturar al final de esta
                    página.</p>
                <div>
                    <div class="pago">
                        <?php
                        if ($datosCliente['metodo_pago'] == '1') {
                            echo '<div class="logo" style="margin: 15px;">
                            <img src="../img/images/deuna.png">

                        </div>
                        <div class="qr" style="margin: 15px;">
                            <img src="../img/images/qrdeuna.png">

                        </div>
                        <div style="display: flex; flex-direction: column; margin-top: 15px; margin-left: 40px;">
                            <h2>Escanéa el código y paga</h2>
                            <p>1. Entra a la app y elige pagar.</p>
                            <p>2. Escanea el código QR.</p>
                            <p>3. Ingresa el monto total y confirma el pago.</p>
                        </div>';
                        } elseif ($datosCliente['metodo_pago'] == '2') {
                            echo '<div style="margin: 15px;">
                            <img src="../img/images/Transferencia.png" width="150" height="150">

                        </div>
                        <div style="display: flex; flex-direction: column; margin-top: 15px; margin-left: 40px;">
                            <h2>Banco Pichincha</h2>
                            <h5>Ahorro</h5>
                            <p>No de Cuenta: 2206971885</p>
                            <p>Nombre: Andrade Cedeño Zindy Xavier</p>
                            <p>Correo: mijavi1974@yahoo.com</p>
                        </div>
                        <div style="display: flex; flex-direction: column; margin-top: 15px; margin-left: 40px;">
                            <h2>Banco Guayaquil</h2>
                            <h5>Corriente</h5>
                            <p>No de Cuenta: 0014082433</p>
                            <p>Nombre: Andrade Cedeño Zindy Xavier</p>
                            <p>Correo: mijavi1974@yahoo.com</p>
                        </div>';
                        }
                        ?>


                    </div>
                </div>
                
                <p>Ponte en contacto con nosotros para validar su pago <a href="https://api.whatsapp.com/send?phone=+593993444176&text=Hola,+realice+una+compra+en+su+página+web.+Aquí+mi+comprobante+de+pago.& " target="_blank">aquí</a> y proceder a la entrega de su
                    compra.</p>
        </div>
        <div class="comprobante">
            <h2>Comprobante: Compra No. <?php echo $infoExtra['id']; ?></h2>
            <div style="display: flex; flex-direction: row; ">
                <div class="cliente" style="border: 1px solid black;padding-left: 10px;width: 50%;">
                    <h3>Datos del Cliente</h3>
                    <div class="info">
                        <div style="width: 50%;">
                            <div>Nombre: <?php echo $datosCliente['nombre']; ?></div>
                            <div>Cedula: <?php echo $datosCliente['cedula']; ?></div>
                        </div>
                        <div style="width: 50%;">
                            <p>Apellido: <?php echo $datosCliente['apellido']; ?></p>
                            <p>Telefono: <?php echo $datosCliente['telefono']; ?></p>
                        </div>
                    </div>
                    Correo: <?php echo $datosCliente['correo']; ?>

                </div>
                <div
                    style="display: none; width: 50%; border: 1px solid black; display: flex; flex-direction: column;padding-left: 10px;">
                    
                    <?php 
                    if ($infoExtra['direccion'] == 'No hay direccion') {
                        echo '<h3>Dirección (Escogiste recoger tu pedido en el local)</h3>';
                    
                        echo '
                        LA 13<br>
                        Calle 13 entre Avenidas 4 y 6<br>
                        Referencia: Diagonal a la Iglesia "La Merced"';
                    }else{
                        echo '<h3>Dirección de entrega</h3>';
                        echo $infoExtra['direccion'];
                    }
                    ?>
                </div>
            </div>
            <div style="display: flex; flex-direction: column;">
                <h3 style="margin-left: 15px;">Productos</h3>
                <table style="border: 1px solid black;">
                    <tr style="border: 1px solid black;">
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Precio Total</th>
                    </tr>

                    <?php

                    $obj = json_decode($detalleProductos, true);

                    foreach ($obj['items'] as $item) {
                        echo '
                        <tr>
                            <td>'.$item['nombre'].'</td>
                            <td>'.$item['cantidad'].'</td>
                            <td>$'.$item['punitario'].'</td>
                            <td>$'.$item['ptotal'].'</td>
                        </tr>
                        ';
                    }
                    
                    ?>
                    
                </table>
            </div>
            <div style=" display: flex; flex-direction: column; align-items: flex-end;">

                <table style="width: 40%; border: 1px solid black;">
                    <tr style="border: 1px solid black;">
                        <th>Subtotal</th>
                        <td>$<?php echo $infoExtra['subtotal']; ?></td>
                    </tr>
                    <tr>
                        <th>Iva (12%)</th>
                        <td>$<?php echo $infoExtra['iva']; ?></td>
                    </tr>
                    <tr>
                        <th>Recargo por envío</th>
                        <td>$<?php echo $infoExtra['recargo']; ?></td>
                    </tr>
                    <tr>
                        <th>Total a Pagar</th>
                        <th>$<?php echo $infoExtra['total']; ?></th>
                    </tr>
                </table>
            </div>
            <button id="imprimir-boton">Imprimir</button>
            <a href="index.php">Volver a la tienda</a>
        </div>
    </div>

    <script src="final.js"></script>
</body>

</html>