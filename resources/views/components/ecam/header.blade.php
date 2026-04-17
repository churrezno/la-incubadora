<nav class="navbar-header navbar navbar-expand-md">

    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href={{ Auth::user()?->hasRole('admin') ? '/admin' : '/' }}>
            <x-ecam.logo/>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            
            {{-- User --}}
            <ul class="navbar-nav">
                @auth
                    <x-dropdown id="settingsDropdown">
                    <x-slot name="trigger">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <img class="rounded-circle" width="32" height="32" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        @else
                        <i class="fa-solid fa-fw fa-cog me-1"></i>{{ Auth::user()->name }}
                        @endif
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <h6 class="dropdown-header small text-muted">
                            {{ __('Manage Account') }}
                        </h6>
                        
                        <x-dropdown-link href="{{ route('profile.show') }}">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        
                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-dropdown-link href="{{ route('api-tokens.index') }}">
                            {{ __('API Tokens') }}
                        </x-dropdown-link>
                        @endif
                        
                        <hr class="dropdown-divider">
                        
                        <!-- Authentication -->
                        <x-dropdown-link href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                {{ __('Log out') }}
                            </x-dropdown-link>
                            <form method="POST" id="logout-form" action="{{ route('logout') }}">
                                @csrf
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth 
            </ul>

            {{-- Pages --}}
            <ul class="navbar-nav">
                <x-nav-link href="{{ route('faq') }}" :active="request()->routeIs('faq')">
                    FAQ
                </x-nav-link>
                <x-nav-link href="{{ route('bases') }}" :active="request()->routeIs('bases')">
                    Bases
                </x-nav-link>
                <x-nav-link href="{{ route('contacto.index') }}" :active="request()->routeIs('contacto')">
                    Contacto
                </x-nav-link>
            </ul>

            {{-- Social --}}
            <ul class="navbar-nav navbar-nav-social">
                <x-nav-link href="https://es-la.facebook.com/ECAMescuela/" target="_blank">
                    <i class="fa-brands fa-facebook-f"></i>
                </x-nav-link>
                <x-nav-link href="https://twitter.com/ecam_" target="_blank">
                    <i class="fa-brands fa-x-twitter"></i>
                </x-nav-link>
                <x-nav-link href="https://www.instagram.com/ecam_cine/" target="_blank">
                    <i class="fa-brands fa-instagram"></i>
                </x-nav-link>
                <x-nav-link href="https://www.linkedin.com/company/ecam-escuela-de-cinematograf-a-y-del-audiovisual-de-la-comunidad-de-madrid-/" target="_blank">
                    <i class="fa-brands fa-linkedin-in"></i>
                </x-nav-link>
                <x-nav-link href="https://www.youtube.com/channel/UCkpBkvGs-zX6ayayKNhY5bw" target="_blank">
                    <i class="fa-brands fa-youtube"></i>
                </x-nav-link>
                <x-nav-link href="https://vimeo.com/ecam" target="_blank">
                    <i class="fa-brands fa-vimeo"></i>
                </x-nav-link>
            </ul>
        </div>
    </div>
</nav>