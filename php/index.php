<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INICIO</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <nav>
        <div class="logo"><a href="./index.php"><img src="../img/pruebaLogo1.png" alt=""></a></div>
        <div class="barnav">
            <a href="../html/login.html" id="sesion">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                </svg>
            </a>        
            <button id="menu-toggle">☰</button>
        </div>
    </nav>
    <div class="contenedor">
        <div class="izquierda">
            <?php
                require('conexion.php');

                $categorias = array('terror', 'romance', 'fantasia');
                $contador = 0;
                foreach ($categorias as $categoria) {   
                    $contador++;
                    echo '<div class="espacio" id="cat'.$contador.'"></div>' . 
                            '<div class="seccion" id="' . $categoria . '">
                            <h2>' . ucfirst($categoria) . '</h2>';

                    $sql = "SELECT u.nombre, p.titulo_del_libro, p.post FROM posts p
                            JOIN usuarios u ON p.usuario_id = u.id
                            WHERE p.categoria = '$categoria'";
                    $result = $conn->query($sql);


                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo    '<div class="post">
                                        <div id="usuario">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                            </svg>
                                            <span id="nombre_usuario">' . $row["nombre"] . '</span>
                                        </div>
                                        <hr class="linea-divisoria">
                                        <div id="contenido-post">
                                            Título del libro: <span id="titulo">' . $row["titulo_del_libro"] . '</span><br>
                                            <span id="contenido">' . $row["post"] . '</span>
                                        </div>
                                        <hr class="linea-divisoria">
                                    </div>';

                        }
                    } else {
                        echo "No hay publicaciones en la categoría " . ucfirst($categoria);
                    }

                    echo '</div>';
                }

                $conn->close();
            ?>

        </div>    
        <div class="derecha contenido">
            <div class="categorias">
                <h2>Categorías</h2>
                <ul>
                    <li><a href="#cat1">Terror</a></li>
                    <li><a href="#cat2">Romance</a></li>
                    <li><a href="#cat3">Fantasia</a></li>
                </ul>
            </div>
            <?php
                require('conexion.php');
                
                $consulta_posts = "SELECT u.nombre, p.titulo_del_libro, p.post
                FROM usuarios u 
                JOIN (
                    SELECT usuario_id, MAX(fecha_publicacion) AS fecha_reciente
                    FROM posts
                    GROUP BY usuario_id
                ) AS ultimos_posts
                ON u.id = ultimos_posts.usuario_id
                JOIN posts p
                ON ultimos_posts.usuario_id = p.usuario_id AND ultimos_posts.fecha_reciente = p.fecha_publicacion;
                ";

                $resultado_posts = $conn->query($consulta_posts);

                if ($resultado_posts->num_rows > 0) {
                    while ($row = $resultado_posts->fetch_assoc()) {
                        $titulo = $row['titulo_del_libro'];
                        $contenido = $row['post'];
                        $nombre = $row['nombre'];
            ?>

            <div class="ultimo-post">
                <h2>Último Post</h2>
                <div class="contenido-post" id="ultimo-post">
                    <div id="usuario">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                        </svg>
                        <span id="nombre_usuario"><?php echo $nombre; ?></span>
                    </div>
                    Titulo del libro: <spam id="titulo"><?php echo $titulo; ?></spam><br>
                    <span id="contenido"><?php echo $contenido; ?></span>
                </div>
            </div>

            <?php
                    }
                    $conn->close();
                } else {
                    header("Location: ../php/index.php");
                    exit();
                }
            ?>

        </div>        
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var menuToggle = document.getElementById('menu-toggle');
            var izquierda = document.querySelector('.izquierda');
            var derecha = document.querySelector('.derecha');

            menuToggle.addEventListener('click', function () {
                izquierda.classList.toggle('expanded');
                derecha.classList.toggle('collapsed');
            });

            var categoriasLinks = document.querySelectorAll('.categorias a');

            categoriasLinks.forEach(function (link) {
                link.addEventListener('click', function (event) {
                    event.preventDefault();

                    var targetId = link.getAttribute('href').substring(1);
                    var targetElement = document.getElementById(targetId);

                    targetElement.scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });
        });
    </script>  
</body>
</html>