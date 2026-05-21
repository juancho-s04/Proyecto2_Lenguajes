<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultoría Legal | Plataforma de Gestión</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    @vite(['resources/css/index.css'])
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold brand-link brand-link-home" href="{{ url('/') }}">
                <img class="brand-logo" src="{{ asset('images/logo.png') }}" alt="Logo de Consultoría Legal">
                <span>Consultoría Legal</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
                aria-controls="mainNav" aria-expanded="false" aria-label="Abrir navegación">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto align-items-center align-items-lg-center gap-2 gap-lg-3">
                    <li class="nav-item"><a class="nav-link" href="#mision">Misión</a></li>
                    <li class="nav-item"><a class="nav-link" href="#servicios">Servicios</a></li>
                    <li class="nav-item"><a class="nav-link" href="#acceso">Acceso</a></li>

                    <li class="nav-item">
                        <a class="btn btn-outline-primary" href="{{ url('/registro') }}">Crear cuenta</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary px-4" href="{{ url('/login') }}">Iniciar sesión</a>
                    </li>

                    <li class="nav-item dropdown ms-lg-3">
                        <a class="nav-link dropdown-toggle btn btn-sm btn-light px-2" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            🌐 Idioma / Paneles
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end p-3" style="min-width: 200px;">
                            <li>
                                <div id="google_translate_element"></div>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-menu-item d-block p-1 text-decoration-none text-dark fw-bold"
                                    href="{{ url('/user') }}">Mi Panel</a></li>
                            <li><a class="dropdown-menu-item d-block p-1 mt-1 text-decoration-none text-dark fw-bold"
                                    href="{{ url('/admin') }}">Panel Admin</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero">
        <div class="container py-5">
            <div class="hero-copy">
                <span class="badge text-bg-light mb-3">Gestión profesional de consultorías</span>
                <h1 class="display-4 fw-bold mb-3">Consultoría Legal</h1>
                <p class="lead mb-4">
                    Una plataforma centralizada para administrar clientes, servicios de consultoría y solicitudes en
                    línea con seguimiento claro para usuarios y administradores.
                </p>
                <div class="d-flex flex-column flex-sm-row gap-3">
                    <a href="{{ url('/login') }}" class="btn btn-primary btn-lg px-4">Iniciar sesión</a>
                    <a href="{{ url('/registro') }}" class="btn btn-light btn-lg px-4">Crear cuenta de cliente</a>
                </div>
            </div>
        </div>
    </header>

    <main>
        <section class="stat-band">
            <div class="container">
                <div class="info-panel">
                    <div class="row g-0 text-center">
                        <div class="col-md-4 stat-item p-4">
                            <div class="h3 fw-bold text-primary mb-1">3</div>
                            <p class="text-secondary mb-0">Áreas de consultoría</p>
                        </div>
                        <div class="col-md-4 stat-item p-4">
                            <div class="h3 fw-bold text-primary mb-1">24/7</div>
                            <p class="text-secondary mb-0">Registro de solicitudes</p>
                        </div>
                        <div class="col-md-4 stat-item p-4">
                            <div class="h3 fw-bold text-primary mb-1">1</div>
                            <p class="text-secondary mb-0">Panel para cada rol</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="mision" class="py-5">
            <div class="container py-lg-4">
                <div class="row g-4 align-items-stretch">
                    <div class="col-lg-6">
                        <article class="info-panel h-100 p-4 p-lg-5">
                            <span class="section-kicker">Misión</span>
                            <h2 class="h3 mt-2 mb-3">Gestionar consultorías con eficiencia, seguridad y cercanía.</h2>
                            <p class="text-secondary mb-0">
                                Desarrollar una plataforma web integral que permita gestionar de forma eficiente los
                                servicios de consultoría legal, ambiental e industrial, facilitando la administración
                                de clientes, el seguimiento de asesorías y la atención de solicitudes en línea mediante
                                tecnologías modernas, seguras y accesibles.
                            </p>
                        </article>
                    </div>
                    <div class="col-lg-6">
                        <article class="info-panel h-100 p-4 p-lg-5">
                            <span class="section-kicker">Visión</span>
                            <h2 class="h3 mt-2 mb-3">Ser una solución digital confiable para empresas consultoras.</h2>
                            <p class="text-secondary mb-0">
                                Convertirse en una solución digital de referencia para pequeñas y medianas empresas de
                                consultoría, destacando por su eficiencia, organización y seguridad en la gestión de
                                servicios, contribuyendo a la transformación digital del sector con una experiencia
                                moderna, confiable y escalable.
                            </p>
                        </article>
                    </div>
                </div>
            </div>
        </section>

        <section id="servicios" class="py-5 bg-white border-top border-bottom">
            <div class="container">
                <div class="row align-items-end g-4 mb-4">
                    <div class="col-lg-7">
                        <span class="section-kicker">Servicios</span>
                        <h2 class="h3 mt-2 mb-0">Consultorías organizadas desde la primera solicitud.</h2>
                    </div>
                    <div class="col-lg-5">
                        <p class="text-secondary mb-0">
                            El sistema permite registrar, revisar y dar seguimiento a cada trámite desde una vista clara
                            para clientes y administradores.
                        </p>
                    </div>
                </div>

                <div id="servicesCarousel" class="carousel slide shadow-sm" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#servicesCarousel" data-bs-slide-to="0"
                            class="active" aria-current="true" aria-label="Consultoría legal"></button>
                        <button type="button" data-bs-target="#servicesCarousel" data-bs-slide-to="1"
                            aria-label="Consultoría ambiental"></button>
                        <button type="button" data-bs-target="#servicesCarousel" data-bs-slide-to="2"
                            aria-label="Consultoría industrial"></button>
                    </div>
                    <div class="carousel-inner rounded">
                        <div class="carousel-item active">
                            <img src="{{ asset('images/consultoria-legal.jpg') }}" class="d-block w-100"
                                alt="Documentos legales sobre una mesa de trabajo">
                            <div class="carousel-caption">
                                <h3 class="h2 fw-bold">Consultoría legal</h3>
                                <p class="mb-0">Seguimiento de casos, solicitudes y atención especializada desde una
                                    misma plataforma.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/consultoria-ambiental.jpg') }}" class="d-block w-100"
                                alt="Paisaje natural asociado a gestión ambiental">
                            <div class="carousel-caption">
                                <h3 class="h2 fw-bold">Consultoría ambiental</h3>
                                <p class="mb-0">Organización de solicitudes relacionadas con cumplimiento, análisis y
                                    asesoría ambiental.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/consultoria-industrial.jpg') }}" class="d-block w-100"
                                alt="Instalación industrial con estructura metálica">
                            <div class="carousel-caption">
                                <h3 class="h2 fw-bold">Consultoría industrial</h3>
                                <p class="mb-0">Control de servicios, responsables y estados para procesos de
                                    asesoría técnica.</p>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#servicesCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#servicesCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                </div>

                <div class="row g-4 mt-2">
                    <div class="col-md-4">
                        <article class="service-card p-4">
                            <h3 class="h5">Solicitudes en línea</h3>
                            <p class="text-secondary mb-0">Los clientes registran sus necesidades y consultan el avance
                                de cada solicitud.</p>
                        </article>
                    </div>
                    <div class="col-md-4">
                        <article class="service-card p-4">
                            <h3 class="h5">Panel administrativo</h3>
                            <p class="text-secondary mb-0">Los administradores gestionan clientes, usuarios,
                                consultorías y estados.</p>
                        </article>
                    </div>
                    <div class="col-md-4">
                        <article class="service-card p-4">
                            <h3 class="h5">Seguimiento centralizado</h3>
                            <p class="text-secondary mb-0">Cada trámite conserva fecha, descripción, servicio
                                solicitado y estado actual.</p>
                        </article>
                    </div>
                </div>
            </div>
        </section>

        <section id="acceso" class="access-band py-5">
            <div class="container">
                <div class="row align-items-center g-4">
                    <div class="col-lg-8">
                        <span class="badge text-bg-light mb-3">Acceso por rol</span>
                        <h2 class="h3 mb-3">Una entrada, dos experiencias de trabajo.</h2>
                        <p class="mb-0">
                            El inicio de sesión identifica si la cuenta corresponde a administrador o cliente y redirige
                            al panel correspondiente para mantener el flujo simple y ordenado.
                        </p>
                    </div>
                    <div class="col-lg-4">
                        <div class="d-grid gap-2">
                            <a href="{{ url('/login') }}" class="btn btn-light btn-lg">Iniciar sesión</a>
                            <a href="{{ url('/registro') }}" class="btn btn-outline-light btn-lg">Crear usuario
                                cliente</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="py-4 bg-white border-top">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
            <p class="mb-0 text-secondary">Consultoría Legal - Grupo: RLJ</p>
            <div class="d-flex gap-3">
                <a class="text-decoration-none text-secondary" href="{{ url('/login') }}">Login</a>
                <a class="text-decoration-none text-secondary" href="{{ url('/registro') }}">Registro</a>
            </div>
        </div>
    </footer>

    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'es',
                includedLanguages: 'en,es',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE
            }, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>