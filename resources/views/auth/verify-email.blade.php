<x-app-layout>
    <div class="row justify-content-md-center">
        <div class="col col-md-6 col-lg-4">
                
            <h1 class="mt-5">Verifica tu email</h1>
            <h5 class="mb-2">Antes de continuar, ¿podrías verificar tu dirección de correo electrónico haciendo clic en el enlace que te hemos enviado?</h5>
            <p class="mb-4">Si no has recibido nuestro email, pincha en el botón y te enviaremos otro.</p>

            <x-validation-errors class="mb-3 rounded-0" />
      
            @if (session('status') == 'verification-link-sent')
                <p class="mb-4 ">
                    Te hemos reenviado un correo a la dirección que aparece en tu perfil.
                </p>
            @endif

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                
                <div class="d-flex justify-content-between align-items-center">
                    <x-button type="submit">
                        {{ __('Resend Verification Email') }}
                    </x-button>
                    <a href="{{ route('profile.show') }}" class="mt-2 rojo">{{ __('Edit Profile') }}</a>    
                </div>
            </form>

            {{-- <div class="d-flex justify-content-between mt-3">
                <a href="{{ route('profile.show') }}" class="mt-2 rojo">{{ __('Edit Profile') }}</a>                
                
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    
                    <button type="submit" class="btn btn-link">
                        Cerrar sesión
                    </button>
                </form>
            </div> --}}
        </div>
    </div>
</x-app-layout>

