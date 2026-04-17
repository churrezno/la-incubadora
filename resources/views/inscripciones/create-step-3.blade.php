<x-app-layout>

    <p class="mb-0">Paso 3 de 3</p>
    <h1>DATOS DEL PROYECTO</h1>
    <div class="progress-stacked mt-3 mb-5">
        <div class="progress" role="progressbar" aria-label="Paso 3" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100" style="width: 66%">
            <div class="progress-bar">66%</div>
        </div>
    </div>

    <form action="{{ route('inscripciones.create.step.three.post', $inscripcion) }}" method="POST" autocomplete="off" enctype="multipart/form-data">

        @csrf
        
        <div class="row">
            <h4 class="mt-2 mb-3">Datos del Equipo</h4>
            <div class="col">
                <x-ecam.textarea-inscripcion
                        name="biofilmografia_director"
                        label="Biofilmografía del director/a"
                        description="Formación y trayectoria"
                        required
                        old_data="{!! $inscripcion?->biofilmografia_director ?? false !!}"/>

                <h5 class="mt-5">Trabajo previo del director/a</h5>
                <p>Por favor, incluye enlaces con contraseña con el título de tus trabajos previos que quieras mostrarnos. Puedes añadir hasta 3 trabajos.<br>No está permitido subir archivos de vídeo. Si quieres adjuntar tu trabajo previo, un teaser, o un vídeo tuyo pitcheando el proyecto, preferimos links con contraseña.</p>
                <div class="input-group">
                    <x-ecam.input type="text" name="titulo_1" label="Título" old_data="{{ $inscripcion?->titulo_1 ?? '' }}"/>
                    <x-ecam.input type="text" name="link_1" label="Link" old_data="{{ $inscripcion?->link_1 ?? '' }}"/>
                    <x-ecam.input type="text" name="password_1" label="Contraseña" old_data="{{ $inscripcion?->password_1 ?? '' }}"/>
                </div>
                <div class="input-group">
                    <x-ecam.input type="text" name="titulo_2" label="Título" old_data="{{ $inscripcion?->titulo_2 ?? '' }}"/>
                    <x-ecam.input type="text" name="link_2" label="Link" old_data="{{ $inscripcion?->link_2 ?? '' }}"/>
                    <x-ecam.input type="text" name="password_2" label="Contraseña" old_data="{{ $inscripcion?->password_2 ?? '' }}"/>
                </div>
                <div class="input-group">
                    <x-ecam.input type="text" name="titulo_3" label="Título" old_data="{{ $inscripcion?->titulo_3 ?? '' }}"/>
                    <x-ecam.input type="text" name="link_3" label="Link" old_data="{{ $inscripcion?->link_3 ?? '' }}"/>
                    <x-ecam.input type="text" name="password_3" label="Contraseña" old_data="{{ $inscripcion?->password_3 ?? '' }}"/>
                </div>

                <x-ecam.textarea-inscripcion
                        name="nota_director"
                        label="Nota del director/a"
                        description="¿Qué película quiere hacer y por qué? Estilo, tono visual, motivaciones, vinculación con el proyecto, etc."
                        old_data="{!! $inscripcion?->nota_director ?? false !!}"
                        required
                        class="mt-5" />

                <x-ecam.textarea-inscripcion
                        name="biofilmografia_productora"
                        label="Biofilmografía de la productora"
                        description="Formación y trayectoria del productor/a solicitante y su compañía productora. En caso de ser seleccionado/a, la persona solicitante se compromete a las obligaciones contenidas en las Bases y será el/la interlocutor/a del proyecto con La Incubadora. Si en el proyecto hay más de una productora puedes especificar aquí su biofilmografía. Recuerda que la productora solicitante deberá acreditar titularidad sobre los derechos del guion si es seleccionada."
                        old_data="{!! $inscripcion?->biofilmografia_productora ?? false !!}"
                        required
                        class="mt-5" />

                <x-ecam.textarea-inscripcion
                        name="nota_productor"
                        label="Nota del productor/a"
                        old_data="{!! $inscripcion?->nota_productor ?? false !!}"
                        required
                        class="mt-5" />
                        
                <x-ecam.textarea-inscripcion
                        name="biofilmografia_guionista"
                        label="Biofilmografía del guionista"
                        description="Formación y trayectoria"
                        old_data="{!! $inscripcion?->biofilmografia_guionista ?? false !!}"
                        class="mt-5" />
            </div>
        </div>

        <div class="row">
            <h4 class="mt-5 mb-3">Ficha técnica</h4>
            <div class="col">
                <x-ecam.input type="text" name="idioma" label="Idioma" old_data="{{ $inscripcion?->idioma ?? '' }}" required />
                <x-ecam.input type="number" name="duracion" label="Duración (minutos)" old_data="{{ $inscripcion?->duracion ?? '' }}" required />
                <x-ecam.select-generos name="genero" label="Género" old_data="{{ $inscripcion?->genero ?? '' }}" required />
                    
                <x-ecam.textarea-inscripcion
                name="logline"
                label="Logline"
                old_data="{!! $inscripcion?->logline ?? false !!}"
                required
                class="mt-5" />
                
                <x-ecam.textarea-inscripcion
                name="sinopsis"
                label="Sinopsis"
                old_data="{!! $inscripcion?->sinopsis ?? false !!}"
                required
                class="mt-5" />                
            </div>
        </div>

        <div class="row">
            <h4 class="mt-5 mb-3">Financiación</h4>
            <div class="col">                
                <x-ecam.input type="text" name="presupuesto" label="Presupuesto total (€)" old_data="{{ $inscripcion?->presupuesto ?? '' }}" required/>
                    
                <x-ecam.textarea-inscripcion
                        name="plan_financiacion"
                        label="Plan de financiación"
                        description="Por favor, especifica si existe financiación asegurada y su cuantía, ayudas solicitadas para el proyecto, si existe o se busca coproducción..."
                        old_data="{!! $inscripcion?->plan_financiacion ?? false !!}"
                        required
                        class="mt-5" />                
            </div>
        </div>

        <div class="row">
            <h4 class="mt-5 mb-3">Promoción</h4>
            <div class="col">                                    
                <x-ecam.textarea-inscripcion
                        name="plan_promocion"
                        label="Plan de promoción"
                        description="Por favor, especifica si existe un plan de promoción y difusión para el proyecto."
                        old_data="{!! $inscripcion?->plan_promocion ?? false !!}"
                        required
                        class="" />                
            </div>
        </div>

        <div class="row">
            <h4 class="mt-5 mb-3">Status</h4>
            <div class="col">
                <h5 class="mb-3">¿El proyecto ha participado en otros programas de formación y mentoría, labs, foros...?</h5>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input fs-6" type="checkbox" role="switch" id="switch_otros_programas"  name="switch_otros_programas" value=1 {{ ( $inscripcion?->switch_otros_programas == true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="switch_otros_programas">Por favor indícanos si ha participado o está pendiente de los resultados de otros foros. Te recordamos que la Incubadora permite que el proyecto haya sido presentado en otros foros de desarrollo.</label>
                </div>
                {{-- <x-ecam.input class="{{ ( $inscripcion?->otros_programas == null) ? 'hidden' : '' }} mb-3" type="text" name="otros_programas" label="Otros foros" old_data="{{ $inscripcion?->otros_programas ?? '' }}"/> --}}
                <x-ecam.textarea-inscripcion
                    name="otros_programas"
                    label="Otros Programas"
                    description="Por favor, especifica el nombre y el año de cada programa."
                    old_data="{!! $inscripcion?->otros_programas ?? false !!}"
                    visibility="{{ ($inscripcion?->otros_programas == null) ? 'hidden' : '' }}" /> 

                <h5 class="mt-5 mb-3">Otras participaciones en La Incubadora</h5>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input fs-6" type="checkbox" role="switch" id="switch_otras_incubadora"  name="switch_otras_incubadora" value=1 {{ ( $inscripcion?->switch_otras_incubadora == true ) ? 'checked' : '' }}>
                    <label class="form-check-label" for="switch_otras_incubadora">¿Este proyecto ha sido inscrito en anteriores ediciones de La Incubadora?</label>
                </div>
                    
                <x-ecam.textarea-inscripcion
                        name="status"
                        label="Estado del proyecto"
                        description="Por favor cuéntanos qué pasos se han dado hasta ahora en el desarrollo del proyecto. Si ya fue inscrito en anteriores ediciones de La Incubadora, indícanos los avances conseguidos."
                        old_data="{!! $inscripcion?->status ?? false !!}"
                        required
                        class="mt-5" />
                    
                <x-ecam.textarea-inscripcion
                        name="otros_proyectos"
                        label="Otros proyectos"
                        description="Menciona en qué otros proyectos está trabajando la productora (sea en desarrollo, producción o posproducción)."
                        old_data="{!! $inscripcion?->otros_proyectos ?? false !!}"
                        required
                        class="mt-5" />
                    
                <x-ecam.textarea-inscripcion
                        name="motivaciones"
                        label="Motivaciones y objetivos"
                        description="¿Cuáles son tus motivaciones y objetivos para inscribirte? Por favor, sé lo más concreto posible."
                        old_data="{!! $inscripcion?->motivaciones ?? false !!}"
                        required
                        class="mt-5" />
                    
                <x-ecam.textarea-inscripcion
                        name="conocido"
                        label="¿Cómo nos has conocido?"
                        description="¿Cómo has tenido conocimiento de la Incubadora?"
                        old_data="{!! $inscripcion?->conocido ?? false !!}"
                        required
                        class="mt-5" />
            </div>

            <div class="row">
                <h4 class="mt-5 mb-3">Documentación</h4>
                {{-- <div class="col">
                    <div id="drop-area" class="border rounded d-flex justify-content-center align-items-center"
                    style="height: 200px; cursor: pointer">
                        <div class="text-center">
                            <i class="fa-solid fa-file-upload"></i>
                            <p class="mt-3">
                                Suelta aquí tu archivo PDF.
                            </p>
                        </div>
                    </div>
                    <input type="file" id="fileElem" accept=".pdf" class="d-none" />
                    <div id="gallery"></div>
                </div> --}}

                <div class="w-100">
                    <h5 class="required required-tag w-auto">Guion</h5>
                </div>
                <div class="col">
                    <label for="pdf_guion" class="form-label mb-3">Por favor, adjunta un archivo en PDF (20MB máx.) con la versión de guion más reciente de tu proyecto. En ficción los tratamientos no son elegibles. No olvides incluir el título y nombre del guionista. En el caso de tratamientos (documental) el máximo tamaño permitido es de 30 páginas.</label>
                    <input class="form-control d-inline me-3" type="file" id="pdf_guion" name="pdf_guion" accept=".pdf">
                    <x-ecam.error name="pdf_guion" />
                    @if( $guion = $inscripcion->archivos()->where('archivo_tipo_id', 2)->first() )
                        @php                        
                            $guionUrl = Storage::url($guion->url);                
                        @endphp
                        <a href="{{ $guionUrl }}" target="_blank">
                            <i class="fa-regular fa-fw fa-file-pdf"></i>
                            Ver PDF Guion
                        </a>
                    @endif
                </div>

                <h5 class="mt-5">¿Quieres añadir algo más sobre tu proyecto?</h5>
                <div class="col">
                    <label for="pdf_info" class="form-label mb-3">Si quieres incluir alguna información relevante adicional para valorar mejor tu proyecto (referencias visuales, teaser, etc.) adjunta 1 archivo PDF (20MB máx.) con un máximo de 15 páginas.</label>
                    <input class="form-control d-inline me-3" type="file" id="pdf_info" name="pdf_info" accept=".pdf">
                    <x-ecam.error name="pdf_info" />
                    @if( $info = $inscripcion->archivos()->where('archivo_tipo_id', 3)->first() )
                        @php                        
                            $infoUrl = Storage::url($info->url);                
                        @endphp
                        <a href="{{ $infoUrl }}" target="_blank">
                            <i class="fa-regular fa-fw fa-file-pdf"></i>
                            Ver PDF Info extra
                        </a>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <h5 class="mt-5 mb-3 required required-tag">Aceptación de las bases</h5>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input fs-6" type="checkbox" role="switch" id="switch_acepta_bases"  name="switch_acepta_bases" value=1 {{ ( $inscripcion?->switch_acepta_bases == 1 ) ? 'checked' : '' }}>
                        <label class="form-check-label" for="switch_acepta_bases">Confirmo que toda la información incluida sobre el proyecto es verídica. He entendido y acepto las <a href="{{ route('bases') }}">bases de participación</a> de la 9ª edición de La Incubadora.</label>
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
                        <input class="form-check-input fs-6" type="checkbox" role="switch" id="switch_acepta_politica"  name="switch_acepta_politica" value=1 {{ ( $inscripcion?->switch_acepta_politica == 1 ) ? 'checked' : '' }}>
                        <label class="form-check-label" for="switch_acepta_politica">He leído y entiendo la información facilitada y consiento el tratamiento de mis datos conforme a lo indicado.</label>
                    </div>
                    <x-ecam.error name="switch_acepta_politica" />
                </div>
            </div>

        </div>

        <div class="mt-4 float-end">
            <a class="btn btn-filter" href="{{ route('inscripciones.create.step.two', $inscripcion) }}">Volver a Paso 2</a>
            <button class="btn btn-rojo" type="submit" name="accion" value="guardar">Guardar y continuar más tarde</button>
            <button id="btn-send" class="btn btn-negro" type="submit" name="accion" value="enviar" onclick="submitInscripcion(event)">¡Enviar ya!</button>
        </div>
    </form>

    @section('css')
        <style>
            h5 {
                font-weight: 400;
            }

            .ck.ck-editor__editable_inline {
                border: 1px solid hsla( 0, 0%, 0%, 0.15 );
                transition: background .5s ease-out;
                min-height: 6em;
                margin-bottom: .5em;
            }
            
            .ck__controls {
                display: flex;
                flex-direction: row;
                align-items: center;
            }
            
            .ck__chart {
                /* margin-right: 1em; */
            }
            
            .ck__chart__circle {
                transform: rotate(-90deg);
                transform-origin: center;
            }
            
            .ck__chart__characters {
                font-size: 13px;
                font-weight: bold;
            }
            
            .ck__words {
                flex-grow: 1;
                opacity: .5;
            }
            
            .ck__limit-close .ck__chart__circle {
                stroke: hsl( 30, 100%, 52% );
            }
            
            .ck__limit-exceeded .ck.ck-editor__editable_inline {
                background: hsl( 0, 100%, 97% )!important;
                border-color: hsl( 0, 100%, 52% )!important;
            }
            
            .ck__limit-exceeded .ck__chart__circle {
                stroke: hsl( 0, 100%, 52% );
            }
            
            .ck__limit-exceeded .ck__chart__characters {
                fill: hsl( 0, 100%, 52% );
            }
        </style>
    @stop

    @section('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function submitInscripcion(e) {
                e.preventDefault();
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Ya no podrás editar tu inscripción una vez enviada.",
                    icon: 'warning',
                    iconColor: '#FFC700',
                    showCancelButton: true,
                    confirmButtonColor: "#a4dd78",
                    cancelButtonColor: "#FC1048",
                    confirmButtonText: "Enviar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        /* Swal.fire(
                            '¡Enviada!',
                            'Tu inscripción ha quedado registrada.',
                            'success'
                        ) */
                        let btnSend = document.getElementById("btn-send");
                        btnSend.removeAttribute('onclick');
                        btnSend.click();
                    }
                })
            }
        </script>
        <script>

            createCKEditor('biofilmografia_director', 1300);
            createCKEditor('nota_director', 3000);
            createCKEditor('biofilmografia_productora', 1300);
            createCKEditor('nota_productor', 3000);
            createCKEditor('biofilmografia_guionista', 1300);
            createCKEditor('logline', 250);
            createCKEditor('sinopsis', 1000);
            createCKEditor('plan_financiacion', 2000);
            createCKEditor('plan_promocion', 2000);
            createCKEditor('otros_programas', 250);
            createCKEditor('status', 1500);
            createCKEditor('otros_proyectos', 500);
            createCKEditor('motivaciones', 600);
            createCKEditor('conocido', 600);

            function createCKEditor(id, characterLimit) {
                const maxCharacters = characterLimit;
                const contanerId = '#wrapper_' + id;
                const container = document.querySelector( contanerId );
                const progressCircle = document.querySelector( contanerId + ' .ck__chart__circle' );
                const charactersBox = document.querySelector( contanerId + ' .ck__chart__characters' );
                const wordsBox = document.querySelector( contanerId + ' .ck__words' );
                const circleCircumference = Math.floor( 2 * Math.PI * progressCircle.getAttribute( 'r' ) );

                ClassicEditor.create( document.querySelector( '#' + id ), {
                    wordCount: {
                        onUpdate: stats => {
                            const charactersProgress = stats.characters / maxCharacters * circleCircumference;
                            const isLimitExceeded = stats.characters > maxCharacters;
                            const isCloseToLimit = !isLimitExceeded && stats.characters > maxCharacters * .85;
                            const circleDashArray = Math.min( charactersProgress, circleCircumference );

                            // Set the stroke of the circle to show how many characters were typed.
                            progressCircle.setAttribute( 'stroke-dasharray', `${ circleDashArray },${ circleCircumference }` );

                            // Display the number of characters in the progress chart. When the limit is exceeded,
                            // display how many characters should be removed.
                            if ( isLimitExceeded ) {
                                charactersBox.textContent = `-${ stats.characters - maxCharacters }`;
                            } else {
                                charactersBox.textContent = stats.characters;
                            }

                            wordsBox.textContent = `Nº de caracteres: ${ stats.characters } de ${ maxCharacters } (${ Math.round(stats.characters/maxCharacters*100) }%)`;

                            container.classList.toggle( 'ck__limit-close', isCloseToLimit );

                            container.classList.toggle( 'ck__limit-exceeded', isLimitExceeded );
                        }
                    }
                } )
                    .catch( error => {
                        console.error( error );
                    } );    
            }


            // Show/Hide inputs on switch change
            $('#switch_otros_programas').change(function(){
                $('#wrapper_otros_programas').slideToggle();
            });

            // Scroll to error
            $('html, body').scrollTop($(".error")?.offset()?.top);


            // Drag n' drop for input files
            /* let dropArea = document.getElementById('drop-area');
            let fileElem = document.getElementById('fileElem');
            let gallery = document.getElementById('gallery');

            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, preventDefaults, false);
                document.body.addEventListener(eventName, preventDefaults, false);
            });

            ['dragenter', 'dragover'].forEach(eventName => {
                dropArea.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, unhighlight, false);
            });

            dropArea.addEventListener('drop', handleDrop, false);

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            function highlight(e) {
                dropArea.classList.add('highlight');
            }

            function unhighlight(e) {
                dropArea.classList.remove('highlight');
            }

            function handleDrop(e) {
                let dt = e.dataTransfer;
                let files = dt.files;
                handleFiles(files);
            }

            dropArea.addEventListener('click', () => {
                fileElem.click();
            });

            fileElem.addEventListener('change', function (e) {
                handleFiles(this.files);
            });

            function handleFiles(files) {
                files = [...files];
                files.forEach(previewFile);
            }

            function previewFile(file) {
                let reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onloadend = function () {
                    let img = document.createElement('img');
                    img.src = reader.result;
                    gallery.innerHTML='';
                    gallery.appendChild(img);
                }
            } */
        </script>
    @stop
</x-app-layout>