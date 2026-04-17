<x-app-layout>
    <section class="row justify-content-center">
        <div class="col-lg-10">
            <div class="rounded-4 border overflow-hidden" style="background: linear-gradient(135deg, #111111 0%, #1f1f1f 55%, #8c1414 100%);">
                <div class="row g-0">
                    <div class="col-lg-7">
                        <div class="p-4 p-md-5 p-xl-6 text-white">
                            <div class="small text-uppercase fw-semibold mb-3" style="letter-spacing: .18em; color: rgba(255,255,255,.7);">
                                La Incubadora | ECAM
                            </div>
                            <h1 class="display-4 fw-bold lh-sm mb-4">
                                Impulsa tu largometraje desde una convocatoria pensada para hacerlo crecer.
                            </h1>
                            <p class="fs-5 mb-3 text-white-50">
                                Accede al espacio de inscripción de La Incubadora para registrar tu proyecto, completar la documentación y seguir el proceso de evaluación.
                            </p>
                            <p class="mb-4 text-white-50">
                                Si ya tienes cuenta, puedes continuar donde lo dejaste. Si es tu primera vez, crea tu usuario y empieza la inscripción.
                            </p>

                            <div class="d-flex flex-column flex-sm-row gap-3 mt-4">
                                <a href="{{ route('login') }}" class="btn btn-light btn-lg px-4">
                                    Acceder
                                </a>
                                <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg px-4">
                                    Crear cuenta
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="h-100 d-flex align-items-center" style="background: radial-gradient(circle at top, rgba(255,255,255,.18), transparent 55%), rgba(255,255,255,.06);">
                            <div class="p-4 p-md-5">
                                <div class="rounded-4 p-4 bg-white text-dark shadow-sm">
                                    <div class="small text-uppercase fw-semibold txt-rojo mb-2">
                                        Qué puedes hacer aquí
                                    </div>
                                    <div class="mb-3">
                                        <h2 class="h5 mb-2">Gestiona tu candidatura</h2>
                                        <p class="mb-0 text-muted">
                                            Crea tu perfil, presenta tu proyecto y consulta el estado de tus inscripciones en un único espacio.
                                        </p>
                                    </div>
                                    <hr>
                                    <div class="mb-3">
                                        <h2 class="h5 mb-2">Completa la información por pasos</h2>
                                        <p class="mb-0 text-muted">
                                            El formulario está organizado para que puedas guardar, revisar y terminar tu inscripción con calma.
                                        </p>
                                    </div>
                                    <hr>
                                    <div>
                                        <h2 class="h5 mb-2">Consulta antes las bases</h2>
                                        <p class="mb-0 text-muted">
                                            Revisa los requisitos y la convocatoria antes de enviar tu proyecto para asegurarte de que todo está correcto.
                                        </p>
                                        <a href="{{ route('bases') }}" class="btn btn-rojo mt-3">
                                            Ver bases
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
