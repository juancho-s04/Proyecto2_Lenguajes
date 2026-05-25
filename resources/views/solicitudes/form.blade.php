<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Solicitud | Consultoria Legal</title>
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
                <a class="btn btn-outline-primary" href="{{ url('/vista/cliente/solicitudes') }}">Volver a solicitudes</a>
                <a href="{{ url('/vista/cliente/solicitudes') }}" class="btn btn-outline-secondary">Cancelar</a>
            </div>
        </div>
    </nav>

    <main class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body p-4 p-lg-5">
                            <span class="badge text-bg-primary mb-3">Modulo de solicitudes</span>
                            <h1 class="h2 mb-3 page-title">{{ $formTitle }}</h1>
                            <p class="text-secondary mb-4">Registra los datos del solicitante y la consultoria que
                                desea.</p>

                            <form action="{{ $formAction }}" method="POST" class="row g-3">
                                @csrf
                                @if ($isEdit)
                                    @method('PUT')
                                @endif

                                @if ($isAdmin && !$isEdit)
                                    <div class="col-12">
                                        <label for="clienteId" class="form-label fw-semibold">Cliente</label>
                                        <select id="clienteId" name="clienteId" class="form-select" required>
                                            <option value="">Selecciona un cliente</option>
                                            @foreach ($clientes as $cliente)
                                                <option value="{{ $cliente->id }}"
                                                    {{ old('clienteId', $solicitudForm->clienteId ?? '') == $cliente->id ? 'selected' : '' }}>
                                                    {{ $cliente->nombre }} - {{ $cliente->correo }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif

                                @if ($isAdmin && $isEdit)
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Cliente</label>
                                        <div class="form-control bg-light">
                                            {{ $selectedCliente ? $selectedCliente->nombre . ' - ' . $selectedCliente->correo : ($solicitudForm->nombreSolicitante ?? '') . ' - ' . ($solicitudForm->correoSolicitante ?? '') }}
                                        </div>
                                    </div>
                                @endif

                                @if (!$isAdmin || $isEdit)
                                    <input type="hidden" name="clienteId"
                                        value="{{ old('clienteId', $solicitudForm->clienteId ?? '') }}">
                                @endif

                                @unless ($isAdmin)
                                    <div class="col-md-6">
                                        <label for="nombreSolicitante" class="form-label fw-semibold">Nombre del
                                            solicitante</label>
                                        <input id="nombreSolicitante" name="nombreSolicitante" class="form-control"
                                            value="{{ old('nombreSolicitante', $solicitudForm->nombreSolicitante ?? '') }}"
                                            required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="correoSolicitante" class="form-label fw-semibold">Correo
                                            electronico</label>
                                        <input id="correoSolicitante" name="correoSolicitante" type="email"
                                            class="form-control"
                                            value="{{ old('correoSolicitante', $solicitudForm->correoSolicitante ?? '') }}"
                                            required>
                                    </div>
                                @endunless

                                @if ($isAdmin)
                                    <input type="hidden" name="nombreSolicitante"
                                        value="{{ old('nombreSolicitante', $solicitudForm->nombreSolicitante ?? '') }}">
                                    <input type="hidden" name="correoSolicitante"
                                        value="{{ old('correoSolicitante', $solicitudForm->correoSolicitante ?? '') }}">

                                    <div class="col-md-6">
                                        <label for="estado" class="form-label fw-semibold">Estado</label>
                                        <select id="estado" name="estado" class="form-select" required>
                                            <option value="">Selecciona un estado</option>
                                            @foreach ($estadosSolicitud as $estado)
                                                @php $val = is_object($estado) && isset($estado->name) ? $estado->name : $estado; @endphp
                                                <option value="{{ $val }}"
                                                    {{ old('estado', $solicitudForm->estado ?? '') == $val ? 'selected' : '' }}>
                                                    {{ $val }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif

                                @unless ($isAdmin)
                                    <input type="hidden" name="estado"
                                        value="{{ old('estado', $solicitudForm->estado ?? '') }}">
                                @endunless

                                @if ($isAdmin)
                                    <div class="col-md-6">
                                        <label for="fecha" class="form-label fw-semibold">Fecha</label>
                                        <input id="fecha" name="fecha" type="date" class="form-control"
                                            value="{{ old('fecha', $solicitudForm->fecha ?? '') }}" required>
                                    </div>
                                @endif

                                @unless ($isAdmin)
                                    <input type="hidden" name="fecha"
                                        value="{{ old('fecha', $solicitudForm->fecha ?? '') }}">
                                @endunless

                                <input type="hidden" name="usuarioId"
                                    value="{{ old('usuarioId', $solicitudForm->usuarioId ?? '') }}">

                                <div class="col-12">
                                    <label for="consultoriaId" class="form-label fw-semibold">Consultoria que
                                        desea</label>
                                    <select id="consultoriaId" name="consultoriaId" class="form-select" required>
                                        <option value="">Selecciona una consultoria</option>
                                        @foreach ($consultorias as $consultoria)
                                            <option value="{{ $consultoria->id }}"
                                                {{ old('consultoriaId', $solicitudForm->consultoriaId ?? '') == $consultoria->id ? 'selected' : '' }}>
                                                {{ $consultoria->tipo }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label for="descripcion" class="form-label fw-semibold">Descripcion de la
                                        solicitud</label>
                                    <textarea id="descripcion" name="descripcion" class="form-control" rows="4" required>{{ old('descripcion', $solicitudForm->descripcion ?? '') }}</textarea>
                                </div>

                                <div class="col-12 d-flex gap-2 pt-2">
                                    <button type="submit" class="btn btn-primary">
                                        {{ $isAdmin && $isEdit ? 'Actualizar solicitud' : 'Enviar solicitud' }}
                                    </button>
                                    <a href="{{ url('/vista/solicitudes') }}"
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
