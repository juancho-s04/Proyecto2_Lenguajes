<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios | Consultoria Legal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/Style.css') }}" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold brand-link" href="{{ url('/') }}">
                <img class="brand-logo" src="{{ asset('images/logo.png') }}" alt="Logo de Consultoria Legal">
                <span>Consultoria Legal</span>
            </a>
            <div class="d-flex gap-2">
                <a class="btn btn-outline-primary" href="{{ url('/admin') }}">Panel admin</a>
                <a class="btn btn-outline-danger" href="{{ url('/auth/logout') }}">Cerrar sesion</a>
            </div>
        </div>
    </nav>

    <main class="py-5">
        <div class="container">
            <section class="section-panel">
                <div class="card-body p-4">
                    <div
                        class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                        <div>
                            <span class="badge text-bg-primary mb-3">Modulo de usuarios</span>
                            <h1 class="h3 mb-1 page-title">Usuarios registrados</h1>
                            <p class="text-secondary mb-0">Administra las cuentas que pueden ingresar al sistema.</p>
                        </div>
                        <a class="btn btn-primary" href="{{ url('/vista/usuarios/nuevo') }}">Nuevo usuario</a>
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
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Rol</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (empty($usuarios) || count($usuarios) === 0)
                                    <tr>
                                        <td colspan="5" class="text-center text-secondary py-4">
                                            No hay usuarios registrados todavia.
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($usuarios as $usuario)
                                        <tr>
                                            <td>{{ $usuario->id }}</td>
                                            <td>{{ $usuario->nombre }}</td>
                                            <td>{{ $usuario->email }}</td>
                                            <td>
                                                <span class="badge text-bg-light border">
                                                    {{ $usuario->rol->nombre ?? $usuario->rol_nombre }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a class="btn btn-sm btn-outline-primary"
                                                        href="{{ url('/vista/usuarios/editar/' . $usuario->id) }}">
                                                        Editar
                                                    </a>
                                                    <form
                                                        action="{{ url('/vista/usuarios/eliminar/' . $usuario->id) }}"
                                                        method="POST" class="m-0"
                                                        onsubmit="return confirm('Seguro que deseas eliminar este usuario? Tambien se quitara de clientes si aplica.');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-outline-danger">Eliminar</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
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
