<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "proyecto";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $database);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtener datos del formulario y evitar inyección de SQL
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $usuario = $_POST['nuevo-usuario'];
    $contraseña = $_POST['nueva-contraseña']; 


    // Insertar datos en la base de datos
    $sql = "INSERT INTO usuarios (nombre, apellidos, usuario, contrasena) VALUES ('$nombre', '$apellidos', '$usuario', '$contraseña')";

    if ($conn->query($sql) === TRUE) {
        header("Location: login.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Cerrar conexión
    $conn->close();
?>
