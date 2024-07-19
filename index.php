<?php
session_start();
  
if (isset($_SESSION['user_id'])) {
  header("Location: calendario.php");
}

  require 'database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id,name, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;


    if (count($results) > 0) {
      $user = $results;
    }
  }
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Darenix</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="img/fenix.png" />
</head>

<body class="body-color">
    <nav class="navbar navbar-expand-lg bg-transparent">
        <div class="container">
            <img class="icon" src="img/fenix.png" height="50">
            <a class="navbar-brand me-auto logo-title" href="index.php">&nbsp;Darenix</a>
            <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="sidebar offcanvas offcanvas-top"  tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header border-bottom">
                    <img class="icon" src="img/fenix.png" height="50">
                    <a href="index.php" class="offcanvas-title logo-title" id="offcanvasNavbarLabel">&nbsp;Darenix</a>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 fs-6 pe-3">
                        <li class="nav-item mx-2 rounded-3">
                            <a class="nav-link" aria-current="page" href="">&nbsp;Características</a>
                        </li>
                        <li class="nav-item mx-2 rounded-3">
                            <a class="nav-link" href="#">&nbsp;Para equipos</a>
                        </li>
                        <li class="nav-item mx-2 rounded-3">
                            <a class="nav-link" href="#">&nbsp;Recursos</a>
                        </li>
                    </ul>
                    <div class="vr"></div>
                    <hr>
                    <div class="d-flex justify-content-center align-items-center px-3  fs-6 gap-3">
                        <a href="login.php" class="s-button text-black text-decoration-none px-3 py-1 rounded-3">Iniciar sesión</a>
                        <a href="signup.php" class="l-button text-decoration-none px-3 py-1 rounded-3">Registrarse</a>
                    </div>
                    
                </div>
            </div>
        </div>
    </nav>
    <main>
        <section class="container p-3">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <img src="img/Fondo.png" style="max-height: 500px ;"  class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 justify-content-center text-center">
                    <h1 class="display-5 fw-bold">Consigue la anhelada tranquilidad con Darenix</h1>
                    <p class="lead">Simplifica tu vida administrando tareas y haciendo listas de pendientes.</p>
                    <a href="login.php"><button type="submit" class="margin-i btn btn-lg l-button">Comienza ahora</button></a> 
                </div>
            </div>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>