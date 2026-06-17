<x-app-layout>
    <style>
        .intro p, .intro ul {
            font-size: 1.125em;
        }
        .intro h1 {
            font-size: 3.5em;
            line-height: 1;
            margin-bottom: .5em;
        }
        .intro h1 small {
            font-size: .65em;
        }
        .wrapper-option {
            border-radius: 1.5em;
            padding: 3em 3em 2em;
            height: 100%;
            max-width: 580px;
            margin: 0 auto;
        }
        h4 {
            font-size: 1.75em;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: .5em;
        }
        h4 small{
            font-size: .75em;
        }
        h4 strong{
            display: block;
            font-size: 1.375em;
        }

        .btn {
            width: 360px;
        }
    </style>

    <section>
        <div class="container">
            <div class="row intro">
                <div class="col-md-8">
                    <h1>
                        <small>Bienvenidos a la</small><br />
                        <strong>INCUBADORA 10</strong>
                    </h1>
                    <p>La Incubadora es un programa de capacitación y desarrollo de proyectos cinematográficos dirigido a productores emergentes residentes en España. El programa apoya a productores, que podrán participar a través de dos líneas distintas:</p>
                    <ul>
                        <li><strong>La Incubadora – Desarrollo</strong> para equipos formados por producción y dirección con un largometraje en desarrollo</li>
                        <li><strong>La Incubadora – Slate</strong> para productoras emergentes que deseen desarrollar su carrera profesional y empresarial</li>
                    </ul>
                    <p>Sus objetivos son fortalecer e impulsar el desarrollo profesional y personal de las productoras seleccionadas, brindarles apoyo, generar impacto en sus carreras y establecer una red sólida de conocimientos. La Incubadora busca incentivar la coproducción y la colaboración entre participantes, la transmisión de conocimiento entre pares y aspira a convertirse en una red colaborativa que trascienda la participación puntual en el programa.</p>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col col-md-6">
                    <div class="wrapper-option bg-gris-1 d-flex flex-column">
                        <h4><small>La Incubadora</small>
                            <strong>Desarrollo</strong>
                        </h4>
                        <div class="txt mb-3">
                            <p>Convocatoria para <strong>proyectos de largometraje en desarrollo.</strong> Podrán participar equipos formados por producción y dirección que cuenten con, al menos, una versión de guion. Si estás trabajando mano a mano con un director o directora, quieres darle un impulso mientras adquieres herramientas para afianzar tu carrera, este es el sitio.</p>
                        </div>
                        <div class="text-start mt-auto">
                            <a href="{{ route('register', ['rol' => 'solicitante']) }}" class="btn btn-rojo">Regístrate en Desarrollo</a>
                        </div>
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="wrapper-option bg-gris-1 d-flex flex-column">
                        <h4><small>La Incubadora</small>
                            <strong>Slate</strong>
                        </h4>
                        <div class="txt mb-3">
                            <p>Convocatoria para <strong>productoras emergentes</strong> que participarán a título individual o con su empresa. Si estás trabajando con slate de proyectos, quieres dar un salto en tu carrera y afianzar tu plan de negocio, este es el sitio.</p>
                        </div>
                        <div class="text-start mt-auto">
                            <a href="{{ route('register', ['rol' => 'slate']) }}" class="btn btn-rojo">Regístrate en Slate</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col">
                    <h5>Si necesitas más info:</h5>
                    <p>Puedes escribirnos a <a class="rojo" href="mailto:industria@ecam.es" target="_blank">industria@ecam.es</a> y te responderemos lo antes posible.</p>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>