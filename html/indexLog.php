<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['username'])) {
    header("Location: /proyectoWeb/html/login.html");
    exit();
}

$username = htmlspecialchars($_SESSION['username']); // Proteger contra ataques XSS
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arte y Diseño</title>
    <link rel="stylesheet" href="../css/styleIndex.css">
</head>
<body>
    <video class="video-background" autoplay loop muted playsinline>
        <source src="../video/milky-way-timelapse.3840x2160.mp4" type="video/mp4">
        Tu navegador no soporta videos HTML5.
    </video>
    <header>
        <div><img src="../images/logoArte.png" alt="Logo"></div>
        <nav>
            <a href="../controller/logout.php">Cerrar Sesion</a>
            <a href="#contactanos">Contáctanos</a>
            <a href="galeria.html">Galería</a>
            <a href="#blog">Blog</a>
        </nav>
    </header>

    <main>
        <section id="intro">
            <h3 class="ache">Bienvenido/a: <?php echo $username; ?></h3>
            <h2>Explora nuestra galería de arte y diseño</h2>
            <h1><p style="text-align: center;">Conecta con artistas y descubre obras únicas.</p></h1>
        </section>

        <section id="galeria">
            <h3 class="ache">Galería Destacada</h3>
            <div class="gallery">
                <img src="../images/83960.jpg" alt="Obra 1">
                <img src="../images/84366.jpg" alt="Obra 2">
                <img src="../images/318302.jpg" alt="Obra 3">
                <img src="../images/397369.jpg" alt="Obra 4">
            </div>
        </section>

        <section id="perfiles">
            <h3 class="ache">Perfiles de Artistas</h3>
            <div class="artist-profile">
                <h3>Artista: Juan Pérez</h3>
                <p>Especialidad: Pintura contemporánea</p>
                <p>Biografía: Artista con más de 10 años de experiencia en exposiciones internacionales.</p>
            </div>
            <div class="artist-profile">
                <h3>Artista: Ana López</h3>
                <p>Especialidad: Escultura moderna</p>
                <p>Biografía: Sus esculturas combinan elementos abstractos y naturales.</p>
            </div>
        </section>

        <section id="blog">
            <h3 class="ache">Últimas Noticias y Artículos</h3>
            <article>
                <h4>5 Tendencias en el Diseño Gráfico de 2025</h4>
                <p>Descubre cómo los diseñadores están transformando la industria con técnicas innovadoras.</p>
            </article>
            <article>
                <h4>Entrevista con Marta García: "El arte es libertad"</h4>
                <p>Conoce a la artista detrás de la obra que está conquistando las galerías.</p>
            </article>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Arte y Diseño. Todos los derechos reservados.</p>
        <p>Síguenos en: <a href="#">Instagram</a> | <a href="#">Facebook</a> | <a href="#">Twitter</a></p>
    </footer>
</body>
</html>
