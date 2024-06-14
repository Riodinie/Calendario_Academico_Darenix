<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: /IntroduccionPHP/Horario_Proyecto_A');
  }
  require 'database.php';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id,name, email, password FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && ($_POST['password'] == $results['password'])) {
      $_SESSION['user_id'] = $results['id'];
      header("Location: /IntroduccionPHP/Horario_Proyecto_A");
    } else {
      ?>
          <div class="ok">Lo siento, las credenciales no coinciden.</div>
          <link rel= "icon" type="image/png" href="fenix.png"/>
      <?php

    }
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel= "icon" type="image/png" href="fenix.png" />
  </head>
  
  <body>
    <br><br><br><br><br>
    <div class="cuadrito">
    <br><br>
    <a class= "in_" href="/IntroduccionPHP/Horario_Proyecto_A">Darenix</a>
    <img class= "srcl" src="fenix.png">
   
    

    <h1>Inicia sesión</h1>

    <form action="login.php" method="POST">
       <h1>Inicia sesión</h1>
      <label >Correo electrónico</label>
      <input name="email" type="text" placeholder="Ingrese su Email">
      <br>
      <label >Contraseña</label>
      <input name="password" type="password" placeholder="Ingrese su Contraseña" required>
      <br>
      <input  class="login" class="login" type="submit" value="Inicia sesión" required>
      <br><br>
      <span>¿No tienes cuenta? <a href="signup.php">Regístrate</a></span>
      <br>
      <span>¿Olvidaste tu contraseña? <a href="recuperar.php">Recuperar</a></span>
      </div>
      
    <style> 

      
      h1{
         font-size: 24px;
         text-align: left;
         margin-left: 40px;
      }

       body{
         background-color:#FAFAFA;
         background-size: cover;
       }

       span{
          font-size: 13px;
          font-family: 'Graphik Light', sans-serif;
       
       }

       span a{
            color:#E44232;
            text-decoration: none;
       }
       span a:hover{
            
            text-decoration: underline;
       }

       .ok{
         text-align: center;
         background-color:#E6E1DC;
         padding: 10px;
         color: #1f1f1f;
         position: absolute;
         top:92%;
         left:39%;
       }

        .cuadrito{
          background-color:white; 
          height:430px;
          margin: 0px 480px 0px 480px;
          border: #D2C9C0 1px solid;
          border-radius: 10px;
         
        }

        .login{
        border: none;
        outline: none;
        height: 40px;
        background: #E44232;
        color: #fff;
        font-size: 13px;
        border-radius: 3px;
        width: 300px;
        font-weight: bold;
        font-family: 'Graphik Semibold', sans-serif;
        cursor: pointer;

        }
      .login:hover{
         cursor: pointer;
         background: #EF694B;
 
        }

        input[type="text"], input[type="password"],input[type="email"]{
       outline: none;
       padding: 10px;
       display: block;
       width: 300px;
       border-radius: 3px;
       border: 1px solid #D2C9C0;
       margin-left: 40px;
       
      }

      input[type="text"]:focus, input[type="password"]:focus,input[type="email"]:focus{
      border: 2px solid black;
      }


      label{
         font-size: 13px;
         float: left;
         margin:5px;
         margin-left: 50px;
         font-family: 'Graphik Semibold', sans-serif;
      }

      .in_{
      font-size:18px;
      font-weight:bold;
      position: absolute;
      top: 18%;
      left: 550px;
      text-decoration: none;
      color: #931936;
    }

    .srcl{
      height: 40px;
      position: absolute;
      top: 17%;
      left:500px;
    }

</style>

    </form>
    

  </body>
</html>
