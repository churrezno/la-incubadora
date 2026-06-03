@props ([
    'asignacionID',
    'valoracion'
])

<h3 class="mt-5 mb-3">Valora esta inscripción:</h3>

<form action="{{ route('valoracion.store', $asignacionID) }}" id="formValoracion"  method="POST" style="max-width: 960px;">

    @csrf

    <div class="row mb-4">
        <div class="col col-md-9">
            <x-ecam.textarea-valoracion name="guion" label="Guion" old_data="{{ $valoracion?->guion }}"/>
        </div>
        <div class="col col-md-3">
            <x-ecam.select-puntos name="puntos_guion" label="Puntos guion" old_data="{{ $valoracion?->puntos_guion }}" />
        </div>
    </div>
    <div class="row mb-4">
        <div class="col col-md-9">
            <x-ecam.textarea-valoracion name="financiacion" label="Financiación y viabilidad" old_data="{{ $valoracion?->financiacion }}"/>
        </div>
        <div class="col col-md-3">
            <x-ecam.select-puntos name="puntos_financiacion" label="Puntos financiación" old_data="{{ $valoracion?->puntos_financiacion }}" />
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-9">
            <x-ecam.textarea-valoracion name="solicitante" label="Solicitante" old_data="{{ $valoracion?->solicitante }}"/>
        </div>
        <div class="col col-md-3">
            <x-ecam.select-puntos name="puntos_solicitante" label="Puntos solicitante" old_data="{{ $valoracion?->puntos_solicitante }}"/>
        </div>
    </div>

    <x-ecam.input class="mb-5" input_class="form-control-plaintext" readonly type="text" name="puntos_total" label="Puntuación total" old_data="{{ $valoracion?->puntos_total }}"/>

    <button class="btn btn-rojo mb-5" type="submit">{{ $valoracion ? 'Actualizar' : 'Enviar' }} valoración</button>
</form>