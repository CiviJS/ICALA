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
    <div class="landing-page">

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
                    <a href="#" class="btn btn-primary">Donar Ahora</a>
                </div>
            </div>
        </nav>

        <main class="layout-container wide">

            <section id="mision" class="hero">
                <span class="badge badge-success">BIENVENIDOS A CASA</span>
                <h1>Transformando Vidas <br><span>y Familias</span></h1>
                <p>
                    Proclamamos el evangelio de Jesucristo para formar creyentes firmes, capacitados y llenos de
                    propósito.
                </p>
                <div class="action-group">
                    <a href="#servicios" class="btn btn-primary">Ver Horarios</a>
                    <a href="#recursos" class="btn btn-outline">Próximos Eventos</a>
                </div>
            </section>

            <section id="servicios" class="section-padding">
                <div class="section-header">
                    <h2>Servicios Semanales</h2>
                    <p class="text-muted">Únete a nuestras celebraciones y tiempos de fe</p>
                </div>

                <div class="services-grid">
                    <div class="card-wrapper border-success">
                        <h3>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path
                                    d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                </path>
                            </svg>
                            Viernes de Milagros
                        </h3>
                        <span class="badge badge-success">7:00 P.M.</span>
                        <p class="text-muted">Intercesión, oración y búsqueda intensa de la presencia de Dios.</p>
                    </div>

                    <div class="card-wrapper border-warning">
                        <h3>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            Expansión Sábado
                        </h3>
                        <span class="badge badge-warning">6:00 P.M.</span>
                        <p class="text-muted">Crecimiento espiritual y capacitación para el liderazgo efectivo.</p>
                    </div>

                    <div class="card-wrapper border-primary">
                        <h3>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                                <path d="M2 17l10 5 10-5"></path>
                                <path d="M2 12l10 5 10-5"></path>
                            </svg>
                            Servicio Dominical
                        </h3>
                        <span class="badge badge-primary">8:00 A.M.</span>
                        <p class="text-muted">Nuestra celebración principal. Alabanza, adoración y Palabra viva.</p>
                    </div>
                </div>
            </section>

            <section id="liderazgo" class="section-padding">
                <div class="leadership-card">
                    <div class="leadership-content">
                        <h2>Nuestro Liderazgo</h2>
                        <h3>Apóstoles Rafael y Deisy de Salinas</h3>
                        <p class="quote">
                            "Desde 1997, nuestra pasión ha sido ver familias restauradas y corazones encendidos por el
                            amor de Dios. Creemos en una iglesia que sirve y transforma su entorno."
                        </p>
                    </div>
                </div>
            </section>

            <section id="recursos" class="section-padding">
                <h2 class="section-title-alt">Próximos Eventos</h2>
                <div class="services-grid">
                    @forelse($eventos as $evento)
                        <div class="card-wrapper border-primary event-card">
                            <div>
                                <span class="badge badge-success">Fecha de inicio:</span>
                                <span class="event-date">
                                    {{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('d/m/Y') }} a las
                                    {{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('h:i A') }}
                                </span>
                                <h3>{{ $evento->nombre }}</h3>
                                <p class="text-muted">{{ $evento->descripcion }}</p>
                            </div>

                            <div class="event-footer">
                                <span>Organiza:</span> <strong>{{ $evento->admin->name ?? 'Sin asignar' }}</strong>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">No hay eventos próximos.</p>
                    @endforelse
                </div>
            </section>
        </main>

        <footer class="footer">
            <p>© 2025 Iglesia Cristiana Al Amparo Del Altísimo (ICALA).</p>
            <p><small class="text-muted">Desarrollado por Jeider Solano</small></p>
            <div class="footer-links">
                <a href="#">Privacidad</a>
                <a href="#">Contacto</a>
                <a href="{{ url('/login') }}" class="btn btn-outline">Acceso Staff</a>
            </div>
        </footer>

    </div>
</body>

</html>
