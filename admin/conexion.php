<?php

$servername = "localhost";  
$username = "root";         
$password = "";             
$dbname = "dermatologo2";   


$conexion = new mysqli($servername, $username, $password, $dbname); 


if ($conexion->connect_error) {
    die("Conexión fallida: " . $conn->connect_error); 
}
//  echo "Conexión exitosa"; 
?> 
