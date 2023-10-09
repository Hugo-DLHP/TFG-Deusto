<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "proyecto";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Error en la conexión a la base de datos: " . $conn->connect_error);
    }
?>
