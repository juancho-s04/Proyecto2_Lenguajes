<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Consultoria | Consultoria Legal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    @vite(['resources/css/Style.css'])
</head>

<body class="form-page">
    <nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold brand-link" href="{{ url('/') }}">
                <img class="brand-logo" src="{{ asset('images/logo.png') }}" alt="Logo de Consultoria Legal">
                <span>Consultoria Legal</span>
            </a>
            <div class="d-flex gap-2">
                <a class="btn btn-outline-primary" href="{{ url('/vista/consultorias') }}">Volver a consultorias</a>
                <a class="btn btn-outline-danger" href="{{ url('/auth/logout') }}">Cerrar sesion</a>
            </div>
        </div>
    </nav>

    <main class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body p-4 p-lg-5">
                            <span class="badge text-bg-primary mb-3">Modulo de consultorias</span>

                            <h1 class="h2 mb-3 page-title">{{ $formTitle }}</h1>
                            <p class="text-secondary mb-4">Registra el servicio que ofrece la empresa.</p>

                            <form action="{{ $formAction }}" method="POST" class="row g-3">
                                @csrf

                                @if (isset($consultoria) && $consultoria->id)
                                    @method('PUT')
                                @endif

                                <div class="col-12">
                                    <label for="tipo" class="form-label fw-semibold">Tipo</label>
                                    <select id="tipo" name="tipo" class="form-select" required>
                                        <option value="">Selecciona un tipo</option>
                                        <option value="Legal"
                                            {{ old('tipo', $consultoria->tipo ?? '') == 'Legal' ? 'selected' : '' }}>
                                            Legal</option>
                                        <option value="Ambiental"
                                            {{ old('tipo', $consultoria->tipo ?? '') == 'Ambiental' ? 'selected' : '' }}>
                                            Ambiental</option>
                                        <option value="Industrial"
                                            {{ old('tipo', $consultoria->tipo ?? '') == 'Industrial' ? 'selected' : '' }}>
                                            Industrial</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label for="descripcion" class="form-label fw-semibold">Descripcion</label>
                                    <textarea id="descripcion" name="descripcion" class="form-control" rows="4" required>{{ old('descripcion', $consultoria->descripcion ?? '') }}</textarea>
                                </div>

                                <div class="col-12 d-flex gap-2 pt-2">
                                    <button type="submit" class="btn btn-primary">Guardar consultoria</button>
                                    <a href="{{ url('/vista/consultorias') }}"
                                        class="btn btn-outline-secondary">Cancelar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
