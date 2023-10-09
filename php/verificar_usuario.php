<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "proyecto";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $usuario = $_GET['usuario'];

    $verificarUsuario = "SELECT * FROM usuarios WHERE usuario='$usuario'";
    $resultado = $conn->query($verificarUsuario);

    $response = new stdClass();
    $response->existe = false;

    if ($resultado->num_rows > 0) {
        $response->existe = true;
    }

    header('Content-Type: application/json');
    echo json_encode($response);

    $conn->close();
?>
