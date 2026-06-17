@php
    $slate = App\Models\Slate::find($id);
    $comites = App\Models\User::role('comite')->get();
    $categorias = App\Models\Categoria::all();
    $user = auth()->user();
@endphp

<div class="row">
    @role('admin')
        <div class="col col-md-2">
            <div class="mt-4 mb-2 fw-bold">Asignado a:</div>
            
            <form id="form_slate_{{ $slate->id }}">
                @csrf
                <fieldset>
                    @foreach ($comites as $comite)
                        <div class="form-check">
                            <input class="form-check-input"
                                    type="checkbox"
                                    value="{{ $comite->id }}"
                                    id="user_{{ $comite->id }}"
                                    name="user_{{ $comite->id }}"
                                    {{ $slate->checkComite($comite->id, $slate->asignaciones) ? 'checked' : '' }}
                            >
                            <label class="form-check-label" for="user_{{ $comite->id }}">
                                {{ $comite->name }}
                            </label>
                        </div>
                    @endforeach
                </fieldset>            
                <input type="hidden" name="id_slate" value="{{ $slate->id }}" />
                
                <button id="slate_{{ $slate->id }}" class="btn btn-rojo mt-3" type="button" onclick="updateAsignacionesSlate(event)">Actualizar</button>
            </form>
        </div>

        <div class="col col-md-2">
            <div class="mt-4 mb-2 fw-bold">Categoria:</div>
            <form id="form_cat_slate_{{ $slate->id }}">
                @csrf
                <select name="categoria_id" class="form-select {{ $errors->has('categoria_id') ? 'is-invalid' : '' }} mb-2">
                    <option value="">- Selecciona una categoría -</option>
                    @foreach ($categorias as $categoria) 
                        <option value="{{ $categoria->id }}" {{ ( $categoria->name == $slate->categoria->name ) ? 'selected' : '' }}>{{ $categoria->name }}</option>
                    @endforeach
                </select>
<x-ecam.error name='categoria_id' />
                <input type="hidden" name="id_slate" value="{{ $slate->id }}" />
                <button id="cat_slate_{{ $slate->id }}" class="btn btn-rojo mt-3" type="button" onclick="updateCategoriaSlate(event, {{$slate->id}})">Actualizar</button>
            </form>
        </div>
    @endrole

<div class="col col-md-8">
        @foreach ($slate->valoracionesSlate as $valoracion)
            {{-- Slo visible para admin o current user --}}
            @if ($user && ($user->hasRole('admin') || $valoracion->asignacion?->user_id == $user->id))
                <x-ecam.valoracion-slate :idValoracion="$valoracion->id" />
            @endif
        @endforeach
    </div>
</div>
