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
            
            <section id="mision" class="hero" style="padding: 80px 0; text-align: center;">
                <h1 style="color: var(--primary-color); font-size: 3rem; margin-bottom: 1rem;">Transformando Vidas y Familias</h1>
                <p class="text-muted" style="max-width: 700px; margin: 0 auto; font-size: 1.1rem;">
                    I.C.A.L.A proclama el evangelio de Jesucristo con el propósito de transformar vidas, formando creyentes firmes y capacitados.
                </p>
            </section>

            <section id="servicios" style="padding: 60px 0;">
                <h2 style="border-left: 5px solid var(--primary-color); padding-left: 15px; margin-bottom: 2rem;">Nuestros Servicios Semanales</h2>
                <div class="services-grid">
                    <div class="card-wrapper">
                        <h3 style="color: var(--primary-color);">Viernes de Milagros</h3>
                        <p class="badge badge-success" style="margin: 10px 0; display: inline-block;">7:00 P.M.</p>
                        <p class="text-muted">Un tiempo dedicado a la oración y manifestación de la fe.</p>
                    </div>
                    <div class="card-wrapper">
                        <h3 style="color: var(--primary-color);">Expansión Sábado</h3>
                        <p class="badge" style="background: var(--warning-color); color: white; margin: 10px 0; display: inline-block;">6:00 P.M.</p>
                        <p class="text-muted">Enfoque en el crecimiento y la capacitación.</p>
                    </div>
                    <div class="card-wrapper">
                        <h3 style="color: var(--primary-color);">Servicio Dominical</h3>
                        <p class="badge" style="background: var(--primary-color); color: white; margin: 10px 0; display: inline-block;">8:00 A.M.</p>
                        <p class="text-muted">Celebración principal y enseñanza de la Palabra.</p>
                    </div>
                </div>
            </section>

            <section id="liderazgo" style="padding: 60px 0;">
                <h2 style="border-left: 5px solid var(--primary-color); padding-left: 15px; margin-bottom: 2rem;">Nuestro Liderazgo</h2>
                <div class="leadership-card">
                    <div class="leadership-info">
                        <h3 style="color: var(--primary-color); font-size: 1.5rem;">Apóstoles Rafael y Deisy de Salinas</h3>
                        <p style="font-weight: 700; margin-bottom: 10px;">Fundadores desde 1997</p>
                        <p class="text-muted">
                            Lideran la obra con pasión por el servicio, la restauración familiar y el compromiso inquebrantable con la extensión del Reino de Dios.
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