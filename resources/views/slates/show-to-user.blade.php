<x-app-layout>
    <div class="container ms-0">
    
        <div class="row align-items-start">
            <div class="col">
                @if ( !$slate->complete )
                    <div class="txt-rojo mb-n1 fw-medium">
                        <i class="fa-solid fa-fw fa-exclamation-triangle"></i>
                        INCOMPLETO
                    </div>
                @endif
                <h1 class="mb-3">{{ Str::ucfirst($slate->productor) }}</h1>
            </div>
        </div>
    
        <div class="row">
            <div class="col">
                <h3 class="mt-5 mb-3">Datos de Producción</h3>
    
                <p class="data_title">Productor</p>
                <p class="data_text">{{ $slate->productor }}</p>
    
                <p class="data_title">Fecha de nacimiento</p>
                <p class="data_text">{{ date('d/m/Y', strtotime($slate->fecha_nac_productor)) }}</p>

                <p class="data_title">Compañía productora</p>
                <p class="data_text">{{ $slate->productora }}</p>
    
                <p class="data_title">Teléfono</p>
                <p class="data_text"><a href="tel:{{ $slate->tel_productor }}">{{ $slate->tel_productor }}</a></p>
    
                <p class="data_title">Código Postal</p>
                <p class="data_text">{{ $slate->cod_postal_productor }}</p>
    
                <p class="data_title">Ciudad</p>
                <p class="data_text">{{ $slate->ciudad_productor }}</p>
    
                <p class="data_title">País</p>
                <p class="data_text">{{ $slate->pais_productor }}</p>
    
                <p class="data_title">Email</p>
                <p class="data_text"><a href="mailto:{{ $slate->email_productor }}">{{ $slate->email_productor }}</a></p>
    
                <p class="data_title">Web</p>
                <p class="data_text"><a href="{{ $slate->web_productor }}" target="_blank">{{ $slate->web_productor }}</a></p>
            </div>
        </div>
    
        <div class="row mb-5">
            <div class="col">
                <h3 class="mt-5 mb-3">Documentación</h3>
                <p class="data_title">Documentación Productor/a</p>
                    @if( $documentacion = $slate->archivo()->where('archivo_tipo_id', 4)->first() )
                        @php                        
                            $documentacionUrl = Storage::url($documentacion->url);                
                        @endphp
                        <p class="data_text"><a href="{{ $documentacionUrl }}" target="_blank">
                            <i class="fa-regular fa-fw fa-file-pdf"></i>
                            Ver PDF</a>
                        </p>
                    @endif
            </div>
        </div>
        
    </div>
</x-app-layout>
