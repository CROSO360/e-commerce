<?php
include_once '../../lib/db.php';

class Productos extends DB
{

    function __construct()
    {
        parent::__construct();
    }

    public function get($id)
    {
        $query = $this->connect()->prepare('SELECT 
        PRODUCTO.ID_PRODUCTO, 
        CATEGORIA_PRODUCTO.NOMBRE_CATEGORIA, 
        PRODUCTO.NOMBRE_PRODUCTO, 
        PRODUCTO.PRECIO_PRODUCTO,
        PRODUCTO.DESCRIPCION_PRODUCTO,
        PRODUCTO.LIMITE_ITEMS,
        PRODUCTO.EXISTE_PRODUCTO,
        PRODUCTO.IMAGEN_PRODUCTO
        FROM PRODUCTO
        INNER JOIN CATEGORIA_PRODUCTO ON PRODUCTO.ID_PRODUCTO_CATEGORIA = CATEGORIA_PRODUCTO.ID_PRODUCTO_CATEGORIA WHERE ID_PRODUCTO = :id LIMIT 0,12');
        $query->execute(['id' => $id]);

        $row = $query->fetch();

        return [
            'id' => $row['ID_PRODUCTO'],
            'categoria' => $row['NOMBRE_CATEGORIA'],
            'nombre' => $row['NOMBRE_PRODUCTO'],
            'precio' => $row['PRECIO_PRODUCTO'],
            'descripcion' => $row['DESCRIPCION_PRODUCTO'],
            'limite' => $row['LIMITE_ITEMS'],
            'existencia' => $row['EXISTE_PRODUCTO'],
            'imagen' => $row['IMAGEN_PRODUCTO']
        ];
    }


    public function getCategory()
    {
        $query = $this->connect()->prepare('SELECT CATEGORIA_PRODUCTO.ID_PRODUCTO_CATEGORIA, CATEGORIA_PRODUCTO.NOMBRE_CATEGORIA FROM CATEGORIA_PRODUCTO INNER JOIN PRODUCTO ON CATEGORIA_PRODUCTO.ID_PRODUCTO_CATEGORIA = PRODUCTO.ID_PRODUCTO_CATEGORIA GROUP BY CATEGORIA_PRODUCTO.ID_PRODUCTO_CATEGORIA');
        $query->execute();
        $items = [];

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $item = [
                'id' => $row['ID_PRODUCTO_CATEGORIA'],
                'categoria' => $row['NOMBRE_CATEGORIA']
            ];
            array_push($items, $item);
        }

        return $items;

    }


    public function getItemsByCategory($category, $keyPrecio = false)
    {

        if ($keyPrecio) {
            $query = $this->connect()->prepare('SELECT 
            PRODUCTO.ID_PRODUCTO, 
            CATEGORIA_PRODUCTO.NOMBRE_CATEGORIA, 
            PRODUCTO.NOMBRE_PRODUCTO, 
            PRODUCTO.PRECIO_PRODUCTO,
            PRODUCTO.DESCRIPCION_PRODUCTO,
            PRODUCTO.LIMITE_ITEMS,
            PRODUCTO.EXISTE_PRODUCTO,
            PRODUCTO.IMAGEN_PRODUCTO
            FROM PRODUCTO
            INNER JOIN CATEGORIA_PRODUCTO ON PRODUCTO.ID_PRODUCTO_CATEGORIA = CATEGORIA_PRODUCTO.ID_PRODUCTO_CATEGORIA WHERE CATEGORIA_PRODUCTO.ID_PRODUCTO_CATEGORIA = :cat ORDER BY PRECIO_PRODUCTO ' . $keyPrecio . ' LIMIT 0,12');
            $query->execute(['cat' => $category]);
            $items = [];

            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = [
                    'id' => $row['ID_PRODUCTO'],
                    'categoria' => $row['NOMBRE_CATEGORIA'],
                    'nombre' => $row['NOMBRE_PRODUCTO'],
                    'precio' => $row['PRECIO_PRODUCTO'],
                    'descripcion' => $row['DESCRIPCION_PRODUCTO'],
                    'limite' => $row['LIMITE_ITEMS'],
                    'existencia' => $row['EXISTE_PRODUCTO'],
                    'imagen' => $row['IMAGEN_PRODUCTO']
                ];
                array_push($items, $item);
            }
            return $items;
        } else {
            $query = $this->connect()->prepare('SELECT 
            PRODUCTO.ID_PRODUCTO, 
            CATEGORIA_PRODUCTO.NOMBRE_CATEGORIA, 
            PRODUCTO.NOMBRE_PRODUCTO, 
            PRODUCTO.PRECIO_PRODUCTO,
            PRODUCTO.DESCRIPCION_PRODUCTO,
            PRODUCTO.LIMITE_ITEMS,
            PRODUCTO.EXISTE_PRODUCTO,
            PRODUCTO.IMAGEN_PRODUCTO
            FROM PRODUCTO
            INNER JOIN CATEGORIA_PRODUCTO ON PRODUCTO.ID_PRODUCTO_CATEGORIA = CATEGORIA_PRODUCTO.ID_PRODUCTO_CATEGORIA WHERE CATEGORIA_PRODUCTO.ID_PRODUCTO_CATEGORIA = :cat LIMIT 0,12');
            $query->execute(['cat' => $category]);
            $items = [];

            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = [
                    'id' => $row['ID_PRODUCTO'],
                    'categoria' => $row['NOMBRE_CATEGORIA'],
                    'nombre' => $row['NOMBRE_PRODUCTO'],
                    'precio' => $row['PRECIO_PRODUCTO'],
                    'descripcion' => $row['DESCRIPCION_PRODUCTO'],
                    'limite' => $row['LIMITE_ITEMS'],
                    'existencia' => $row['EXISTE_PRODUCTO'],
                    'imagen' => $row['IMAGEN_PRODUCTO']
                ];
                array_push($items, $item);
            }
            return $items;
        }

    }

