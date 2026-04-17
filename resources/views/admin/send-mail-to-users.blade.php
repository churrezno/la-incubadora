@extends('adminlte::page')

@section('title', 'Enviar emails')

@section('content')

    <h1 class="mt-5 mb-4 pt-3">Enviar email a usuarios</h1>

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>  
    
    @else
        <form action="{{ route('send.mail.store') }}" method="POST" style="max-width: 800px;">
            
            @csrf
            @honeypot

            <div class="form-floating">
                <select name="destinatarios"
                        id="destinatarios"
                        class="form-select">
                    <option value="">- Selecciona -</option>
                    <option value="excluidos {{ (old('destinatarios') =='excluidos') ? 'selected' : '' }}">Excluidos</option>
                    <option value="preseleccionados {{ (old('destinatarios') =='preseleccionados') ? 'selected' : '' }}">Preseleccionados</option>
                </select>
                <label for="destinatarios">Destinatarios</label>
            </div>            
            <x-ecam.error name="destinatarios" />

            <x-ecam.textarea-inscripcion
                        name="mensaje"
                        label="Mensaje"
                        class="mt-3" />
            
            <button class="btn btn-rojo" type="submit">Enviar</button>
        </form>      
    @endif

@stop


@section('css')
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
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
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script>
        if (document.getElementById('mensaje'))
            createCKEditor('mensaje', 5000);

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
    </script>
@stop