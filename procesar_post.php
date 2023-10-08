<?php
    session_start();

    if (!isset($_SESSION['usuario'])) {
        header("Location: index.html");
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "proyecto";

        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        $titulo = $_POST['titulo'];
        $categoria = $_POST['categoria'];
        $resena = $_POST['resena'];
        $usuario_id = $_SESSION['usuario_id']; 

        $sql = "INSERT INTO posts (post, fecha_publicacion, categoria, usuario_id, titulo_del_libro) VALUES (?, NOW(), ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssis', $resena, $categoria, $usuario_id, $titulo);

        if ($stmt->execute()) {
            header("Location: user-home.php");
            exit();
        } else {
            echo "Error al publicar el post.";
        }

        $stmt->close();
        $conn->close();
    } else {
        header("Location: index.html");
        exit();
    }
?>
