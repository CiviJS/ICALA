<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ministerio ICALA - Inicio</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/ICALA.jpg') }}">

    @vite(['resources/css/home/index.css'])
<body>

    <!-- BARRA DE NAVEGACIÓN -->
    <nav class="navbar">
        <div class="navbar-content">
            <!-- Logo / Nombre -->
         
            <div class="logo">
                <h1>ICALA</h1>

                <span>Al Amparo Del Altísimo</span>
            </div>
            <!-- Links de Navegación (Desktop) -->
            <div class="nav-links">
                <a href="#mision">Misión</a>
                <a href="#servicios">Servicios</a>
                <a href="#liderazgo">Liderazgo</a>
                <a href="#recursos">Eventos y Recursos</a>
            </div>
            <!-- Botón de Acción (Desktop) -->
            <div class="nav-action">
                <a href="#" class="btn-accent">
                    Donar Ahora
                </a>
            </div>
        </div>
    </nav>

    <main class="container">
        
        <!-- SECCIÓN HERO / MISIÓN Y PROPÓSITO -->
        <section id="mision" class="hero">
            <h1>Transformando Vidas y Familias</h1>
            <p>
                I.C.A.L.A (Iglesia Cristiana Al Amparo del Altísimo) proclama el evangelio de Jesucristo con el propósito de transformar vidas. Nos dedicamos a formar creyentes firmes y capacitados para extender su Reino en la tierra.
            </p>
        </section>
              <!-- SECCIÓN DE EVENTOS Y RECURSOS -->
        <section id="recursos">
            <h2 style="margin-bottom: 20px;">Eventos y Recursos</h2>
            
            <div class="resources-grid">
                
                <!-- Eventos Próximos -->
                <div class="event-list">
                    <h3>Próximos Eventos!</h3>
               
                </div>
                
                <!-- Recursos y Formación -->
                <div class="event-list">
                    <h3>📚 Recursos para el Crecimiento</h3>
                    <div class="resource-links">
                        <a href="#">Discipulado</a>
                        <a href="#">Instituto Bíblico</a>
                        <a href="#">Devocional</a>
                    </div>
                </div>
                
            </div>
        </section>

        <!-- SECCIÓN DE SERVICIOS Y HORARIOS PUEDEN VENIR DEL CONTROLLER  -->
        <section id="servicios">
            <h2>Nuestros Servicios Semanales</h2>
            
            <div class="services-grid">
                <!-- Tarjeta: Viernes -->
                <div class="service-card">
                    <h3>Viernes de Milagros</h3>
                    <p class="time" style="color: var(--info);">7:00 P.M.</p>
                    <p class="text-secondary">Un tiempo dedicado a la oración, sanidad y manifestación de la fe.</p>
                </div>
                
                <!-- Tarjeta: Sábado -->
                <div class="service-card">
                    <h3>Expansión Sábado</h3>
                    <p class="time" style="color: var(--accent);">6:00 P.M.</p>
                    <p class="text-secondary">Servicio enfocado en el crecimiento y la capacitación para la obra.</p>
                </div>
                
                <!-- Tarjeta: Domingo -->
                <div class="service-card">
                    <h3>Servicio Dominical</h3>
                    <p class="time" style="color: var(--primary);">8:00 A.M.</p>
                    <p class="text-secondary">Celebración principal y enseñanza de la Palabra de Dios.</p>
                </div>
            </div>
            
            <p style="text-align: center; margin-top: 40px; color: var(--secondary); font-size: 1.1rem;">
                ¡También te invitamos a ser parte de nuestro servicio <b>En Vivo!</b>
            </p>
        </section>

        <!-- SECCIÓN DE LIDERAZGO -->
        <section id="liderazgo">
            <h2>Nuestro Liderazgo</h2>
            
            <div class="leadership-card">
                <!-- Imagen/Placeholder -->
                <div class="leadership-img">
                    <span>👑</span>
                </div>
                
                <!-- Texto -->
                <div class="leadership-info">
                    <h3>Apóstoles Rafael y Deisy de Salinas</h3>
                    <p style="font-size: 0.9rem; color: var(--secondary); margin-bottom: 10px;">Fundadores y Guías del Ministerio ICALA desde 1997.</p>
                    <p>
                        Lideran la obra con pasión por el servicio, la enseñanza bíblica y el compromiso inquebrantable con la restauración familiar, destacándose en la extensión del Reino de Dios.
                    </p>
                </div>
            </div>
        </section>

  
        
    </main>

    <!-- FOOTER -->
    <footer class="footer">
        <p class="mb-2" style="margin-bottom: 10px;">© 2025 Iglesia Cristiana Al Amparo Del Altísimo (ICALA). Todos los derechos reservados a jeider solano(por ahora) .</p>
        <div class="footer-links">
            <a href="">Privacidad</a>
            <a href="">Contacto</a>
            <a href="">Redes Sociales</a>
        </div>
    </footer>

</body>
</html>