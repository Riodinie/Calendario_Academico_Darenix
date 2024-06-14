<?php

$username = 'root';
$password = '';
$database = 'practicas';

try {
  
  $conn = new PDO("mysql:host=localhost;dbname=$database;", $username, $password);
} catch (PDOException $e) {
  die('Connection Failed: ' . $e->getMessage());
}
?>
