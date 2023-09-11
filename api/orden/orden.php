<?php

include_once '../lib/db.php';

class Orden extends DB
{
    function __construct()
    {
        parent::__construct();
    }


    public function CreaCarrito($sesion_usuario)
    {

        foreach ($sesion_usuario as $valores => $valor) {
            if ($valores == 'id') {
                $id_user = $valor;
            }
        }

        $conn = $this->connect();

        $query = $conn->prepare(

            'INSERT INTO CARRITO_COMPRA (`ID_CARRITO_COMPRA`, `ID_CLIENTE`, `ESTADO_CARRITO_COMPRA`) VALUES (NULL,:idcliente,"PENDIENTE");'

        );

        $query->execute(['idcliente' => $id_user]);

        $id_carrito = $conn->lastInsertId();

        return $id_carrito;
    }



    public function CreaOrdenCompra($id_carrito, $id_metodoPago, $telefono, $tipoEntrega, $subtotal, $iva, $total, $recargo = false, $direccion = false)
    {

        $conn = $this->connect();

        if ($recargo) {
            $query = $conn->prepare(

                'INSERT INTO ORDEN_COMPRA(
                    `ID_ORDEN_COMPRA`,
                    `ID_CARRITO_COMPRA`,
                    `ID_METODO_PAGO`,
                    `TELEFONO`,
                    `TIPO_ENTREGA`,
                    `DIRECCION`,
                    `SUBTOTAL_ORDEN_COMPRA`,
                    `RECARGO`,
                    `IVA_ORDEN_COMPRA`,
                    `TOTAL_ORDEN_COMPRA`,
                    `ESTADO_ORDEN`) 
                VALUES(
                    NULL, :idcarrito, :metodoPago, :telefono, :tipoEntrega, :direccion, :subtotal, :recargo, :iva, :total, "PENDIENTE"
                );'

            );

            $query->execute(['idcarrito' => $id_carrito, 'metodoPago' => $id_metodoPago, 'telefono' => $telefono, 'tipoEntrega' => $tipoEntrega, 'direccion' => $direccion, 'subtotal' => $subtotal, 'iva' => $iva, 'total' => $total, 'recargo' => $recargo]);

            $id_orden = $conn->lastInsertId();

            return $id_orden;

        } else {

            $query = $conn->prepare(

                'INSERT INTO ORDEN_COMPRA(
                    `ID_ORDEN_COMPRA`,
                    `ID_CARRITO_COMPRA`,
                    `ID_METODO_PAGO`,
                    `TELEFONO`,
                    `TIPO_ENTREGA`,
                    `SUBTOTAL_ORDEN_COMPRA`,
                    `IVA_ORDEN_COMPRA`,
                    `TOTAL_ORDEN_COMPRA`,
                    `ESTADO_ORDEN`) 
                VALUES(
                    NULL, :idcarrito, :metodoPago, :telefono, :tipoEntrega, :subtotal, :iva, :total, "PENDIENTE"
                );'

            );

            $query->execute(['idcarrito' => $id_carrito, 'metodoPago' => $id_metodoPago, 'telefono' => $telefono, 'tipoEntrega' => $tipoEntrega, 'subtotal' => $subtotal, 'iva' => $iva, 'total' => $total]);

            $id_orden = $conn->lastInsertId();

