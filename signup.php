<?php

  require 'database.php';

  $message = '';
  

  if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['pregunta']) ){

    $records = $conn->prepare('SELECT id,name, email, password FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    //comprueba que no hay imail repetido
    if (($_POST['email'] != (isset($results['email'])))){
      
     $sentenciaSQL= $conn->prepare("CREATE TABLE ".$_POST['name']."(
        id int(11) AUTO_INCREMENT PRIMARY KEY,
        title varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
        descripcion text COLLATE utf8mb4_spanish_ci NOT NULL,
        color varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
        textColor varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
        start datetime NOT NULL,
        end datetime NOT NULL
        )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci"); 

     $sentenciaSQL->execute();
      
     $sql = "INSERT INTO users(name,email, password,pregunta) VALUES (:name,:email, :password,:pregunta)";
     $stmt = $conn->prepare($sql);
     $stmt->bindParam(':name', $_POST['name']);
     $stmt->bindParam(':email', $_POST['email']);
     $stmt->bindParam(':password', $_POST['password']);
     $stmt->bindParam(':pregunta', $_POST['pregunta']);
 
     if ($stmt->execute()) {
       ?>
       <div class="ok">Se ha creado la cuenta con éxito</div>
       <link rel= "icon" type="image/png" href="fenix.png"/>
       <?php
     } else {
       ?>
       <div class="ok">Lo siento, ocurrio un error</div>
       <link rel= "icon" type="image/png" href="fenix.png"/>
       <?php
     }


    } else {
      ?>
          <div class="ok">Ya existe un usuario con este email</div>
          <link rel= "icon" type="image/png" href="fenix.png"/>
      <?php

    }

  }
  
  
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>SignUp</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel= "icon" type="image/png" href="fenix.png"/>
  </head>
  <body>
  <br>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <div class="cuadrito">
    
    
    <a class= "in_" href="/IntroduccionPHP/Horario_Proyecto_A">Darenix</a>
    <img class= "srcl" src="fenix.png">
    <br><br><br>

    <h1>Regístrate</h1>
    <br>

    <form action="signup.php" method="POST">
      <label >Nombre</label>
      <input name="name" type="text" placeholder="Ingrese su Nombre" required>
      <br>
      <label>Correo electrónico</label>
      <input name="email" type="email" placeholder="Ingrese su Email" required>
      <br>
      <label >Contraseña</label>
      <input name="password" type="password" placeholder="Introduzca su contraseña"required>
      <br>
      <label >¿Cuál es tu color favorito?</label>
      <input name="pregunta" type="text" placeholder="Ingrese su respuesta" required>
      <br>
      <input class="signup" name="enviar" type="submit" value="Registrarme">
      <br><br>
      <span>¿Ya te registraste?&nbsp;<a href="login.php">Ir a inicio de sesión</a></span>
      
    </form>
    <?php 
    
    
    
    
    
    
    ?>
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
         left:40.5%; 
         border: #1f1f1f 1.5px solid;
        
       }
         
     
      .cuadrito{
        background-color:white; 
        height:585px;
        margin: 1px 480px 0px 480px;
        border: #D2C9C0 1px solid;
        border-radius: 10px;
           
          }

      .signup{
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
        .signup:hover{
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
        top: 6%;
        left: 550px;
        text-decoration: none;
        color: #931936;
      }

      .srcl{
        height: 40px;
        position: absolute;
        top: 5%;
        left:500px;
      }

</style>

  </body>


</html>

    