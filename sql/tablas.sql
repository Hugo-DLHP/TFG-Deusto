DROP TABLE IF EXISTS usuarios;
DROP TABLE IF EXISTS posts;


CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellidos VARCHAR(50) NOT NULL,
    usuario VARCHAR(50) NOT NULL,
    contrasena VARCHAR(255) NOT NULL
);

CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo_del_libro VARCHAR(255) NOT NULL,
    post TEXT NOT NULL CHECK(LENGTH(post) <= 500),
    fecha_publicacion DATE NOT NULL,
    categoria ENUM('terror', 'romance', 'fantasia') NOT NULL,
    usuario_id INT,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);
