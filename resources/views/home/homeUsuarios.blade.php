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

        <nav class="navbar" style="background: var(--surface); box-shadow: var(--shadow); padding: 1rem 0;">
            <div class="navbar-content">
                <div class="logo">
                    <h1 style="color: var(--primary-color);">ICALA</h1>
                    <span style="font-size: 0.8rem; color: var(--text-muted);">Al Amparo Del Altísimo</span>
                </div>
                <div class="nav-links">
                    <a href="#mision" style="text-decoration: none; color: var(--text-main); margin: 0 10px; font-weight: 600;">Misión</a>
                    <a href="#servicios" style="text-decoration: none; color: var(--text-main); margin: 0 10px; font-weight: 600;">Servicios</a>
                    <a href="#liderazgo" style="text-decoration: none; color: var(--text-main); margin: 0 10px; font-weight: 600;">Liderazgo</a>
                    <a href="#recursos" style="text-decoration: none; color: var(--text-main); margin: 0 10px; font-weight: 600;">Eventos</a>
                </div>
                <div class="nav-action">
                    <a href="#" class="btn btn-primary">Donar Ahora</a>
                </div>
            </div>
        </nav>

          <main class="layout-container wide">
            
            <section id="mision" class="hero">
                <span class="badge badge-success" style="margin-bottom: 1rem;">BIENVENIDOS A CASA</span>
                <h1 style="line-height: 1.1; margin-bottom: 1.5rem;">Transformando Vidas <br><span style="color: var(--primary-color);">y Familias</span></h1>
                <p style="max-width: 600px; margin: 0 auto; color: var(--text-muted); font-size: 1.25rem; line-height: 1.6;">
                    Proclamamos el evangelio de Jesucristo para formar creyentes firmes, capacitados y llenos de propósito.
                </p>
                <div style="margin-top: 2rem; display: flex; gap: 1rem; justify-content: center;">
                    <a href="#servicios" class="btn btn-primary">Ver Horarios</a>
                    <a href="#recursos" class="btn btn-outline">Próximos Eventos</a>
                </div>
            </section>

            <section id="servicios" style="padding: 4rem 0;">
                <div style="text-align: center; margin-bottom: 3rem;">
                    <h2 style="font-size: 2rem;">Servicios Semanales</h2>
                    <p class="text-muted">Únete a nuestras celebraciones y tiempos de fe</p>
                </div>
                
                <div class="services-grid">
                    <div class="card-wrapper" style="border-top: 4px solid var(--success-color);">
                        <h3 style="display: flex; align-items: center; gap: 10px;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                            Viernes de Milagros
                        </h3>
                        <p class="badge badge-success" style="margin: 1rem 0;">7:00 P.M.</p>
                        <p class="text-muted">Intercesión, oración y búsqueda intensa de la presencia de Dios.</p>
                    </div>

                    <div class="card-wrapper" style="border-top: 4px solid var(--warning-color);">
                        <h3 style="display: flex; align-items: center; gap: 10px;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                            Expansión Sábado
                        </h3>
                        <p class="badge" style="background: var(--warning-color); color: white; margin: 1rem 0;">6:00 P.M.</p>
                        <p class="text-muted">Crecimiento espiritual y capacitación para el liderazgo efectivo.</p>
                    </div>

                    <div class="card-wrapper" style="border-top: 4px solid var(--primary-color);">
                        <h3 style="display: flex; align-items: center; gap: 10px;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"></path><path d="M2 17l10 5 10-5"></path><path d="M2 12l10 5 10-5"></path></svg>
                            Servicio Dominical
                        </h3>
                        <p class="badge" style="background: var(--primary-color); color: white; margin: 1rem 0;">8:00 A.M.</p>
                        <p class="text-muted">Nuestra celebración principal. Alabanza, adoración y Palabra viva.</p>
                    </div>
                </div>
            </section>

            <section id="liderazgo" style="padding: 4rem 0;">
                <div class="leadership-card" style="background: linear-gradient(to right, var(--surface), #f1f5f9); overflow: hidden;">
                    <div style="flex: 1; min-width: 300px;">
                        <h2 style="color: var(--primary-color); margin-bottom: 0.5rem;">Nuestro Liderazgo</h2>
                        <h3 style="font-size: 1.75rem; margin-bottom: 1.5rem;">Apóstoles Rafael y Deisy de Salinas</h3>
                        <p style="font-size: 1.1rem; line-height: 1.8; color: var(--text-muted); font-style: italic; border-left: 3px solid var(--primary-color); padding-left: 20px;">
                            "Desde 1997, nuestra pasión ha sido ver familias restauradas y corazones encendidos por el amor de Dios. Creemos en una iglesia que sirve y transforma su entorno."
                        </p>
                    </div>
                </div>
            </section>

            <section id="recursos" style="padding: 60px 0;">
                <h2 style="border-left: 5px solid var(--primary-color); padding-left: 15px; margin-bottom: 2rem;">Próximos Eventos</h2>
                <div class="services-grid">
                    @forelse($eventos as $evento)
                        <div class="card-wrapper" style="display: flex; flex-direction: column; justify-content: space-between;">
                            <div>
                                <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                                    <span class="badge badge-success">Evento</span>
                                   <small class="text-muted">
                                    {{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('d/m/Y')}}  a las  {{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('h:i A')}}
                                </small>
                                </div>
                                <h3 style="color: var(--primary-color); margin-bottom: 0.5rem;">{{ $evento->nombre }}</h3>
                                <p class="text-muted" style="font-size: 0.9rem;">{{ $evento->descripcion }}</p>
                            </div>
                            <div style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid var(--border-color); font-size: 0.8rem;">
                                <strong>Organiza:</strong> {{ $evento->admin->name ?? 'Sin asignar' }}
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">No hay eventos próximos.</p>
                    @endforelse
                </div>
            </section>
        </main>

        <footer class="footer" style="padding: 60px 0; background: var(--surface); border-top: 1px solid var(--border-color); text-align: center;">
            <p>© 2025 Iglesia Cristiana Al Amparo Del Altísimo (ICALA).</p>
            <p><small class="text-muted">Desarrollado por Jeider Solano</small></p>
            <div class="footer-links" style="margin-top: 1rem;">
                <a href="#" style="margin: 0 10px; color: var(--text-muted); text-decoration: none;">Privacidad</a>
                <a href="#" style="margin: 0 10px; color: var(--text-muted); text-decoration: none;">Contacto</a>
                <a href="{{ url('/login') }}" class="btn btn-outline" style="margin-left: 10px;">Acceso Staff</a>
            </div>
        </footer>

    </div> </body>
</html>