<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
} else {
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <script src="https://kit.fontawesome.com/0ea7a89597.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="css/estilos.css" />
    <link rel="stylesheet" href="css/normalize.css" />
    <link rel="stylesheet" href="css/tabla.css">

    <title>IMC</title>
  </head>

  <body>
    <?php
    include('header.php');
    ?>

    <section class="main">

      <section class="acerca-de">
        <div class="contenedor">
          <div class="foto">
            <img src="img/espe.jpg" width="115" alt="155" alt="espe" />
          </div>

          <div class="texto">
            <h3 class="titulo">Acerca de</h3>
            <p>
              Puedes practicar deporte, puedes ser joven, pero si no te
              <span class="bold">alimentas correctamente</span> tu cuerpo
              sufrirá tarde o temprano.
            </p>
            <form action="agregarProgreso.php" method="post" name="progreso">
              <input type="text" name="peso" placeholder="peso (kg)">
              <input type="text" name="altura" placeholder="altura (m)">
              <button type="submit" name="progreso" value="progreso">=</button>
            </form>
            <div align="left" >
            <?php 
            include('config.php');
            $query = $connection->prepare("SELECT * FROM progress WHERE id_user=:id_user ORDER BY id DESC");
            $query->bindParam("id_user", $_SESSION['user_id'], PDO::PARAM_INT);
            $query->execute();
  
            $result = $query->fetch(PDO::FETCH_ASSOC);
            if($result) {
              echo '
              <p>Para la información que ingresó:</p>

              <p> Estatura: <b>'.$result['height'].'</b> metros</p>
                
              <p> Peso: <b>'.$result['weight'].'</b> kilogramos</p>
                
              <p> Su IMC es <b>'.round($result['weight']/($result['height'] ^ 2), 2).'</b>, lo que indica que su peso está en la categoría de 
              ';
              if (($result['weight'] / ($result['height'] ^ 2)) < 18.5) {
                echo '<b>Bajo peso</b>';
              } else if (($result['weight'] / ($result['height'] ^ 2)) >= 18.5 &&  ($result['weight'] / ($result['height'] ^ 2)) <= 24.9) {
                echo '<b>Normal</b>';
              } else if (($result['weight'] / ($result['height'] ^ 2)) >= 24.9) {
                echo '<b>Sobrepeso</b>';
              }
              
              echo ' para adultos de su misma estatura.</p>
      ';
            }
            ?>
              <table>
                <thead>
                  <tr>
                    <th>ICM</th>
                    <th>Nivel de peso</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Por debajo de 18.5</td>
                    <td>Bajo peso</td>
                  </tr>
                  <tr>
                    <td>18.5—24.9</td>
                    <td>Normal</td>
                  </tr>
                  <tr>
                    <td>30.0 o más</td>
                    <td>Sobrepeso</td>
                  </tr>
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </section>
      <section class="trabajos">
        <div class="contenedor">
          <h3 class="titulo">Catálogo</h3>
          <div class="contenedor-trabajos">
            <div class="trabajo">
              <div class="thumb">
                <img src="img/Trabajos/Desayunos.jpg.png" alt="Dasayunos" />
              </div>
              <div class="descripcion">
                <p class="nombre">Dasayunos</p>
                <p class="categoria">Alimetación</p>
              </div>
            </div>
            <div class="trabajo">
              <div class="thumb">
                <img src="img/Trabajos/Almuerzos-min.png" alt="Dasayunos" />
              </div>
              <div class="descripcion">
                <p class="nombre">Dasayunos</p>
                <p class="categoria">Alimetación</p>
              </div>
            </div>
            <div class="trabajo">
              <div class="thumb">
                <img src="img/Trabajos/Merinda-min.jpg.png" alt="Dasayunos" />
              </div>
              <div class="descripcion">
                <p class="nombre">Dasayunos</p>
                <p class="categoria">Alimetación</p>
              </div>
            </div>
            <div class="trabajo">
              <div class="thumb">
                <img src="img/Trabajos/GanarMasa-min.jpg.png" alt="Dasayunos" />
              </div>
              <div class="descripcion">
                <p class="nombre">Dasayunos</p>
                <p class="categoria">Alimetación</p>
              </div>
            </div>
            <div class="trabajo">
              <div class="thumb">
                <a href="https://www.youtube.com/watch?v=MY_gyv3ZDLE&list=RDCMUCQkaczRlyBjl3UKBH59W3XQ&start_radio=1&t=7s"><img src="img/Trabajos/EjerciciosParaBajarDepeso.jpg-min.png" alt="Dasayunos" /></a>
              </div>
              <div class="descripcion">
                <p class="nombre">Dasayunos</p>
                <p class="categoria">Alimetación</p>
              </div>
            </div>
            <div class="trabajo">
              <div class="thumb">
                <img src="img/Trabajos/EjerciciosParaGanarMasa.jpg-min.png" alt="Dasayunos" />
              </div>
              <div class="descripcion">
                <p class="nombre">Dasayunos</p>
                <p class="categoria">Alimetación</p>
              </div>
            </div>

          </div>
        </div>
      </section>
    </section>

    <footer>
      <section class="contacto">
        <div class="contenedor">
          <h3 class="titulo">Contacto</h3>
          <form class="formulario" action="">
            <input type="text" placeholder="Nombre" name="nombre" required />
            <!--required campo obligatorio-->
            <input type="email" placeholder="Correo" name="correo" required />
            <textarea name="mensaje" placeholder="Mensaje:"></textarea>
            <input class="boton" type="submit" value="Enviar" />
          </form>
        </div>
      </section>

      <section class="redes-sociales">
        <div class="contenedor">
          <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
          <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="youtube"><i class="fab fa-youtube"></i></a>
          <a href="#" class="instagram"><i class="fab fa-instagram"></i></a>
        </div>
      </section>

    </footer>



  </body>

  </html>

<?php
}
?>