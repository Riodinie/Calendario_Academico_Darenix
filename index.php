<?php
  session_start();

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

   echo $user['name']; 
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Welcome</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://kit.fontawesome.com/17ab7c87a6.js"></script>
    <link rel= "icon" type="image/png" href="fenix.png"/>
  </head>
  <body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($user)):  header('Location: /IntroduccionPHP/Horario_Proyecto_A/Calendar'); ?>
      
      <br> Welcome. 
      <? $user['name']; 
      ?>
      
      <br>
      <a href="logout.php">
        <br>
        <input type="button"  value="Cerrar sesión">
      </a>
    <?php else: ?>
      <br><br><br><br><br><br><br>
      <div class="d">
      <div class= "c">
      <p class = "a" >Consigue la anhelada tranquilidad con Darenix</p>
      </div>
      <!--<p class = "b" >Gestiona horarios y logra más alta productividad independientemente de la dinámica de tus clases.</p>-->
      <!--<a href="login.php"><input class ="login-box"  type="button"  value="Iniciar sesión"></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
      <div class=" a_2" ><a href="signup.php"><input class ="login-box" type="button"  value="Comienza ahora"></a></div>
      <div class="imagen" ><img  src="fondo.png"></div>
      </div>

     <style>
         
         body{
         background-size: cover;
         }

        .a{
             font-size: 48px;
             font-family: 'Graphik Semibold', sans-serif;
             margin: 0;
             text-align: left;
             font-weight: bold;
             color: #1F1F1F;
             z-index: 10; 
          }
  

        .c{  
          margin: 0px 170px 0px 630px;
          padding: 80px 20px 20px 20px;
          border-radius: 20px;
          display:flex;
        }
      
        .d{
          background-color:#FFF9F3;
          height:500px;
        }
         .a_2 {

          z-index: 1000;
          position: relative;
          margin: 10px 0px 0px 140px
          
         }
        .login-box{
          border: none;
          outline: none;
          height: 40px;
          background: #E44232;
          color: #fff;
          font-size: 18px;
          border-radius: 10px;
          width: 200px;
          font-weight: bold;
          font-family: 'Graphik Semibold', sans-serif;

          }
        .login-box:hover{
           cursor: pointer;
           background: #EF694B;
   
          }

          .imagen{
            position:absolute;
            top:18%;
            left:8%;
          }

          .imagen img{
            width:404px;
            height:468px;
          }
          
}

      </style>
       <footer>
    <hr color="#D2C9C0" size="1">
    <div class="contenedor">

      <div class="footer-contenido">
               
        <div class="items">
           <h3> &nbsp;</h3>
           <p class = "b" >Gestiona horarios y logra más alta productividad independientemente de la dinámica de tus clases.
           <div class="centrar_icons">
             
               <i class="fab fa-facebook-square"></i><i class="fab fa-instagram"></i><i class="fab fa-whatsapp"></i>
           </div>
               
        </div>

       <div class="items">
           <h3>CARACTERISTICAS</h3>
                    <li class="li"><a href="#">Cómo funciona</a></li>
                    <li class="li"><a href="#">Para equipos</a></li>
                    <li class="li"><a href="#">Precios</a></li>
                    <li class="li"><a href="#">Plantillas</a></li>
       </div>

       <div class="items">
           <h3>RECURSOS</h3>
                    <li class="li"><a href="#">Descarga las apps</a></li>
                    <li class="li"><a href="#">Centro de ayuda</a></li>
                    <li class="li"><a href="#">API de desarrollador</a></li>
                    <li class="li"><a href="#">Plantillas</a></li>          
       </div>

       <div class="items">
           <h3>COMPAÑIA</h3>
                    <li class="li"><a href="#">Acerca de Daenix</a></li>
                    <li class="li"><a href="#">¡Trabaja con nosotros!</a></li>
                    <li class="li"><a href="#">Blog</a></li>
                    <li class="li"><a href="#">Prensa</a></li>                   
       </div>

         </div>
   
           <br><br>
           <div><p class="final">Copyright © All rights reserved. Esta pagina es solo informativa para la clase de Requerimientos-UNIMETA</p></div>
           
       </div>
   </footer>

   <style>
           hr{
              margin:0px 60px;
            }

           footer{
             background: #FFF9F3;
             color: #1f1f1f;
             padding: 30px 0;
           }
            .contenedor{
              width: 100%;
              padding: 0 20px;
              max-width: 1000px;
              margin: 0 auto;
            }


          .footer-contenido{
             display: flex;
             justify-content: space-between;
             align-items: flex-start;
             flex-wrap: wrap;
            }

          .items{
            padding: 20px 0px;
            flex-basis: 20%;
            font-size: 13px;
          }

          .items h3{
            position: relative;
            font-size: 12px;
            margin-bottom: 1rem;
            font-family: 'Graphik Light', sans-serif;
            font-size: 12px;
          }

          .final{
            text-align: center;
            margin: 0px;
            font-family: 'Graphik Light', sans-serif;
          }

          .fab{
          
           margin: 5px 10px;
           font-size: 30px;
           cursor: pointer;
          }

          .fab:hover{
           color: #9b9b9b;
         }

          .centrar_icons{

           text-align: center;
          }

         .b{
            font-family: 'Graphik Light', sans-serif;
            text-align: center;
            font-size: 16px;
            font-weight:bold;
          }

          .li{
            list-style: none;
            line-height: 2;
            font-size: 16px;
            font-weight:bold;
            font-family: 'Graphik Light', sans-serif;

           }
          .li a{
            text-decoration: none;
            color: #1f1f11;
           }

           .li:hover{
            text-decoration-line: underline;
           }

   </style>


    <?php endif; ?>
  </body>
</html>
