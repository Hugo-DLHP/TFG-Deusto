<?php
// Conexión a la base de datos (reemplaza estos valores con los de tu servidor)
$servername = "nombre_del_servidor";
$username = "nombre_de_usuario";
$password = "contraseña";
$database = "nombre_de_la_base_de_datos";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$usuario = $_POST['nuevo-usuario'];
$contrasena = password_hash($_POST['nuevoa-contraseña'], PASSWORD_DEFAULT); // Encriptar la contraseña antes de almacenarla

// Insertar datos en la base de datos
$sql = "INSERT INTO usuarios (nombre, apellidos, usuario, contrasena) VALUES ('$nombre', '$apellidos', '$usuario', '$contrasena')";

if ($conn->query($sql) === TRUE) {
    echo "Registro exitoso";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar conexión
$conn->close();
?>
