<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Usuario | Consultoria Legal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/Style.css'])
</head>

<body>
    @if (session('access_token'))
        <script>
            localStorage.setItem('API_TOKEN', "{{ session('access_token') }}");
        </script>
    @endif

    <nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold brand-link" href="{{ url('/') }}">
                <img class="brand-logo d-inline-block align-top me-2" src="{{ asset('images/logo.png') }}"
                    alt="Logo de Consultoria Legal" style="height: 40px; width: auto; object-fit: contain;">
                <span>Consultoria Legal</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#userNav"
                aria-controls="userNav" aria-expanded="false" aria-label="Abrir navegacion">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="userNav">
                <ul class="navbar-nav ms-auto gap-lg-2 align-items-center">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/vista/cliente/servicios') }}">Servicios</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ url('/vista/cliente/solicitudes') }}">Solicitudes</a></li>

                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST"
                            onsubmit="localStorage.removeItem('API_TOKEN');" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm">Cerrar sesión</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @if (session('success'))
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    @if (session('errorMessage'))
        <div class="container mt-3">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('errorMessage') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <header class="page-hero py-5">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <span class="badge text-bg-primary mb-3">
                        Bienvenid@ {{ session('user_data') ? session('user_data')->nombre : 'Usuario' }} - Vista de usuario
                    </span>
                    <h1 class="display-6 fw-bold mb-3">Panel de solicitudes.</h1>
                    <p class="lead text-secondary mb-0">
                        Espacio limitado para consultar servicios, registrar solicitudes y revisar el estado de seguimiento.
                    </p>
                </div>
                <div class="col-lg-4">
                    <div class="quick-panel">
                        <div class="card-body p-4">
                            <h2 class="h5 mb-3">Accion disponible</h2>
                            <div class="d-grid gap-2">
                                <a href="{{ url('/vista/cliente/servicios') }}" class="btn btn-outline-primary">Ver servicios</a>
                                <a href="{{ url('/vista/cliente/solicitudes/nueva') }}" class="btn btn-primary">Nueva solicitud</a>
                                <a href="{{ url('/vista/cliente/solicitudes') }}" class="btn btn-outline-secondary">Ver solicitudes</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="py-5">
        <div class="container">
            <section class="section-panel">
                <div class="card-body p-4 p-lg-5">
                    <div class="row align-items-center g-4">
                        <div class="col-lg-8">
                            <h2 class="h4 mb-3 section-title">Modulo habilitado para usuario</h2>
                            <p class="text-secondary mb-0">
                                Esta vista separa el flujo del usuario final del panel administrativo. Desde aqui se consultan servicios y se gestionan solicitudes.
                            </p>
                        </div>
                        <div class="col-lg-4">
                            <div class="d-grid gap-2">
                                <a class="btn btn-primary btn-lg" href="{{ url('/vista/cliente/servicios') }}">Ver servicios</a>
                                <a class="btn btn-outline-primary btn-lg" href="{{ url('/vista/cliente/solicitudes') }}">Abrir solicitudes</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>