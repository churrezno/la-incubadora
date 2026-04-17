@php
    $inscripcion = App\Models\Inscripcion::find($id);
@endphp

<div class="d-flex">

    <a class="btn" href="{{ route( 'inscripciones.show', $inscripcion ) }}">
        <i class="fa-regular fa-fw fa-eye"></i>
    </a>
    <a id="btn_val_inscripcion_{{ $inscripcion->id }}" class="btn btn-valoraciones" role="button">
        <i class="fa-regular fa-fw fa-comments"></i>
    </a>
    
    @role('admin')
        {{-- <form action="{{ route('inscripciones.destroy', $id) }}" method="POST"> --}}
        <form>
            @csrf
            {{-- @method('delete') --}}
            {{-- <button class="btn" type="submit" onclick="return confirm('¿Seguro que quieres eliminar la inscripción?')"> --}}
            <button class="btn" type="button" onclick="removeInscripcion({{$id}})">
                <i class="fa-regular fa-fw fa-trash-can text-danger"></i>
            </button>
        </form>
    @endrole

</div>