    //funcion nueva
    public function getAll($keyPrecio = false)
    {

        if ($keyPrecio) {
            $query = $this->connect()->prepare('SELECT 
            PRODUCTO.ID_PRODUCTO, 
            CATEGORIA_PRODUCTO.NOMBRE_CATEGORIA, 
            PRODUCTO.NOMBRE_PRODUCTO, 
            PRODUCTO.PRECIO_PRODUCTO,
            PRODUCTO.DESCRIPCION_PRODUCTO,
            PRODUCTO.LIMITE_ITEMS,
            PRODUCTO.EXISTE_PRODUCTO,
            PRODUCTO.IMAGEN_PRODUCTO
            FROM PRODUCTO
            INNER JOIN CATEGORIA_PRODUCTO ON PRODUCTO.ID_PRODUCTO_CATEGORIA = CATEGORIA_PRODUCTO.ID_PRODUCTO_CATEGORIA ORDER BY EXISTE_PRODUCTO AND PRECIO_PRODUCTO ' . $keyPrecio . ' LIMIT 0,12');
            $query->execute();
            $items = [];

            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = [
                    'id' => $row['ID_PRODUCTO'],
                    'categoria' => $row['NOMBRE_CATEGORIA'],
                    'nombre' => $row['NOMBRE_PRODUCTO'],
                    'precio' => $row['PRECIO_PRODUCTO'],
                    'descripcion' => $row['DESCRIPCION_PRODUCTO'],
                    'limite' => $row['LIMITE_ITEMS'],
                    'existencia' => $row['EXISTE_PRODUCTO'],
                    'imagen' => $row['IMAGEN_PRODUCTO']
                ];
                array_push($items, $item);
            }
            return $items;
        } else {
            $query = $this->connect()->prepare('SELECT 
            PRODUCTO.ID_PRODUCTO, 
            CATEGORIA_PRODUCTO.NOMBRE_CATEGORIA, 
            PRODUCTO.NOMBRE_PRODUCTO, 
            PRODUCTO.PRECIO_PRODUCTO,
            PRODUCTO.DESCRIPCION_PRODUCTO,
            PRODUCTO.LIMITE_ITEMS,
            PRODUCTO.EXISTE_PRODUCTO,
            PRODUCTO.IMAGEN_PRODUCTO
            FROM PRODUCTO
            INNER JOIN CATEGORIA_PRODUCTO ON PRODUCTO.ID_PRODUCTO_CATEGORIA = CATEGORIA_PRODUCTO.ID_PRODUCTO_CATEGORIA LIMIT 0,12');
            $query->execute();
            $items = [];

            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $item = [
                    'id' => $row['ID_PRODUCTO'],
                    'categoria' => $row['NOMBRE_CATEGORIA'],
                    'nombre' => $row['NOMBRE_PRODUCTO'],
                    'precio' => $row['PRECIO_PRODUCTO'],
                    'descripcion' => $row['DESCRIPCION_PRODUCTO'],
                    'limite' => $row['LIMITE_ITEMS'],
                    'existencia' => $row['EXISTE_PRODUCTO'],
                    'imagen' => $row['IMAGEN_PRODUCTO']
                ];
                array_push($items, $item);
            }
            return $items;
        }


    }

}

?>