<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Confirmación de inscripción en La Incubadora - DESARROLLO</title>
    </head>
    <body>
        <p>Hola, {{ $user->name }}</p>
        <p>Gracias por inscribirte en La Incubadora. Aquí están los detalles de tu inscripción:</p>

        <ul>
            <li><strong>Título del proyecto:</strong> {{ $inscripcion->titulo }}</li>
            <li><strong>Fecha de inscripción:</strong> {{ $inscripcion->updated_at->format('d/m/Y') }}</li>
        </ul>

        <p>¡Nos vemos pronto!</p>
        <img src="https://ecam.es/media/logo_La_Incubadora_negro_H.png" style="width: 300px; margin-top: 20px;" alt="ECAM">
    </body>
</html>