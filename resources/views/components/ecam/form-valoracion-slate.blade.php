@props ([
    'asignacionID',
    'valoracion'
])

<h3 class="mt-5 mb-3">Valora este perfil:</h3>

<form action="{{ route('valoracion.store.slate', $asignacionID) }}" id="formValoracion"  method="POST" style="max-width: 960px;">

    @csrf

    <div class="row mb-4">
        <div class="col col-md-9">
            <x-ecam.textarea-valoracion name="comentarios" label="Comentarios" old_data="{{ $valoracion?->comentarios }}"/>
        </div>
        <div class="col col-md-3">
            <x-ecam.select-puntos name="puntos" label="Puntos" old_data="{{ $valoracion?->puntos }}" />
        </div>
    </div>

    <button class="btn btn-rojo mb-5" type="submit">{{ $valoracion ? 'Actualizar' : 'Enviar' }} valoración</button>
</form>