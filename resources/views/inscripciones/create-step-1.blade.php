<x-app-layout>

    <p class="mb-0">Paso 1 de 3</p>
    <h1>¿QUÉ PROYECTO QUIERES INCUBAR?</h1>
    <div class="progress-stacked mt-3 mb-5">
        <div class="progress" role="progressbar" aria-label="Paso 1" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 25px">
            <div class="progress-bar">0%</div>
        </div>
    </div>

    <p>(Nº inscripciones ya hechas: {{ $numInscripcionesUser }})</p>
    
    @if ( $isAdmin || 
          $numInscripcionesUser < 2 ||
          ($inscripcion && !$inscripcion->complete) )

        <form action="{{ route('inscripciones.create.step.one.post', $inscripcion) }}" method="POST" autocomplete="off" enctype="multipart/form-data">

            @csrf

            @role('admin')
                <select name="categoria_id" class="form-select {{ $errors->has('categoria_id') ? 'is-invalid' : '' }} mb-5">
                    <option value="">- Selecciona una categoría -</option>
                    @foreach ($categorias as $categoria) 
                        <option value="{{ $categoria->id }}" {{ ( $categoria->name == $inscripcion?->categoria->name ) ? 'selected' : '' }}>{{ $categoria->name }}</option>
                    @endforeach
                </select>
                <x-ecam.error name='categoria_id' />
            @endrole

            <div class="row align-items-start">
                <h4 class="mb-3">Título y portada</h4>
                <div class="col">
                    <x-ecam.input class="mt-2" type="text" name="titulo" label="Título del proyecto" old_data="{{ $inscripcion?->titulo ?? '' }}" required />
                </div>
                <div class="col">
                    <label for="portada" class="form-label">Imagen del proyecto (20MB máx.)</label>
                    <input class="form-control" type="file" id="portada" name="portada" accept="image/*">
                </div>
                <div class="col align-self-start">
                    <div class="image-wrapper">
                        @php
                            $imageUrl = Storage::url('/images/portada_default.jpg');
                            if( $portada = $inscripcion?->archivos()->where('archivo_tipo_id', 1)->first() )
                                $imageUrl = Storage::url($portada->url);
                        @endphp
                        <img id="picture" src="{{ $imageUrl }}" alt="Portada">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <h4 class="mt-5 mb-3">Datos de Dirección</h4>

                    <x-ecam.input type="text" name="director" label="Nombre y apellidos del director/a" old_data="{{ $inscripcion?->director ?? '' }}" required/>

                    <x-ecam.input type="date" name="fecha_nac_director" label="Fecha de nacimiento" old_data="{{ $inscripcion?->fecha_nac_director ?? '' }}" required/> 

                    <p class="mt-4 mb-1 required required-tag">Sexo (por motivos estadísticos)</p>
                    <div class="form-check ms-3">
                        <input class="form-check-input" type="radio" name="sexo_director" id="sexoM" value="masculino" {{ ($inscripcion?->sexo_director == 'masculino') ? 'checked' : '' }}>
                        <label class="form-check-label" for="sexoM">
                            Masculino
                        </label>
                    </div>
                    <div class="form-check ms-3">
                        <input class="form-check-input" type="radio" name="sexo_director" id="sexoF" value="femenino" {{ ($inscripcion?->sexo_director == 'femenino') ? 'checked' : '' }}>
                        <label class="form-check-label" for="sexoF">
                            Femenino
                        </label>
                    </div>
                    <div class="form-check ms-3">
                        <input class="form-check-input" type="radio" name="sexo_director" id="sexoO" value="otro" {{ ($inscripcion?->sexo_director == 'otro') ? 'checked' : '' }}>
                        <label class="form-check-label" for="sexoO">
                            Otro
                        </label>
                    </div>
                    <x-ecam.error name="sexo" />

                    <div class="form-check form-switch mt-4 mb-3">
                        <input class="form-check-input fs-6" type="checkbox" role="switch" id="switch_largometrajes"  name="switch_largometrajes" value=1 {{ ( (!$inscripcion || $inscripcion->switch_largometrajes == true) ) ? 'checked' : '' }}>
                        <label class="form-check-label" for="switch_largometrajes">¿Es el primer largometraje del director/a?</label>
                    </div>
                    <x-ecam.input class="{{ ( !$inscripcion || $inscripcion->switch_largometrajes == 1 ) ? 'hidden' : '' }} mb-3" type="text" name="largometrajes" label="Otros largometrajes" old_data="{{ $inscripcion?->largometrajes ?? '' }}"/> 

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input fs-6" type="checkbox" role="switch" id="switch_codirector"  name="switch_codirector" value=1 {{ ( $inscripcion?->switch_codirector == true ) ? 'checked' : '' }}>
                        <label class="form-check-label" for="switch_codirector">¿Existe codirector/a?</label>
                    </div>
                    <x-ecam.input class="{{ ( $inscripcion?->switch_codirector == 0 ) ? 'hidden' : '' }} mb-3" type="text" name="codirector" label="Nombre y apellidos del codirector/a" old_data="{{ $inscripcion?->codirector ?? '' }}"/> 
                </div>

                <div class="col">
                    <h4 class="mt-5 mb-3">Datos de Guion</h4>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input fs-6" type="checkbox" role="switch" id="switch_guionista"  name="switch_guionista" value=1 {{ ( !$inscripcion || $inscripcion->switch_guionista == true ) ? 'checked' : '' }}>
                        <label class="form-check-label" for="switch_guionista">¿El director/a es el guionista?</label>
                    </div>
                    <x-ecam.input class="{{ ( !$inscripcion || $inscripcion->switch_guionista == 1 ) ? 'hidden' : '' }} mb-3" type="text" name="guionista" label="Nombre y apellidos del guionista" old_data="{{ $inscripcion?->guionista ?? '' }}"/> 

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input fs-6" type="checkbox" role="switch" id="switch_coguionista"  name="switch_coguionista" value=1 {{ ( $inscripcion?->switch_coguionista == true ) ? 'checked' : '' }}>
                        <label class="form-check-label" for="switch_coguionista">¿Existe coguionista?</label>
                    </div>
                    <x-ecam.input class="{{ ( $inscripcion?->switch_coguionista == 0 ) ? 'hidden' : '' }} mb-3" type="text" name="coguionista" label="Nombre y apellidos del coguionista" old_data="{{ $inscripcion?->coguionista ?? '' }}"/> 
                </div>
            </div>

            
            <button class="btn btn-rojo float-end" type="submit">Continuar a Paso 2</button>
        </form>

    @else
        <strong>Has alcanzado el número máximo de inscripciones</strong>
        <p>Puedes verlas <a href="/">aquí</a></p>
    @endif


    @section('css')
        <style>
            .image-wrapper {
                position: relative;
                padding-bottom: 56.25%;
            }
            .image-wrapper img {
                position: absolute;
                object-fit: cover;
                width: 100%;
                height: 100%;
            }
        </style>
    @stop

    @section('js')
        <script>
            $(document).ready(function() {

                // Show/Hide inputs on switch change
                let allSwitches = $('input[role="switch"]');
                allSwitches.each(function(){
                    $(this).change(function() {
                        let target = $(this).closest('.form-switch').next('.form-floating');
                        target.find('input').val('');
                        target.slideToggle();
                    });
                });

                // Change image preview when upload file
                document.getElementById("portada").addEventListener('change', cambiarImagen);
                
                function cambiarImagen(event){
                    var file = event.target.files[0];
                    var reader = new FileReader();
                    reader.onload = (event) => {
                        document.getElementById("picture").setAttribute('src', event.target.result);
                    };
                    reader.readAsDataURL(file);
                }

            });
        </script>
    @stop
</x-app-layout>

{{-- comment --}}




