<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="shop/all.min.css" />
  <link rel="stylesheet" href="iniciotejena.css" />
  <link rel="shortcut icon" href="img/images/icon.svg" />
  <title>Papeleria la 13</title>
</head>

<body>
  <header>
    <div class="nav container">
      <!-- Logo -->
      <a href="index.php" class="logo">
        <i class="fa-solid fa-house"></i>
        PAPELERIA LA 13
      </a>
      <!-- Menu Icon -->
      
      <input  type="checkbox" id="menu" />
      <label for="menu" id="menu-icon"><i style="margin-left:20px;margin-right:20px;" class="fa-solid fa-bars"></i></label>
      <!-- Navigation Bar -->

      <ul class="navbar">
      
        <li><a href="#home">Inicio</a></li>
        <li><a href="shop/index.php">Productos</a></li>
        <li><a href="#about">Sobre</a></li>
        <li><a href="#properties">Promos</a></li>
        <li><a href="shop/carrito.php"><i style="font-size: 20px;" class="fa-solid fa-cart-shopping"></i>
      </a></li>
      
      </ul>
      <!-- log-in button -->
      
  
      
      <?php
            session_start();
            //unset($_SESSION['orden']);
            if (isset($_SESSION['usuario'])) {
                $respuesta = json_decode($_SESSION['usuario']);

                echo "<div style='margin-left:10px'>Bienvenido ".$respuesta->nombre." ".$respuesta->apellido."</div><br>

                <a href='shop/logout.php' class='btnss'>Cerrar Sesión</a>
                
                ";
            }else{
                echo '<a href="login/" class="btnss">Iniciar Sesion</a>';
            }
            ?>
    </div>
  </header>
  <!-- Home -->
  <section class="home container" id="home">

  </section>
  <!-- About -->
  <section class="container about" id="about">
    <div class="about-img"><img class="imagen" src="img/images/la13/entrada"/></div>
    <div class="about-text">
      <span>Sobre Nosotros</span>
      <h1>
        Disfruta de la calidad de nuestros servicios!
      </h1>
      <p>
        "La librería/papelería/bazar 'La 13' es un negocio familiar que lleva ofreciendo una amplia selección de
        artículos escolares y productos de oficina a los habitantes de nuestra ciudad durante los últimos
        5 años. Nos sentimos muy afortunados de tener una base de clientes leales y agradecemos a cada uno de ellos por
        confiar en nosotros. Si aún no eres cliente de 'La 13', te invitamos a visitarnos y conocer de primera mano
        la calidad de nuestros productos y el excelente servicio que ofrecemos. ¡Te esperamos en 'La 13'!"
      </p>
      <a href="AboutSystem.php" style="color: white;" class="btnss">Leer mas</a>
    </div>
  </section>
  <section class="container fondo" id="properties">
    <div class="titulo">
      <span>Promociones</span>
      <h1>Productos promocionales</h1>
    </div>
    <div class="contenedor">
    
      <!--a href="shop/detalle_producto.php"-->
      


        <?php


        unset($_SESSION['producto']);

        if (isset($_POST['idproducto'])) {
          $id = $_POST['idproducto'];
          $_SESSION['producto'] = $id;
          header('location: shop/detalle_producto.php');

        }

        $response = json_decode(file_get_contents('http://localhost:8081/croso3/api/productos/api-productos.php?categoria=11'), true);
        if ($response['statuscode'] == 200) {
            foreach ($response['items'] as $item) {
              //echo '<option value="'.$item['id'].'">'.$item['categoria'].'</option>';
              //echo '<button id="' . $item['id'] . '">' . $item['categoria'] . '</button>';
              echo '
              <form action="#" method="post">
              <div class="product"> 
                <input type="text" name="idproducto" id="xd" value="'.$item['id'].'" hidden>
                <img src="img/' . $item['imagen'] . '">
                <h2>'.$item['nombre'].'</h2>
                <hr style="color: white;">
                <p class="align-items-end">$'.$item['precio'].'</p>
                
              ';
              if ($item['existencia'] == '1') {
                echo '<button class="observar" type="submit">Ver Combo</button>
                  </div>
                  </form>';
              }else{
                echo '<button class="agotado align-items-end" disabled>Agotado</button>
                </div>
                </form>';
              }
            }
        } else {
            echo $response['response'];
        }

        ?>

        
        
      
    <!--/a-->
    
    </div>
  </section>
  <!-- Footer -->
  <div style="padding-top:10px">
    <section class="footer">
        <div class="copyright">
          <p>&#169;Papeleria "La 13" todos los derechos reservados 2023</p>
        </div>
      </section>
 </div>
 <script src="bacan.js"></script>
</body>

</html>