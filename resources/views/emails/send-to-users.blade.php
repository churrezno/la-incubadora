<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Comunicación al usuario</title>
    </head>
    <body>
        @php
            $tipo = $data['tipo'] ?? 'desarrollo';
            $proyectoLabel = $tipo == 'slate' ? 'perfil de Slate para' : 'proyecto';
        @endphp
        <p style="font-size: 1.25em;">Hola, <strong>{{ $data['username'] }}</strong></p>
        <p>Te escribimos en relación a tu {{ $proyectoLabel }} <em>{{ $data['inscripcion'] }}</em></p>
        <p>{!! $data['mensaje'] !!}</p>
        <img src="https://ecam-industria.es/media/LOGO-ECAM-INDUSTRIA-png.png" style="width: 120px; margin-top: 20px;" alt="ECAM">
        {{-- <img src="{{ Storage::url('/images/logo_La_Incubadora_negro.png') }}" style="width: 120px; margin-top: 20px;" alt="La Incubadora - ECAM">
        <img src="https://ecam-industria.es/media/logo_La_Incubadora_negro.png" style="width: 200px; margin-top: 20px;" alt="La Incubadora - ECAM"> --}}
    </body>
</html>