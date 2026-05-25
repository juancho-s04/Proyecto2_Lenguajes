<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333333;
            background-color: #f4f4f5;
            padding: 20px;
        }

        .card {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            max-width: 600px;
            margin: 0 auto;
            border: 1px solid #e4e4e7;
        }

        .header {
            border-bottom: 2px solid #3b82f6;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .title {
            color: #1d4ed8;
            margin: 0;
            font-size: 22px;
        }

        .info-item {
            margin-bottom: 10px;
            font-size: 15px;
        }

        .bold {
            font-weight: bold;
            color: #1f2937;
        }

        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #71717a;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="card">
        <div class="header">
            <h2 class="title">¡Hola! Tu solicitud ha sido recibida exitosamente</h2>
        </div>

        <p>Te confirmamos que hemos registrado tu solicitud en nuestra plataforma de Consultoría Legal. Nuestro equipo
            la revisará lo antes posible.</p>

        <div style="background-color: #f8fafc; padding: 15px; border-radius: 6px; margin: 20px 0;">
            <div class="info-item"><span class="bold">Número de Solicitud:</span> #{{ $solicitud->id }}</div>
            <div class="info-item"><span class="bold">Descripción del caso:</span> {{ $solicitud->descripcion }}</div>
            <div class="info-item"><span class="bold">Estado inicial:</span> Pendiente</div>
        </div>

        <p>Puedes seguir el avance en tiempo real ingresando a tu panel de usuario.</p>

        <div class="footer">
            Atentamente,<br>
            <strong>Equipo de Consultoría Legal (Grupo: RLJ)</strong>
        </div>
    </div>

</body>

</html>
