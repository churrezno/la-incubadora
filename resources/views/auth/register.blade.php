 <x-app-layout>
    <div class="row justify-content-md-center">
        <div class="col col-md-6 col-lg-4">
            
            <h1 class="mt-5">Regístrate</h1>
            <h5 class="mb-4">¿Ya tienes usuario? Accede <a href="/login" class="txt-rojo">aquí</a></h5>

            <x-validation-errors class="mb-3" />

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-4">
                    <p class="mt-4 mb-1 required required-tag">Quiero inscribirme para:</p>
                    <div class="form-check ms-3">
                        <input class="form-check-input" type="radio" name="rol_incubadora" id="solicitante" value="solicitante">
                        <label class="form-check-label" for="desarrollo">
                            <strong>DESARROLLO</strong> (proyectos de largometraje)
                        </label>
                    </div>
                    <div class="form-check ms-3">
                        <input class="form-check-input" type="radio" name="rol_incubadora" id="slate" value="slate">
                        <label class="form-check-label" for="slate">
                            <strong>SLATE</strong> (productoras emergentes)
                        </label>
                    </div>
                    <x-ecam.error name="rol_incubadora" />
                </div>

                <div class="mb-3">
                    <x-label value="Nombre y apellido" class="required" />

                    <x-input class="{{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                                 :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error for="name"></x-input-error>
                </div>

                <div class="mb-3">
                    <x-label value="{{ __('Email') }}" class="required" />

                    <x-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                                 :value="old('email')" required />
                    <x-input-error for="email"></x-input-error>
                </div>

                <div class="mb-3">
                    <x-label value="{{ __('Password') }}" class="required" />

                    <x-input class="{{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                                 name="password" required autocomplete="new-password" />
                    <x-input-error for="password"></x-input-error>
                </div>

                <div class="mb-3">
                    <x-label value="{{ __('Confirm Password') }}" class="required" />

                    <x-input class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mb-3">
                        <div class="checkbox-wrapper">
                            <x-checkbox id="terms" name="terms" />
                            <label class="custom-control-label" for="terms">
                                He leído y acepto las <a  class="txt-rojo" target="_blank" href="https://laincubadora.ecam-industria.es/bases">Bases Reguladoras de la Convocatoria de la La Incubadora 10 - ECAM Industria</a> y la <a class="txt-rojo" target="_blank" href="https://laincubadora.ecam-industria.es/politica-privacidad">Política de Privacidad</a> y acepto el tratamiento de mis datos de carácter personal con la finalidad que en la misma se describe.
                            </label>
                            {{-- <label class="custom-control-label" for="terms">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                            </label> --}}
                        </div>
                    </div>
                    <div class="mb-3 small">
                        <strong>Información basica sobre Protección de Datos</strong>
                        <p>Responsable: Escuela de Cinematografia y del Audiovisual de la Comunidad de Madrid - ECAM
                            Finalidad: Registro como usuario de los servicios de “La Incubadora” de la web ECAM Industria y envío de información sobre los servicios y actividades de la ECAM.
                            Legitimación: Consentimiento del interesado/a.
                            Destinatarios: No hay previsto ningun destinatario de los datos aportados.
                            Derechos: Acceder, rectificar y suprimir los datos, así como otros derechos, según se indica en la información adicional.
                            Información adicional: Puede consultar la información adicional en el siguiente <a class="txt-rojo" href="#">enlace.</a></p>
                    </div>
                    <div class="mb-3">
                        <p>Puede que el correo de autentificación llegue a tu carpeta de spam. Si no lo recibes, escríbenos a <a class="txt-rojo" href="mailto:industria@ecam.es">industria@ecam.es</a></p>
                    </div>
                @endif

                <div class="mb-0">
                    <div class="d-flex justify-content-end align-items-baseline">
                        <x-button>
                            {{ __('Register') }}
                        </x-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>