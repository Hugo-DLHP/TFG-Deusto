<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "proyecto";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $usuario = $_POST['nuevo-usuario'];
    $contraseña = $_POST['nueva-contraseña'];

    $verificarUsuario = "SELECT * FROM usuarios WHERE usuario='$usuario'";
    $resultado = $conn->query($verificarUsuario);

    if ($resultado->num_rows > 0) {
        echo "Error: Este nombre de usuario ya está siendo utilizado.";
    } else {
        $sql = "INSERT INTO usuarios (nombre, apellidos, usuario, contrasena) VALUES ('$nombre', '$apellidos', '$usuario', '$contraseña')";

        if ($conn->query($sql) === TRUE) {
            header("Location: ../html/login.html");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
?>
