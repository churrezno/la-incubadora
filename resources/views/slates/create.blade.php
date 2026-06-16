<x-app-layout>

    <h1>CREA TU PERFIL DE SLATE</h1>

    <p>(Nº perfiles creados: {{ $numSlatesUser }})</p>

    @role('admin')
        <select name="categoria_id" class="form-select {{ $errors->has('categoria_id') ? 'is-invalid' : '' }} mb-5">
            <option value="">- Selecciona una categoría -</option>
            @foreach ($categorias as $categoria) 
                <option value="{{ $categoria->id }}" {{ ( $categoria->name == $slate?->categoria->name ) ? 'selected' : '' }}>{{ $categoria->name }}</option>
            @endforeach
        </select>
        <x-ecam.error name='categoria_id' />
    @endrole


    <form action="{{ route('slates.create', $slate) }}" method="POST" autocomplete="off" enctype="multipart/form-data">

        @csrf
        
        <div class="row">
            <h4 class="mt-5 mb-3">Datos de Producción</h4>
            <div class="col">
                <x-ecam.input type="text" name="productor" label="Nombre y apellidos del productor/a" old_data="{{ $slate?->productor ?? '' }}" required />
                <small class="d-block mb-4">*En caso de haber varios productores/as, ésta será la persona que asistirá a las sesiones de La Incubadora, la receptora de la ayuda, así como el interlocutor/a del proyecto.</small>
                    
                <x-ecam.input type="date" name="fecha_nac_productor" label="Fecha de nacimiento" old_data="{{ $slate?->fecha_nac_productor ?? '' }}" required /> 
                    
                <p class="mt-4 mb-1 required required-tag">Sexo (por motivos estadísticos)</p>
                <div class="form-check ms-3">
                    <input class="form-check-input" type="radio" name="sexo_productor" id="sexoM" value="masculino" {{ ($slate?->sexo_productor == 'masculino') ? 'checked' : '' }}>
                    <label class="form-check-label" for="sexoM">
                        Masculino
                    </label>
                </div>
                <div class="form-check ms-3">
                    <input class="form-check-input" type="radio" name="sexo_productor" id="sexoF" value="femenino" {{ ($slate?->sexo_productor == 'femenino') ? 'checked' : '' }}>
                    <label class="form-check-label" for="sexoF">
                        Femenino
                    </label>
                </div>
                <div class="form-check ms-3">
                    <input class="form-check-input" type="radio" name="sexo_productor" id="sexoO" value="otro" {{ ($slate?->sexo_productor == 'otro') ? 'checked' : '' }}>
                    <label class="form-check-label" for="sexoO">
                        Otro
                    </label>
                </div>
                <x-ecam.error name="sexo" />
            </div>
            
            <div class="col">                
                <x-ecam.input type="tel" name="tel_productor" label="Teléfono" old_data="{{ $slate?->tel_productor ?? '' }}" required />
                    
                <x-ecam.input type="email" name="email_productor" label="Email" old_data="{{ $slate?->email_productor ?? '' }}" required />
                
                <x-ecam.input type="text" name="cod_postal_productor" label="Código Postal" old_data="{{ $slate?->cod_postal_productor ?? '' }}" required />
                      
                <x-ecam.input type="text" name="ciudad_productor" label="Ciudad" old_data="{{ $slate?->ciudad_productor ?? '' }}" required />
                            
                <x-ecam.select-paises name="pais_productor" label="País" old_data="{{ $slate?->pais_productor ?? '' }}" required />                
                
                <x-ecam.input type="text" name="productora" label="Compañía productora" old_data="{{ $slate?->productora ?? '' }}" />

                <x-ecam.input type="url" name="web_productor" label="Web" old_data="{{ $slate?->web_productor ?? '' }}" /> 
            </div>

            
        </div>

        <div class="row">
            <div class="col">
                <h5 class="mt-5 required required-tag">Documentación</h5>
                <p for="pdf_documentacion" class="form-label mb-3">
                    Adjunta un único documento en PDF con un máximo de 10 páginas y 20MB que incluya los siguientes documentos:
                    <ul>
                        <li>Biofilmografía.</li>
                        <li>Carta de motivación.</li>
                        <li>Descripción de la empresa (o la actividad profesional, en caso de que no hubiera empresa).</li>
                        <li>Breve descripción del slate de proyectos de la compañía.</li>
                        <li>En caso de ser empleado de otra empresa, breve descripción del rol y la responsabilidad dentro de la compañía y de los proyectos liderados.</li>
                    </ul>
                </p>
                <input class="form-control d-inline me-3" type="file" id="pdf_documentacion" name="pdf_documentacion" accept=".pdf">
                <x-ecam.error name="pdf_documentacion" />
                @if( $documentacion = $slate->archivo()->where('archivo_tipo_id', 4)->first() )
                    @php                        
                        $documentacionUrl = Storage::url($documentacion->url);                
                    @endphp
                    <a href="{{ $documentacionUrl }}" target="_blank">
                        <i class="fa-regular fa-fw fa-file-pdf"></i>
                        Ver PDF Documentación
                    </a>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col">
                <h5 class="mt-5 mb-3 required required-tag">Aceptación de las bases</h5>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input fs-6" type="checkbox" role="switch" id="switch_acepta_bases"  name="switch_acepta_bases" value=1 {{ ( $slate?->switch_acepta_bases == 1 ) ? 'checked' : '' }}>
                    <label class="form-check-label" for="switch_acepta_bases">Confirmo que toda la información incluida sobre el proyecto es verídica. He entendido y acepto las <a href="{{ route('bases') }}">bases de participación</a> de La Incubadora 10.</label>
                </div>
                <x-ecam.error name="switch_acepta_bases" />
            </div>
        </div>

        <div class="row">
            <div class="col">
                <h5 class="mt-5 mb-3 required required-tag">Aceptación de Política de Privacidad y Cookies</h5>
                <p><b>Información básica sobre Protección de Datos</b><br>
                    Responsable: Escuela de Cinematografia y del Audiovisual de la Comunidad de Madrid - ECAM<br>
                    Finalidad: Registro como usuario de los servicios de “La Incubadora” de la web <a href="https://laincubadora.ecam-industria.es/" target="_blank">https://laincubadora.ecam-industria.es/</a> y envío de información sobre los servicios y actividades de la ECAM.<br>
                    Legitimación: Consentimiento del interesado/a.<br>
                    Destinatarios: No hay previsto ningun destinatario de los datos aportados.<br>
                    Derechos: Acceder, rectificar y suprimir los datos, así como otros derechos, según se indica en la información adicional.<br>
                    Información adicional: Puedes consultar la información adicional <a href="#">aquí.</a>
                </p>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input fs-6" type="checkbox" role="switch" id="switch_acepta_politica"  name="switch_acepta_politica" value=1 {{ ( $slate?->switch_acepta_politica == 1 ) ? 'checked' : '' }}>
                    <label class="form-check-label" for="switch_acepta_politica">He leído y entiendo la información facilitada y consiento el tratamiento de mis datos conforme a lo indicado.</label>
                </div>
                <x-ecam.error name="switch_acepta_politica" />
            </div>
        </div>

        <div class="mt-5 float-end">
            {{-- <button class="btn btn-rojo" type="submit">Enviar</button> --}}
            <button class="btn btn-rojo" type="submit" name="accion" value="guardar">Guardar y continuar más tarde</button>
            <button id="btn-send" class="btn btn-negro" type="submit" name="accion" value="enviar" onclick="submitPerfilSlate(event)">¡Enviar ya!</button>
        </div>
    </form>



    
    @if ( $isAdmin || 
          $numSlatesUser < 1 ||
          ($slate && !$slate->complete) )
    @else
        <strong>Has alcanzado el número máximo de perfiles</strong>
        <p>Puedes verlo <a href="/">aquí</a></p>
    @endif


    
    @section('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function submitPerfilSlate(e) {
                e.preventDefault();
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Ya no podrás editar tu perfil una vez enviado.",
                    icon: 'warning',
                    iconColor: '#FFC700',
                    showCancelButton: true,
                    confirmButtonColor: "#a4dd78",
                    cancelButtonColor: "#FC1048",
                    confirmButtonText: "Enviar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        let btnSend = document.getElementById("btn-send");
                        btnSend.removeAttribute('onclick');
                        btnSend.click();
                    }
                })
            }
        </script>
    @stop
</x-app-layout>

{{-- comment --}}




