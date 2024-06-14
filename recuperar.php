<?php

  session_start();

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
          <div class="ok ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Tu contraseña es:&nbsp;&nbsp;<?=$user['password']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
          <link rel= "icon" type="image/png" href="fenix.png"/>
      <?php

    } else {
      ?>
          <div class="ok">Lo siento, las respuestas no coinciden.</div>
          <link rel= "icon" type="image/png" href="fenix.png"/>
      <?php

    }
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Recuperar</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel= "icon" type="image/png" href="fenix.png" />
  </head>
  <body>


    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>


    <br><br><br><br><br>
    <div class="cuadrito">
    <br><br>
    <a class= "in_" href="/IntroduccionPHP/Horario_Proyecto_A">Darenix</a>
    <img class= "srcl" src="fenix.png">
   
    
    <br><br>
    <h1>Recuperar Contraseña</h1>
    <br>
    <form action="recuperar.php" method="POST">
      <label >Correo electrónico</label>
      <input name="email" type="text" placeholder="Ingrese su Email">
      <br>
      <label >¿Cuál es tu color favorito?</label>
      <input name="pregunta" type="text" placeholder="Ingrese su respuesta" required>
      <br>
      <input  class="login" type="submit" value="Recuperar">
      <br><br>
      <span><a href="login.php">Ir a Iniciar Sesión</a></span>
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
         top:88%;
         left:39%;
       }

        .cuadrito{
          background-color:white; 
          height:420px;
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
