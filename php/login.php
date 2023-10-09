<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "proyecto";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

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

        header("Location: user-home.php");
        exit();
    } else {
        echo "Error: Usuario o contraseña incorrectos.";
    }

    $conn->close();
?>
