<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Comunicación al usuario</title>
    </head>
    <body>
        <p>Hola {{ $data['username'] }}, te escribimos en relación a tu proyecto <em>{{ $data['inscripcion'] }}</em></p>
        <p>{!! $data['mensaje'] !!}</p>
        <img src="https://ecam-industria.es/media/LOGO-ECAM-INDUSTRIA-png.png" style="width: 120px; margin-top: 20px;" alt="ECAM">
    </body>
</html>