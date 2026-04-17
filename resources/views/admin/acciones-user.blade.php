<div class="d-flex">
    <a class="btn" href="{{ route('users.edit', $id) }}">
        <i class="fa-solid fa-fw fa-edit"></i>
    </a>
    {{-- <form action="{{ route('users.destroy', $id) }}" method="POST"> --}}
    <form>
        @csrf
        {{-- @method('delete') --}}
        {{-- <button class="btn" type="submit" onclick="return confirm('¿Seguro que quieres eliminar el usuario?')"> --}}
        <button class="btn" type="button" onclick="removeUser({{$id}})">
            <i class="fa-regular fa-fw fa-trash-can text-danger"></i>
        </button>
    </form>
</div>