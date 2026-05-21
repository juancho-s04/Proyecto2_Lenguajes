<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes | Consultoria Legal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/Style.css'])
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold brand-link" href="{{ url('/') }}">
                <img class="brand-logo" src="{{ asset('images/logo.png') }}" alt="Logo de Consultoria Legal">
                <span>Consultoria Legal</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#solicitudesNav"
                aria-controls="solicitudesNav" aria-expanded="false" aria-label="Abrir navegacion">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="solicitudesNav">
                <ul class="navbar-nav ms-auto gap-lg-2">
                    @if ($isAdmin)
                        <li class="nav-item"><a class="nav-link" href="{{ url('/vista/clientes') }}">Clientes</a></li>
                        <li class="nav-item"><a class="nav-link"
                                href="{{ url('/vista/consultorias') }}">Consultorias</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/vista/usuarios') }}">Usuarios</a></li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ url('/vista/servicios') }}">Servicios</a></li>
                    @endif
                    <li class="nav-item"><a class="nav-link active"
                            href="{{ url('/vista/solicitudes') }}">Solicitudes</a></li>
                    <li class="nav-item"><a class="btn btn-outline-danger" href="{{ url('/auth/logout') }}">Cerrar
                            sesion</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="page-hero py-5">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <span class="badge text-bg-primary mb-3">Modulo de solicitudes</span>
                    <h1 class="display-6 fw-bold mb-3">
                        {{ $isAdmin ? 'Controla las solicitudes del proceso de punta a punta.' : 'Seguimiento de tus solicitudes de consultoria.' }}
                    </h1>
                    <p class="lead text-secondary mb-0">
                        {{ $isAdmin ? 'Revisa el avance de cada tramite, actualiza estados y conserva el historial operativo.' : 'Revisa el estado de tus tramites, consulta la informacion registrada y mantente al tanto del avance de cada solicitud.' }}
                    </p>
                </div>
                <div class="col-lg-4">
                    <div class="quick-panel">
                        <div class="card-body p-4">
                            <h2 class="h5 mb-3">Acciones rapidas</h2>
                            <div class="d-grid gap-2">
                                <a href="{{ url('/vista/solicitudes/nueva') }}" class="btn btn-primary">Nueva
                                    solicitud</a>
                                @if ($isAdmin)
                                    <a href="{{ url('/vista/consultorias') }}" class="btn btn-outline-secondary">Ver
                                        consultorias</a>
                                @else
                                    <a href="{{ url('/vista/servicios') }}" class="btn btn-outline-secondary">Ver
                                        servicios</a>
                                @endif
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
                <div class="card-body p-4">
                    <div
                        class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                        <div>
                            <h2 class="h4 mb-1 section-title">
                                {{ $isAdmin ? 'Listado de solicitudes' : 'Tus solicitudes' }}
                            </h2>
                            <p class="text-secondary mb-0">Seguimiento centralizado para solicitudes de clientes y
                                servicios contratados.</p>
                        </div>
                        <a class="btn btn-primary" href="{{ url('/vista/solicitudes/nueva') }}">Nueva solicitud</a>
                    </div>

                    @if (session('successMessage') || isset($successMessage))
                        <div class="alert alert-success">
                            {{ session('successMessage') ?? $successMessage }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Solicitante</th>
                                    <th>Correo</th>
                                    @if ($isAdmin)
                                        <th>Cliente</th>
                                    @endif
                                    <th>Descripcion</th>
                                    <th>Estado</th>
                                    <th>Fecha</th>
                                    <th>Consultoria deseada</th>
                                    @if ($isAdmin)
                                        <th class="text-end">Acciones</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @if ($solicitudes->isEmpty())
                                    <tr>
                                        <td colspan="{{ $isAdmin ? 9 : 7 }}" class="text-center text-secondary py-4">
                                            No hay solicitudes registradas todavia.
                                        </td>
                                    </tr>
                                @endif

                                @foreach ($solicitudes as $solicitud)
                                    <tr>
                                        <td>{{ $solicitud->id }}</td>
                                        <td>{{ $solicitud->nombreSolicitante }}</td>
                                        <td>{{ $solicitud->correoSolicitante }}</td>
                                        @if ($isAdmin)
                                            <td>{{ $solicitud->cliente ? $solicitud->cliente->nombre : 'Sin cliente' }}
                                            </td>
                                        @endif
                                        <td>{{ $solicitud->descripcion }}</td>
                                        <td>
                                            <span class="badge text-bg-light border">{{ $solicitud->estado }}</span>
                                        </td>
                                        <td>{{ $solicitud->fecha }}</td>
                                        <td>{{ $solicitud->consultoria ? $solicitud->consultoria->tipo : 'N/A' }}</td>

                                        @if ($isAdmin)
                                            <td class="text-end">
                                                <div class="d-inline-flex gap-2">
                                                    <a class="btn btn-sm btn-outline-primary"
                                                        href="{{ url('/vista/solicitudes/editar/' . $solicitud->id) }}">Editar</a>

                                                    <form
                                                        action="{{ url('/vista/solicitudes/eliminar/' . $solicitud->id) }}"
                                                        method="POST" class="m-0"
                                                        onsubmit="return confirm('Seguro que deseas eliminar esta solicitud?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-outline-danger">Eliminar</button>
                                                    </form>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
