<?php
    require('conexion.php');

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
