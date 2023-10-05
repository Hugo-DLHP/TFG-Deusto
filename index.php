<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INICIO</title>
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
        <div class="contenedor-formulario" id="contenedor-formulario">
            <!-- Formulario de inicio de sesión -->
            <form id="login">
                <label for="usuario">Nombre de Usuario:</label>
                <input type="text" id="usuario" required>
                <label for="contraseña">Contraseña:</label>
                <input type="password" id="contraseña" required>
                <button type="submit">Iniciar Sesión</button>
            </form>

            <!-- Formulario de registro -->
            <form id="register" style="display: none;">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" required>
                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" required>
                <label for="nuevo-usuario">Nombre de Usuario:</label>
                <input type="text" id="nuevo-usuario" required>
                <label for="nuevoa-contraseña">Contraseña:</label>
                <input type="password" id="nuevoa-contraseña" required>
                <label for="confirmar-contraseña">Confirmar Contraseña:</label>
                <input type="password" id="confirmar-contraseña" required>
                <button type="submit">Registrarse</button>
            </form>

            <!-- Enlace para cambiar entre formularios -->
         
            <p id="textoLink">¿No estás registrado? <a href="#" id="link">Haz clic aquí para registrarte.</a></p>
        </div>

        <script>
            const login = document.getElementById("login");
            const register = document.getElementById("register");
            const link = document.getElementById("link");
            const textoLink = document.getElementById("textoLink");

            link.addEventListener("click", function (event) {
                event.preventDefault();
                login.style.display = login.style.display === "none" ? "block" : "none";
                register.style.display = register.style.display === "none" ? "block" : "none";
                textoLink.style.display = register.style.display === "none" ? "block" : "none";
            });

            login.addEventListener("submit", function (event) {
                event.preventDefault();
                // Aquí puedes agregar la lógica para manejar el inicio de sesión
                // por ejemplo, enviar datos a un servidor y verificar las credenciales.
                console.log("Iniciar Sesión - Usuario: " + document.getElementById("usuario").value);
            });

            register.addEventListener("submit", function (event) {
                event.preventDefault();
                const newPassword = document.getElementById("nuevoa-contraseña").value;
                const confirmPassword = document.getElementById("confirmar-contraseña").value;

                if (newPassword !== confirmPassword) {
                    alert("Las contraseñas no coinciden. Por favor, inténtalo de nuevo.");
                } else {
                    // Aquí puedes agregar la lógica para manejar el registro
                    // por ejemplo, enviar datos a un servidor y crear una nueva cuenta de usuario.
                    console.log("Registro Exitoso - Usuario: " + document.getElementById("nuevo-usuario").value);
                    alert("Registro Exitoso");
                    register.reset(); // Limpiar los campos del formulario de registro
                    login.style.display = "block";
                    register.style.display = "none";
                    textoLink.style.display = "block"; // Mostrar el enlace para registrarse nuevamente
                }
            });
        </script>
    </div>
</body>
</html>