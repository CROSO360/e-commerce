<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="shop/all.min.css" />
  <link rel="stylesheet" href="iniciotejena.css" />
  <link rel="shortcut icon" href="images/icon.svg" />
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

      <input type="checkbox" id="menu" />
      <label for="menu" id="menu-icon"><i class="fa-solid fa-bars"></i></label>
      <!-- Navigation Bar -->

      <ul class="navbar">
        <li><a href="index.php#home">Inicio</a></li>
        <li><a href="shop/index.php">Productos</a></li>
        <li><a href="#about">Sobre</a></li>
        <li><a href="index.php#properties">Promos</a></li>
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

                <a href='shop/logout.php' class='btnss'>Cerrar Sesión</a>
                
                ";
      } else {
        echo '<a href="login/" class="btnss">Iniciar Sesion</a>';
      }
      ?>
    </div>
  </header>
  <!-- BannerAboutLolita -->
  <section class="LOLITA container" id="sobre">
    <div class="LOLITA-text">
      <h1></h1>
    </div>
  </section>
  <!-- About -->
  <section class="container about" id="about">
    <div class="about-img"><img class="imagen2" src="img/images/la13/laentradadelado.jpg" /></div>
    <div class="about-text">
      <span>Sobre Nosotros</span>
      <h1>
        Los mejores productos<br>para ti!
      </h1>
      <p>
        Somos una papelería local con más de 5 años de experiencia en el mercado. Nos especializamos en la venta
        de todo tipo de material de oficina y escolares.
      </p>
      <p>
        Contamos con un amplio surtido de productos de las mejores marcas y ofrecemos un servicio de calidad a nuestros
        clientes.
        Nuestro objetivo es ayudar a nuestros
        clientes a tener éxito en sus negocios y en sus estudios, proporcionando los materiales que necesitan para
        hacerlo.
      </p>
      <p>
        Nos encantaría tenerte como cliente y ayudarte a encontrar todo lo que necesitas para tu oficina o escuela.
        ¡Visítanos en nuestra tienda o contáctanos a través de nuestras redes sociales para más información!
      </p>
      <h1>
        Contáctanos:
      </h1>
      <div style="align-item: center;">
        <img style="width: 5%;" src="img/images/whatsapp.svg" width="25" height="25">+593 99 344
        4176<br>
        <img style="width: 5%;" src="img/images/instagram" width="25" height="25">@papeleria_la_13.manta<br>
        <img style="width: 5%;" src="img/images/email" width="25" height="25"> mijavi1974@yahoo.com<br>
      </div>
    </div>
  </section>




  <!-- properties -->
  <section class="container properties">
    <div class="properties-text">
      <span>FOTOS</span>
      <h1>Vista del Local</h1>
      <br>
    </div>
    <div class="about-block container">
      <!-- card 1 -->
      <div class="box">
        <img src="img/images/la13/ladoizquierdo.jpg" />
      </div>
      <div class="box">
        <img src="img/images/la13/izquierdozoom" />
      </div>
      <div class="box">
        <img src="img/images/la13/frente" />
      </div>

    </div>
  </section>
  <section>
    <div class="container mt-5 mb-5">
      <h1>Te esperamos pronto.</h1>
      <p>Calle 13 Av. 6 diagonal a la Iglesia "La Merced", Manta.</p>
      <div class="responsive-iframe">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31914.109597055714!2d-80.72680319888916!3d-0.9553535964992783!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xcc113d2213f226ef!2sLIBRERIA%20-%20PAPELERIA%20LA%2013!5e0!3m2!1ses!2sec!4v1673067603600!5m2!1ses!2sec"
          width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
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