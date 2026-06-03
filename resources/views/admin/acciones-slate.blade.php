@php
    $slate = App\Models\Slate::find($id);
@endphp

<div class="d-flex">

    <a class="btn" href="{{ route('slates.show', $slate) }}">
        <i class="fa-regular fa-fw fa-eye"></i>
    </a>
    <a id="btn_val_slate_{{ $slate->id }}" class="btn btn-valoraciones" role="button">
        <i class="fa-regular fa-fw fa-comments"></i>
    </a>

    @role('admin')
        <form>
            @csrf

            <button class="btn" type="button" onclick="removeSlate({{$id}})">
                <i class="fa-regular fa-fw fa-trash-can text-danger"></i>
            </button>
        </form>
    @endrole

</div>