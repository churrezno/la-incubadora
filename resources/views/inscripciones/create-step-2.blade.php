<x-app-layout>

    <p class="mb-0">Paso 2 de 3</p>
    <h1>CONTACTO DEL SOLICITANTE</h1>
    <div class="progress-stacked mt-3 mb-5">
        <div class="progress" role="progressbar" aria-label="Paso 2" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="width: 33%">
            <div class="progress-bar">33%</div>
        </div>
    </div>

    <form action="{{ route('inscripciones.create.step.two.post', $inscripcion) }}" method="POST" autocomplete="off">

        @csrf
        
        <div class="row">
            <h4 class="mt-2 mb-3">Datos de Producción</h4>
            <div class="col">

                <x-ecam.input type="text" name="productora" label="Compañía productora" old_data="{{ $inscripcion?->productora ?? '' }}" required />

                <x-ecam.input type="tel" name="tel_productor" label="Teléfono" old_data="{{ $inscripcion?->tel_productor ?? '' }}" required />

                <x-ecam.input type="text" name="cod_postal_productor" label="Código Postal" old_data="{{ $inscripcion?->cod_postal_productor ?? '' }}" required />

                <x-ecam.input type="text" name="ciudad_productor" label="Ciudad" old_data="{{ $inscripcion?->ciudad_productor ?? '' }}" required />

                <x-ecam.select-paises name="pais_productor" label="País" old_data="{{ $inscripcion?->pais_productor ?? '' }}" required />

                <x-ecam.input type="email" name="email_productor" label="Email" old_data="{{ $inscripcion?->email_productor ?? '' }}" required />

                <x-ecam.input type="url" name="web_productor" label="Web" old_data="{{ $inscripcion?->web_productor ?? '' }}" />                
            </div>

            <div class="col">
                <x-ecam.input type="text" name="productor" label="Nombre y apellidos del productor/a" old_data="{{ $inscripcion?->productor ?? '' }}" required />
                <small class="d-block mb-4">*En caso de haber varios productores/as, ésta será la persona que asistirá a las sesiones de La Incubadora, la receptora de la ayuda, así como el interlocutor/a del proyecto.</small>
                    
                <x-ecam.input type="date" name="fecha_nac_productor" label="Fecha de nacimiento" old_data="{{ $inscripcion?->fecha_nac_productor ?? '' }}" required /> 
                    
                <p class="mt-4 mb-1 required required-tag">Sexo (por motivos estadísticos)</p>
                <div class="form-check ms-3">
                    <input class="form-check-input" type="radio" name="sexo_productor" id="sexoM" value="masculino" {{ ($inscripcion?->sexo_productor == 'masculino') ? 'checked' : '' }}>
                    <label class="form-check-label" for="sexoM">
                        Masculino
                    </label>
                </div>
                <div class="form-check ms-3">
                    <input class="form-check-input" type="radio" name="sexo_productor" id="sexoF" value="femenino" {{ ($inscripcion?->sexo_productor == 'femenino') ? 'checked' : '' }}>
                    <label class="form-check-label" for="sexoF">
                        Femenino
                    </label>
                </div>
                <div class="form-check ms-3">
                    <input class="form-check-input" type="radio" name="sexo_productor" id="sexoO" value="otro" {{ ($inscripcion?->sexo_productor == 'otro') ? 'checked' : '' }}>
                    <label class="form-check-label" for="sexoO">
                        Otro
                    </label>
                </div>
                <x-ecam.error name="sexo" />

                <h4 class="mt-5 mb-3">Datos de Coproducción</h4>
                
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input fs-6" type="checkbox" role="switch" id="switch_coproductor"  name="switch_coproductor" value=1 {{ ( $inscripcion?->switch_coproductor == true ) ? 'checked' : '' }}>
                    <label class="form-check-label" for="switch_coproductor">¿Existe coproductor/a?</label>
                </div>
                <x-ecam.input class="{{ ( $inscripcion?->switch_coproductor == 0) ? 'hidden' : '' }} mb-3" type="text" name="coproductor" label="Nombre y apellidos del coproductor" old_data="{{ $inscripcion?->coproductor ?? '' }}"/>
                
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input fs-6" type="checkbox" role="switch" id="switch_paises_coproduccion"  name="switch_paises_coproduccion" value=1 {{ ( $inscripcion?->switch_paises_coproduccion == true ) ? 'checked' : '' }}>
                    <label class="form-check-label" for="switch_paises_coproduccion">¿El proyecto sería una coproducción internacional?</label>
                </div>
                <x-ecam.input class="{{ ( $inscripcion?->switch_paises_coproduccion == 0) ? 'hidden' : '' }} mb-3" type="text" name="paises_coproduccion" label="Indica los países de coproducción" old_data="{{ $inscripcion?->paises_coproduccion ?? '' }}"/>
            </div>
        </div>

        <div class="mt-5 float-end">
            <a class="btn btn-filter" href="{{ route('inscripciones.create.step.one', $inscripcion) }}">Volver a Paso 1</a>
            <button class="btn btn-filter" type="submit" name="accion" value="guardar">Guardar y continuar más tarde</button>
            <button class="btn btn-rojo" type="submit" name="accion" value="continuar">Continuar a Paso 3</button>
        </div>
    </form>


    @section('js')
        <script>
            $(document).ready(function() {

                // Show/Hide inputs on switch change
                let allSwitches = $('input[role="switch"]');
                allSwitches.each(function(){
                    $(this).change(function(){
                        let target = $(this).closest('.form-switch').next('.form-floating');
                        target.find('input').val('');
                        target.slideToggle();
                    });
                });
            });
        </script>
    @stop
</x-app-layout>