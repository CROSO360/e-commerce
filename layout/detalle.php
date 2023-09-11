


<section class="container detalle" id="detalle">

    <?php
        if ($response['item']['existencia'] == "0") {
        header('location: ../');
        }
    ?>
    <div class="detalle-img d-flex flex-column mb-3">
        <div>
            <h5>&nbsp;</h5>
        <a href="index.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i
        class="fa-solid fa-angle-left"></i>&nbsp;&nbsp;Regresar</a><br>&nbsp;
        </div>
        <div>
            <img src="../img/<?php echo $response['item']['imagen'];?>" />
        </div>

        <div class="down">
            Los articulos estan sujetos a una compra de no mas de <?php echo $response['item']['limite'];?> articulos
        </div>

    </div>

    <div class="detalle-text">

        <div>
            <input type='hidden' value='<?php echo $response['item']['id'] ?>' />
        </div>

        <h1>&nbsp;</h1>
        <h1>
            <?php echo $response['item']['nombre'];?>
        </h1>

        <span>$<?php echo $response['item']['precio'];?></span>
        
        <p>Categoría: <?php echo $response['item']['categoria'];?></p>
        
        <p>
        <?php echo $response['item']['descripcion'];?>
        </p>

        <p>
        </p>
        
        <!--p>
        Cantidad: &nbsp;&nbsp;<input type="number" min="1" max="<?php echo $response['item']['limite'];?>" value="1">
        </p-->
        <div class="botones"><button id="agg" class="align-items-end">Agregar al carrito</button></div>
    </div>
</section>