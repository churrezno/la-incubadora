@extends('adminlte::page')

@section('title', 'Editar Slate - ' . Str::ucfirst($slate->productor))

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

<div class="container ms-0 pt-3">
    <div class="clearfix">
        <a href="{{ route('slates.show', $slate->id) }}" class="btn btn-filter mt-3 mb-3 float-right">Volver al slate</a>
    </div>

    <h1>Editar Slate</h1>
    <p class="mb-0"><strong>Autor:</strong> {{ $slate->user->name }}</p>

    <form action="{{ route('slates.update', $slate) }}" method="POST" autocomplete="off" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="row mt-4">
            <div class="col">
                <select name="categoria_id" class="form-select {{ $errors->has('categoria_id') ? 'is-invalid' : '' }} mb-5">
                    <option value="">- Selecciona una categoría -</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ ( $categoria->name == $slate->categoria->name ) ? 'selected' : '' }}>{{ $categoria->name }}</option>
                    @endforeach
                </select>
                <x-ecam.error name='categoria_id' />
            </div>
        </div>

        <div class="row">
            <h4 class="mt-2 mb-3">Datos de Producción</h4>
            <div class="col">

                <x-ecam.input type="text" name="productor" label="Nombre y apellidos del productor/a" old_data="{{ $slate->productor }}" required />
                <small class="d-block mb-4">*En caso de haber varios productores/as, ésta será la persona que asistirá a las sesiones de La Incubadora, la receptora de la ayuda, así como el interlocutor/a del proyecto.</small>

                <x-ecam.input type="date" name="fecha_nac_productor" label="Fecha de nacimiento" old_data="{{ $slate->fecha_nac_productor }}" required />

                <p class="mt-4 mb-1 required required-tag">Sexo (por motivos estadísticos)</p>
                <div class="form-check ms-3">
                    <input class="form-check-input" type="radio" name="sexo_productor" id="sexoM" value="masculino" {{ ($slate->sexo_productor == 'masculino') ? 'checked' : '' }}>
                    <label class="form-check-label" for="sexoM">
                        Masculino
                    </label>
                </div>
                <div class="form-check ms-3">
                    <input class="form-check-input" type="radio" name="sexo_productor" id="sexoF" value="femenino" {{ ($slate->sexo_productor == 'femenino') ? 'checked' : '' }}>
                    <label class="form-check-label" for="sexoF">
                        Femenino
                    </label>
                </div>
                <div class="form-check ms-3">
                    <input class="form-check-input" type="radio" name="sexo_productor" id="sexoO" value="otro" {{ ($slate->sexo_productor == 'otro') ? 'checked' : '' }}>
                    <label class="form-check-label" for="sexoO">
                        Otro
                    </label>
                </div>
                <x-ecam.error name="sexo" />

                <x-ecam.input type="text" name="productora" label="Compañía productiva" old_data="{{ $slate->productora }}" class="mt-4" />

                <x-ecam.input type="tel" name="tel_productor" label="Teléfono" old_data="{{ $slate->tel_productor }}" required />

                <x-ecam.input type="text" name="cod_postal_productor" label="Código Postal" old_data="{{ $slate->cod_postal_productor }}" required />

                <x-ecam.input type="text" name="ciudad_productor" label="Ciudad" old_data="{{ $slate->ciudad_productor }}" required />

                <x-ecam.select-paises name="pais_productor" label="País" old_data="{{ $slate->pais_productor }}" required />

                <x-ecam.input type="email" name="email_productor" label="Email" old_data="{{ $slate->email_productor }}" required />

                <x-ecam.input type="url" name="web_productor" label="Web" old_data="{{ $slate->web_productor }}" />

            </div>

            <div class="col">
                <h5 class="required required-tag w-auto">Documentación</h5>

                @if( $documentacion = $slate->archivo()->where('archivo_tipo_id', 4)->first() )
                    <div class="mb-3">
                        <a href="{{ Storage::url($documentacion->url) }}" target="_blank" class="btn btn-sm btn-secondary">
                            <i class="fa-regular fa-fw fa-file-pdf"></i> Ver PDF actual
                        </a>
                        <small class="d-block text-muted mt-1">Sube un nuevo archivo para reemplazar el actual</small>
                    </div>
                @endif

                <label for="pdf_documentacion" class="form-label mb-3">
                    Adjunta un único documento en PDF con un máximo de 10 páginas y 20MB que incluya los siguientes documentos:
                    <ul>
                        <li>Biofilmografía.</li>
                        <li>Carta de motivación.</li>
                        <li>Descripción de la empresa (o la actividad profesional, en caso de que no hubiera empresa).</li>
                        <li>Breve descripción del slate de proyectos de la compañía.</li>
                        <li>En caso de ser empleado de otra empresa, breve descripción del rol y la responsabilidad dentro de la compañía y de los proyectos liderados.</li>
                    </ul>
                </label>
                <input class="form-control d-inline me-3" type="file" id="pdf_documentacion" name="pdf_documentacion" accept=".pdf">
                <x-ecam.error name="pdf_documentacion" />
            </div>
        </div>

        <div class="mt-5 float-end">
            <button class="btn btn-rojo" type="submit">Actualizar Slate</button>
        </div>
    </form>

</div>

@stop

@section('css')
    <x-assets />
@stop