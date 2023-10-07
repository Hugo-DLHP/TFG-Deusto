<?php

    ini_set('display_errors', 1);
    error_reporting(E_ALL);

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
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $apellidos = mysqli_real_escape_string($conn, $_POST['apellidos']);
    $usuario = mysqli_real_escape_string($conn, $_POST['nuevo-usuario']);
    $contrasena = mysqli_real_escape_string($conn, $_POST['nueva-contraseña']); 

    // Hashear la contraseña antes de guardarla en la base de datos (seguridad)
    $contrasena_hasheada = password_hash($contrasena, PASSWORD_DEFAULT);

    // Insertar datos en la base de datos
    $sql = "INSERT INTO usuarios (nombre, apellidos, usuario, contrasena) VALUES ('$nombre', '$apellidos', '$usuario', '$contrasena_hasheada')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro exitoso";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Cerrar conexión
    $conn->close();
?>
