<?php

session_start();
  
if (isset($_SESSION['user_id'])) {
  header("Location: calendario.php");
}

  require 'database.php';

  if (!empty($_POST['email']) && !empty($_POST['pregunta'])) {
    $records = $conn->prepare('SELECT id,name, email, password,pregunta FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']); 
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    $user = null;
    $message = '';

    if (count($results) > 0 && ($_POST['pregunta'] == $results['pregunta'])) {
      $user = $results;
    
      ?>
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Exito</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                 Tu contraseña es:&nbsp;<?=$user['password']?>
                </div>
            </div>
        </div>
    </div>
    <style>
        .modal-content{
          height: auto !important;
                    }
   </style>
      <script>
        document.addEventListener('DOMContentLoaded', function () {
            var myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {
                // Opciones del modal
            });
            myModal.show();
        });
    </script>
          <link rel= "icon" type="image/png" href="img/fenix.png"/>
      <?php

    } else {
      ?>
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Error</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                 Lo siento, las respuestas no coinciden.
                </div>
            </div>
        </div>
    </div>
    <style>
        .modal-content{
          height: auto !important;
                    }
   </style>
      <script>
        document.addEventListener('DOMContentLoaded', function () {
            var myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {
                // Opciones del modal
            });
            myModal.show();
        });
    </script>
    <link rel= "icon" type="image/png" href="img/fenix.png"/>
      <?php

    }
  }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="img/fenix.png" type="image/x-icon">
</head>
<body class="body-color">
    <div class="row vh-100 g-0">
    <div class="col-lg-6 position-relative d-none d-lg-block">
        <div class="bg-holder" style="background-image: url('img/woman-posing.jpg');">

        </div>
    </div>
    <div class="col-lg-6">
        <div class="row align-items-center justify-content-center h-100 g-0 px-4 px-sm-0">
            <div class="col col-sm-6 col-lg-7 col-xl-6">
                <a href="index.php" class="d-flex justify-content-left align-items-center mb-4 logo-title">
                    <img src="img/fenix.png" alt="" width="60">&nbsp;Darenix
                </a>
                <div class="text-center mb-5">
                    <h3 class="fw-bold title-pag">Recuperar Contraseña</h3>
                </div>
                <div class="position-relative"> 
                    <hr class="text-secondary divider">
                    <div class="divider-content-center">o</div>
                </div>
                <form action="recuperar.php" method="POST">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class='bx bx-envelope'></i></span>
                        <input name="email" type="text" class="form-control" placeholder="Correo electrónico" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class='bx bx-ghost' ></i></span>
                        <input name="pregunta" type="text" class="form-control" placeholder="¿Cuál es tu color favorito?" required>
                    </div>
                    <div class="input-group mb-3 d-flex justify-content-between">
                        <div>
                            <small><a class="links" href="login.php">Ir a inicio de sesión</a></small>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-lg w-100 color-red">Recuperar</button>
                </form>
                <div class="text-center">
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>   
</body>
</html>