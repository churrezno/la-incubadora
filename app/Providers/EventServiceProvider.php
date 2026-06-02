<?php

namespace App\Providers;

use App\Models\Asignacion;
use App\Models\Inscripcion;
use App\Models\Slate;
use App\Models\User;
use App\Models\Valoracion;
use App\Observers\AsignacionObserver;
use App\Observers\InscripcionObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Event::listen(BuildingMenu::class, function (BuildingMenu $event) {

            $user = auth()->user();

            if ($user->hasRole('admin')) {
                $event->menu->add([
                    'text' => 'Usuarios',
                    'url' => 'admin/users',
                    'icon' => 'fa-solid fa-fw fa-user',
                    'label' => User::count(),
                    'label_color' => 'dark',
                ]);

                $event->menu->add([
                    'text' => 'Inscripciones',
                    'url' => 'admin/inscripciones',
                    'icon' => 'fa-solid fa-fw fa-video',
                    'label' => Inscripcion::count(),
                    'label_color' => 'dark',
                ]);

                $event->menu->add([
                    'text' => 'Slates',
                    'url' => 'admin/slates',
                    'icon' => 'fa-solid fa-fw fa-user',
                    'label' => Slate::count(),
                    'label_color' => 'dark',
                ]);

                $event->menu->add([
                    'text' => 'Valoraciones',
                    'url' => 'admin/valoraciones',
                    'icon' => 'fa-solid fa-fw fa-certificate',
                    'label' => Valoracion::count(),
                    'label_color' => 'dark',
                ]);

                $event->menu->add([
                    'text' => 'Enviar emails',
                    'url' => 'admin/send-mail',
                    'icon' => 'fa-solid fa-fw fa-envelope',
                ]);

                $event->menu->add([
                    'text' => 'Papelera',
                    'url' => 'admin/papelera',
                    'icon' => 'fa-solid fa-fw fa-trash-can',
                ]);
            } elseif ($user->hasRole('comite')) {
                $event->menu->add([
                    'text' => 'Inscripciones',
                    'url' => 'admin/inscripciones',
                    'icon' => 'fa-solid fa-fw fa-video',
                ]);
            }
        });

        // Para eliminar los archivos asociados al modelo si lo borramos
        User::observe(UserObserver::class);
        Inscripcion::observe(InscripcionObserver::class);
        Asignacion::observe(AsignacionObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
