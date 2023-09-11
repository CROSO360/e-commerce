

<div class="product">

    <?php
    if ($item['existencia'] == "1") {
        echo '<form action="#" method="post">
        <input type="text" name="idproducto" id="xd" value="'.$item['id'].'" hidden>';
    }
    ?>

    

    <img src="../img/<?php echo $item['imagen'];  ?>" />
    <h2><button style="background: none; color: black; cursor: pointer;" type="submit"><?php echo $item['nombre'];  ?></button></h2>
    <hr>
    <p class="align-items-end">$<?php echo $item['precio'];  ?> </p>

    <?php
    if ($item['existencia'] == "1") {
        echo '</form>';
    }
    ?>

    <?php
    if ($item['existencia'] == "1") {
        echo '
        <div class="botones"><button id="agg" style="cursor:pointer" class="align-items-end">Agregar al carrito</button></div>';
    }else{
        echo '<button class="agotado align-items-end" disabled>Agotado</button>';
    }

    ?>
    
    
</div>

