<x-app-layout>
    <div class="row justify-content-md-center">
        <div class="col col-md-6 col-lg-4">
                
            <h1 class="mt-5">Accede</h1>
            <h5 class="mb-4">¿No tienes usuario? Registrate <a class="txt-rojo" href="/register">aquí</a></h5>

            <x-validation-errors class="mb-3 rounded-0" />

            @if (session('status'))
                <div class="alert alert-success mb-3 rounded-0" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <x-label value="{{ __('Email') }}" />

                    <x-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                                name="email" :value="old('email')" required />
                    <x-input-error for="email"></x-input-error>
                </div>

                <div class="mb-3">
                    <x-label value="{{ __('Password') }}" />

                    <x-input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password"
                                name="password" required autocomplete="current-password" />
                    <x-input-error for="password"></x-input-error>
                </div>

                <div class="mb-3">
                    <div class="checkbox-wrapper">
                        <x-checkbox id="remember_me" name="remember" />
                        <label class="custom-control-label" for="remember_me">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>

                <div class="mb-0">
                    <div class="d-flex justify-content-end align-items-baseline">
                        @if (Route::has('password.request'))
                            <a class="text-muted me-3" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <x-button>
                            {{ __('Log in') }}
                        </x-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>