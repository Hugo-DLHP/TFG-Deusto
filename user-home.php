
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <div class="logo"><a href="./index.html"><img src="../img/pruebaLogo1.png" alt=""></a></div>
        <div class="barnav">
            <a href="#" id="sesion">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                </svg>
            </a>          
            <button id="menu-toggle">☰</button>
        </div>
    </nav>
    <div class="contenedor">
        <div class="menu_usuario">
            <div id="perfil_usuario">
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                </svg>
                <?php 
                    session_start();
                    if (isset($_SESSION['usuario'])) {
                        echo "<span>" . $_SESSION['usuario'] . "</span>";
                    } else { 
                        header("Location: index.html");
                        exit();
                    }
                ?>
            </div>
            <hr class="linea-divisoria">
                <button onclick="window.location.href='publicar_post.html';">Publicar Post</button>
            <div id="post_usuario">
                <?php
                    if (isset($_SESSION['usuario'])) {
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $database = "proyecto";

                        $conn = new mysqli($servername, $username, $password, $database);

                        if ($conn->connect_error) {
                            die("Conexión fallida: " . $conn->connect_error);
                        }

                        $usuario_id = $_SESSION['usuario_id'];

                        $consulta_posts = "SELECT titulo_del_libro, post FROM posts WHERE usuario_id = $usuario_id";
                        $resultado_posts = $conn->query($consulta_posts);

                        if ($resultado_posts->num_rows > 0) {
                            while ($row = $resultado_posts->fetch_assoc()) {
                                $titulo = $row['titulo_del_libro'];
                                $contenido = $row['post'];
                ?>
                    <div class="post">
                        <div id="contenido-post">
                            Titulo del libro: <span id="titulo"><?php echo $titulo; ?></span><br>
                            <span id="contenido"><?php echo $contenido; ?></span><br>
                        </div>
                    </div>
                <?php
                            }
                        } else {
                            echo "No hay posts publicados por este usuario.";
                        }

                        $conn->close();
                    } else {
                        header("Location: index.html");
                        exit();
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>


<div class="post">
    <div id="contenido-post">
        Titulo del libro: <spam id="titulo"></spam><br>
        <spam id="contenido"></spam><br>
    </div>
</div>