<div class="d-flex">
    <button class="btn" type="button" onclick="restoreInscripcion({{$id}})">
        <i class="fa-solid fa-trash-arrow-up"></i>
    </button>
    <form>
        @csrf
        {{-- @method('delete') --}}
        {{-- <button class="btn" type="submit" onclick="return confirm('¿Seguro que quieres eliminar la inscripción?')"> --}}
        <button class="btn" type="button" onclick="forceRemoveInscripcion({{$id}})">
            <i class="fa-regular fa-fw fa-trash-can text-danger"></i>
        </button>
    </form>
</div>