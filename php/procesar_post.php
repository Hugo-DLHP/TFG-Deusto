<?php
    session_start();

    if (!isset($_SESSION['usuario'])) {
        header("Location: ../php/index.php");
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require('conexion.php');

        $titulo = $_POST['titulo'];
        $categoria = $_POST['categoria'];
        $resena = $_POST['resena'];
        $usuario_id = $_SESSION['usuario_id']; 

        $fechaHora = date("Y-m-d H:i:s");

        $sql = "INSERT INTO posts (post, fecha_publicacion, categoria, usuario_id, titulo_del_libro) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssiss', $resena, $fechaHora, $categoria, $usuario_id, $titulo);

        if ($stmt->execute()) {
            header("Location: ../php/user-home.php");
            exit();
        } else {
            echo "Error al publicar el post.";
        }

        $stmt->close();
        $conn->close();
    } else {
        header("Location: ../php/index.php");
        exit();
    }
?>
