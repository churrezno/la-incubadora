<x-app-layout>
    <h1>Contacto</h1>
    <h3 class="mb-4">Déjanos un mensaje</h3>

    @if (session('info'))
        <x-alert />
    
    @else
        <form action="{{ route('contacto.store') }}" method="POST" style="max-width: 420px;">
            @csrf
            @honeypot

            <x-ecam.input type="text" name="name" label="Nombre"/>
            <x-ecam.input type="email" name="email" label="Email"/>

            <div class="form-floating mb-3">
                <textarea class="form-control" id="mensaje" name="mensaje" placeholder="mensaje" style="height: 250px">{{ old('mensaje') }}</textarea>
                <label for="mensaje">Mensaje</label>
                <x-ecam.error name="mensaje" />
            </div>
            
            <button class="btn btn-rojo" type="submit" name="accion" value="continuar">Enviar</button>
        </form>      
    @endif
    
</x-app-layout>