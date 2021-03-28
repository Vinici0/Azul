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
    <?php include('header.php'); ?>

    <section class="main">
      <table>
        <thead>
          <tr>
            <th>Peso</th>
            <th>Altura</th>
            <th>IMC</th>
            <th>Stado</th>
          </tr>
        </thead>
        <tbody>
          <?php
          include('config.php');
          $query = $connection->prepare("SELECT * FROM progress WHERE id_user=:id_user ORDER BY id DESC");
          $query->bindParam("id_user", $_SESSION['user_id'], PDO::PARAM_INT);
          $query->execute();

          $result = $query->fetchAll();
          if (!$result) {
          ?>
        </tbody>
        <tr>
          <td colspan="4">No existe historial</td>
        </tr>

      <?php
          } else {
            foreach ($result as $row) {
              echo '
      <tr>
        <td >' . $row['weight'] . '</td>
        <td >' . $row['height'] . '</td>
        <td>' .round($row['weight'] / ($row['height'] ^ 2), 2) . '</td>';
              if (($row['weight'] / ($row['height'] ^ 2)) < 18.5) {
                echo '<td style="background-color:#FFFFE0;" >Bajo peso</td>';
              } else if (($row['weight'] / ($row['height'] ^ 2)) >= 18.5 &&  ($row['weight'] / ($row['height'] ^ 2)) <= 24.9) {
                echo '<td  style="background-color:#bdecb6;" >Normal</td>';
              } else if (($row['weight'] / ($row['height'] ^ 2)) >= 24.9) {
                echo '<td style="background-color:#ea899A ;" >Sobrepeso</td>';
              }
              echo '
      </tr>
      ';
            }

      ?>
        </tbody>
      <?php
          }
      ?>
      </table>

    </section>
    <footer>
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