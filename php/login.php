<?php
    require('conexion.php');

    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    $verificarUsuario = "SELECT * FROM usuarios WHERE usuario='$usuario' AND contrasena='$contrasena'";
    $resultado = $conn->query($verificarUsuario);

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        $usuario_id = $row['id'];

        session_start();
        $_SESSION['usuario'] = $usuario;
        $_SESSION['usuario_id'] = $usuario_id;

        header("Location: ../php/user-home.php");
        exit();
    } else {
        echo "Error: Usuario o contraseña incorrectos.";
    }

    $conn->close();
?>
