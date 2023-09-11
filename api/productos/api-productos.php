<?php

include_once 'productos.php';

if(isset($_GET['categoria'])){
    $categoria = $_GET['categoria'];
    
    if($categoria == ''){
        echo json_encode(['statuscode' => 400, 
                            'response' => 'No existe la categor&iacute;a']);    
    }else{
        $productos = new Productos();
        $items = $productos->getItemsByCategory($categoria);
        echo json_encode(['statuscode' => 200, 
                        'items' => $items]);
    }

}else if(isset($_GET['categoria-asc'])){
    $categoria = $_GET['categoria-asc'];
    
    if($categoria == ''){
        echo json_encode(['statuscode' => 400, 
                            'response' => 'No existe la categor&iacute;a']);    
    }else{
        $productos = new Productos();
        $items = $productos->getItemsByCategory($categoria,'ASC');
        echo json_encode(['statuscode' => 200, 
                        'items' => $items]);
    }
}else if(isset($_GET['categoria-desc'])){
    $categoria = $_GET['categoria-desc'];
    
    if($categoria == ''){
        echo json_encode(['statuscode' => 400, 
                            'response' => 'No existe la categor&iacute;a']);    
    }else{
        $productos = new Productos();
        $items = $productos->getItemsByCategory($categoria,'DESC');
        echo json_encode(['statuscode' => 200, 
                        'items' => $items]);
    }
}else if(isset($_GET['get-item'])){
    $id = $_GET['get-item'];

    if($id == ''){
        echo json_encode(['statuscode' => 400, 
                            'response' => 'No hay valor para id']);    
    }else{
        $productos = new Productos();
        $item = $productos->get($id);
        echo json_encode(['statuscode' => 200, 
                        'item' => $item]);
    }

}else if(isset($_GET['get-all'])){
    $productos = new Productos();
    $items = $productos->getAll();
    echo json_encode([
        'statuscode' => 200,
        'items' => $items
    ]);

}else if(isset($_GET['get-all-asc'])){
    $productos = new Productos();
    $items = $productos->getAll('ASC');
    echo json_encode([
        'statuscode' => 200,
        'items' => $items
    ]);

}else if(isset($_GET['get-all-desc'])){
    $productos = new Productos();
    $items = $productos->getAll('DESC');
    echo json_encode([
        'statuscode' => 200,
        'items' => $items
    ]);

}else if(isset($_GET['get-category'])){
    $productos = new Productos();
    $items = $productos->getCategory();
    echo json_encode([
        'statuscode' => 200,
        'items' => $items
    ]);
}else{
    echo json_encode(['statuscode' => 404, 
                        'response' => 'No se puede procesar la solicitud']);
}

?>