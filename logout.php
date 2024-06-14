<?php
  session_start();

  session_unset();

  session_destroy();

  header('Location: /IntroduccionPHP/Horario_Proyecto_A');
?>
