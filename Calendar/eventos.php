<?php

$username = 'root';
$password = '';
$database = 'practicas';

header('Content-Type: application/json');
header('Content-type: application/Json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
$pdo = new PDO("mysql:host=localhost;dbname=$database;", $username, $password);

//Elegir tabla -_-
session_start();

require 'C:\xampp\htdocs\IntroduccionPHP\Horario_Proyecto_A\database.php';

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

/////

$accion = (isset($_GET['accion']))?$_GET['accion']:'leer';

switch($accion){
    
    case 'agregar':

        $sentenciaSQL = $pdo->prepare ("INSERT INTO 
        ".$user['name']."(title, descripcion, color, textColor, start, end)
        VALUES(:title, :descripcion, :color, :textColor, :start, :end)");
 
      $respuesta = $sentenciaSQL->execute (array(

       "title" =>$_POST['title'],
       "descripcion"=>$_POST['descripcion'],
       "color" =>$_POST['color'],
       "textColor" =>$_POST['textColor'],
       "start" =>$_POST['start'],
       "end"=>$_POST['end']
        ));
     
     echo json_encode($respuesta);
    break;

    case 'eliminar':
        
        $respuesta=false;
        if(isset($_POST['id'])){
          
        $sentenciaSQL= $pdo->prepare( "DELETE FROM ".$user['name']." WHERE ID=:ID");
        $respuesta = $sentenciaSQL ->execute (array ("ID"=>$_POST['id']));
        }
        echo json_encode($respuesta);
    break;

    case 'modificar':

        $sentenciaSQL = $pdo->prepare("UPDATE ".$user['name']." SET
         title=:title,
         descripcion=:descripcion,
         color=:color,
         textColor= :textColor,
         start=:start,
         end=:end
         WHERE ID=:ID
         ");

        $respuesta = $sentenciaSQL->execute (array(

          "ID" =>$_POST['id'],
          "title" =>$_POST['title'],
          "descripcion"=>$_POST['descripcion'],
          "color" =>$_POST['color'],
          "textColor" =>$_POST['textColor'],
          "start" =>$_POST['start'],
          "end"=>$_POST['end']
         ));

        echo json_encode($resultado);
    break;

    case 'vaciar':

    $sentenciaSQL= $pdo->prepare( "DELETE FROM ".$user['name']."");
    $sentenciaSQL->execute();

    $resultado= $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($resultado);

    break;

    default:
    // Seleccionar los eventos del calendario
     $sentenciaSQL= $pdo->prepare("SELECT * FROM ".$user['name'].""); 
     $sentenciaSQL->execute();

     $resultado= $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
     echo json_encode($resultado);
     break;

}

?>