            return $id_orden;
        }

    }


    public function GetOrdenValue($id_orden)
    {

        $conn = $this->connect();

        $query = $conn->prepare('SELECT * FROM ORDEN_COMPRA WHERE ID_ORDEN_COMPRA = :idorden');

        $query->execute(['idorden' => $id_orden]);

        $row = $query->fetch();

        if ($row) {
            return [
                'id' => $row['ID_ORDEN_COMPRA'],
                'idCarrito' => $row['ID_CARRITO_COMPRA'],
                'idMetodoPago' => $row['ID_METODO_PAGO'],
                'telefono' => $row['TELEFONO'],
                'tipoEntrega' => $row['TIPO_ENTREGA'],
                'fecha' => $row['FECHA'],
                'direccion' => $row['DIRECCION'],
                'subtotal' => $row['SUBTOTAL_ORDEN_COMPRA'],
                'recargo' => $row['RECARGO'],
                'iva' => $row['IVA_ORDEN_COMPRA'],
                'total' => $row['TOTAL_ORDEN_COMPRA'],
                'estado' => $row['ESTADO_ORDEN']
            ];
        } else {
            return null;
        }

        //FALTA RETURN!!!

    }



    public function Detalle($sesion_orden, $sesion_carrito)
    {

        //catch el id de la orden
        $id_orden = null;

        foreach ($sesion_orden as $valores => $valor) {
            if ($valores == 'id') {
                $id_orden = $valor;
            }
        }


        $id_prod = null;
        $cantidad = null;

        foreach ($sesion_carrito as $items => $value) {


            foreach ($value as $item => $valor) {


                if ($item == 'id') {
                    $id_prod = $valor;
                } elseif ($item == 'cantidad') {
                    $cantidad = $valor;
                }

            }

            for ($i = 0; $i < $cantidad; $i++) {

                $query = $this->connect()->prepare('

                    INSERT INTO DETALLE_ORDEN_COMPRA (ID_DETALLE_ORDEN_COMPRA, ID_PRODUCTO, ID_ORDEN_COMPRA) 
                    VALUES (NULL, :idprod, :idorden);

                ');

                $query->execute(['idprod' => $id_prod, 'idorden' => $id_orden]);

            }

        }

        //FALTA RETURN?!!!

    }



    public function GetDetalleProductos($id_orden)
    {
        $conn = $this->connect();

        $query = $conn->prepare("SELECT PRODUCTO.NOMBRE_PRODUCTO, COUNT(DETALLE_ORDEN_COMPRA.ID_PRODUCTO) AS 'CANTIDAD', MAX(PRODUCTO.PRECIO_PRODUCTO) AS 'PUNITARIO', SUM(PRODUCTO.PRECIO_PRODUCTO) AS 'PTOTAL' FROM PRODUCTO
        INNER JOIN DETALLE_ORDEN_COMPRA ON PRODUCTO.ID_PRODUCTO = DETALLE_ORDEN_COMPRA.ID_PRODUCTO
        WHERE DETALLE_ORDEN_COMPRA.ID_ORDEN_COMPRA = :idorden
        GROUP BY DETALLE_ORDEN_COMPRA.ID_PRODUCTO");

        $query->execute(['idorden' => $id_orden]);

        $items = [];

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $item = [
                'nombre' => $row['NOMBRE_PRODUCTO'],
                'cantidad' => $row['CANTIDAD'],
                'punitario' => $row['PUNITARIO'],
                'ptotal' => $row['PTOTAL']
            ];
            array_push($items, $item);
        }

        return $items;

    }

    public function GetDatosDelCliente($id_orden)
    {
        $conn = $this->connect();

        $query = $conn->prepare("SELECT CLIENTE.NOMBRE_CLIENTE, CLIENTE.APELLIDO_CLIENTE, CLIENTE.CEDULA_CLIENTE, CLIENTE.CORREO_CLIENTE, ORDEN_COMPRA.ID_METODO_PAGO, ORDEN_COMPRA.TELEFONO FROM CLIENTE
        INNER JOIN CARRITO_COMPRA ON CLIENTE.ID_CLIENTE = CARRITO_COMPRA.ID_CLIENTE
        INNER JOIN ORDEN_COMPRA ON ORDEN_COMPRA.ID_CARRITO_COMPRA = CARRITO_COMPRA.ID_CARRITO_COMPRA
        WHERE ORDEN_COMPRA.ID_ORDEN_COMPRA = :idorden
        ");

        $query->execute(['idorden' => $id_orden]);

        $row = $query->fetch();

        return [
            'nombre' => $row['NOMBRE_CLIENTE'],
            'apellido' => $row['APELLIDO_CLIENTE'],
            'cedula' => $row['CEDULA_CLIENTE'],
            'correo' => $row['CORREO_CLIENTE'],
            'metodo_pago' => $row['ID_METODO_PAGO'],
            'telefono' => $row['TELEFONO']
        ];

    }

    public function GetInfoExtra($id_orden)
    {
        //
        $conn = $this->connect();

        $query = $conn->prepare("SELECT ID_ORDEN_COMPRA, DIRECCION, SUBTOTAL_ORDEN_COMPRA, IVA_ORDEN_COMPRA, RECARGO, TOTAL_ORDEN_COMPRA FROM ORDEN_COMPRA WHERE ID_ORDEN_COMPRA = :idorden");

        $query->execute(['idorden' => $id_orden]);

        $row = $query->fetch();

        return [
            'id' => $row['ID_ORDEN_COMPRA'],
            'direccion' => $row['DIRECCION'],
            'subtotal' => $row['SUBTOTAL_ORDEN_COMPRA'],
            'iva' => $row['IVA_ORDEN_COMPRA'],
            'recargo' => $row['RECARGO'],
            'total' => $row['TOTAL_ORDEN_COMPRA']
        ];
    }


/*public function Actualiza_Total_OC($sesion_orden){
//catch el id de la orden
$id_orden = null;
foreach($sesion_orden as $valores=>$valor){
if ($valores == 'id') {
$id_orden = $valor;
}
}
$query = $this->connect()->prepare('
SET @subtotal = NULL;
SET @iva = NULL;
SET @total = NULL;
SELECT @subtotal := SUM(PRODUCTO.PRECIO_PRODUCTO) FROM PRODUCTO 
INNER JOIN DETALLE_ORDEN_COMPRA ON PRODUCTO.ID_PRODUCTO = DETALLE_ORDEN_COMPRA.ID_PRODUCTO
WHERE DETALLE_ORDEN_COMPRA.ID_ORDEN_COMPRA = :idorden;
SET @iva = @subtotal * 0.12;
SET @total = @subtotal + @iva;
UPDATE ORDEN_COMPRA SET SUBTOTAL_ORDEN_COMPRA = @subtotal, IVA_ORDEN_COMPRA = @iva, TOTAL_ORDEN_COMPRA = @total WHERE ID_ORDEN_COMPRA = :idorden;
');
$query->execute(['idorden' => $id_orden]);
$query2 = $this->connect()->prepare(
'SELECT * FROM ORDEN_COMPRA WHERE ID_ORDEN_COMPRA = :idorden'
);
$query2->execute(['idorden' => $id_orden]);
$row = $query2->fetch();
if ($row) {
return [
'id' => $row['ID_ORDEN_COMPRA'],
'idCarrito' => $row['ID_CARRITO_COMPRA'],
'idMetodoPago' => $row['ID_METODO_PAGO'],
'subtotal' => $row['SUBTOTAL_ORDEN_COMPRA'],
'descuento' => $row['DESCUENTO'],
'iva' => $row['IVA_ORDEN_COMPRA'],
'total' => $row['TOTAL_ORDEN_COMPRA'],
'estado' => $row['ESTADO_PAGO']
];
}else{
return 'valio verga';
}
}*/



}


?>