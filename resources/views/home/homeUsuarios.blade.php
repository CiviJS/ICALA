<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ministerio ICALA - Inicio</title>
        <link rel='icon' type="image/jpeg" href="images/ICALA.jpg">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="fade-in">

    <nav class="navbar">
        <div class="navbar-content">
            <div class="logo">
          
                <h1>ICALA</h1>
                <span>Al Amparo Del Altísimo</span>
            </div>
            <div class="nav-links">
                <a href="#mision">Misión</a>
                <a href="#servicios">Servicios</a>
                <a href="#liderazgo">Liderazgo</a>
                <a href="#recursos">Eventos</a>
            </div>
            <div class="nav-action">
                <a href="#" class="btn btn-primary">Donar Ahora ('Cargar El QR de Nequi')</a>
            </div>
        </div>
    </nav>

    <main class="layout-container wide">
        <section id="mision" class="hero">
            <h1>Transformando Vidas y Familias</h1>
            <p>
                I.C.A.L.A proclama el evangelio de Jesucristo con el propósito de transformar vidas, formando creyentes firmes y capacitados.
            </p>
        </section>

        <section id="servicios" style="padding: 60px 0;">
            <h2 class="header-accent" style="border-left: 5px solid var(--primary-color); padding-left: 15px;">Nuestros Servicios Semanales</h2>
            <div class="services-grid">
                <div class="service-card">
                    <h3>Viernes de Milagros</h3>
                    <p class="time info">7:00 P.M.</p>
                    <p class="text-muted">Un tiempo dedicado a la oración y manifestación de la fe.</p>
                </div>
                <div class="service-card">
                    <h3>Expansión Sábado</h3>
                    <p class="time accent">6:00 P.M.</p>
                    <p class="text-muted">Enfoque en el crecimiento y la capacitación.</p>
                </div>
                <div class="service-card">
                    <h3>Servicio Dominical</h3>
                    <p class="time primary">8:00 A.M.</p>
                    <p class="text-muted">Celebración principal y enseñanza de la Palabra.</p>
                </div>
            </div>
        </section>

        <section id="liderazgo" style="padding: 60px 0;">
            <h2 class="header-accent" style="border-left: 5px solid var(--primary-color); padding-left: 15px;">Nuestro Liderazgo</h2>
            <div class="leadership-card">
             
                <div class="leadership-info">
                    <h3 style="font-size: 1.5rem; color: var(--primary-color);">Apóstoles Rafael y Deisy de Salinas</h3>
                    <p style="font-weight: 700; margin-bottom: 10px;">Fundadores desde 1997</p>
                    <p class="text-muted">
                        Lideran la obra con pasión por el servicio, la restauración familiar y el compromiso inquebrantable con la extensión del Reino de Dios.
                    </p>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <p>© 2025 Iglesia Cristiana Al Amparo Del Altísimo (ICALA). <br> <small>Desarrollado por Jeider Solano</small></p>
        <div class="footer-links">
            <a href="#">Privacidad</a>
            <a href="#">Contacto</a>
            <a href="{{ url('/login') }}">Acceso Staff</a>
        </div>
    </footer>

</body>
</html>