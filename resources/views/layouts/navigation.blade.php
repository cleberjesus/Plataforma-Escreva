<!-- Link da fonte no <head> -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">

<nav x-data="{ open: false }" class="border-b border-gray-100 bg-[#3D44D9] font-[Montserrat] text-white">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-14 w-auto max-w-[350px]">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white font-[Montserrat]">
                        {{ __('Painel') }}
                    </x-nav-link>

                    <x-nav-link :href="route('simulado-coringa')" :active="request()->routeIs('simulado-coringa')" class="text-white font-[Montserrat]">
                        <img src="/icons/joker.png" alt="Ícone do Simulado Coringa" class="h-6 w-6 inline-block mr-1" />
                        {{ __('Simulado Coringa') }}
                    </x-nav-link>

                    <x-nav-link :href="route('simulado-comum')" :active="request()->routeIs('simulado-comum')" class="text-white font-[Montserrat]">
                        <img src="/icons/open-book.png" alt="Ícone do Simulado Comum" class="h-6 w-6 inline-block mr-1" />
                        {{ __('Simulado Comum') }}
                    </x-nav-link>

                    <x-nav-link :href="route('redacoes.index')" :active="request()->routeIs('redacoes.index')" class="text-white font-[Montserrat]">
                        <img src="/icons/contract.png" alt="Ícone de Minhas Redações" class="h-6 w-6 inline-block mr-1" />
                        {{ __('Minhas Redações') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white font-[Montserrat] bg-[#3D44D9] hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="text-white font-[Montserrat]">
                            {{ __('Perfil') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();" class="text-white font-[Montserrat]">
                                {{ __('Sair') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-gray-300 hover:bg-[#3D44D9] focus:outline-none focus:bg-[#3D44D9] focus:text-gray-300 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-[#3D44D9] font-[Montserrat] text-white">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white font-[Montserrat]">
                {{ __('Painel') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('simulado-coringa')" :active="request()->routeIs('simulado-coringa')" class="text-white font-[Montserrat]">
                <img src="/icons/joker.png" alt="Ícone do Simulado Coringa" class="h-6 w-6 inline-block mr-1" />
                {{ __('Simulado Coringa') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('simulado-comum')" :active="request()->routeIs('simulado-comum')" class="text-white font-[Montserrat]">
                <img src="/icons/open-book.png" alt="Ícone do Simulado Comum" class="h-6 w-6 inline-block mr-1" />
                {{ __('Simulado Comum') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('redacoes.index')" :active="request()->routeIs('redacoes.index')" class="text-white font-[Montserrat]">
                <img src="/icons/contract.png" alt="Ícone de Minhas Redações" class="h-6 w-6 inline-block mr-1" />
                {{ __('Minhas Redações') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 bg-[#3D44D9]">
            <div class="px-4">
                <div class="font-medium text-base text-white font-[Montserrat]">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-300 font-[Montserrat]">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-white font-[Montserrat]">
                    {{ __('Perfil') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();" class="text-white font-[Montserrat]">
                        {{ __('Sair') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

<style>
    /* Estilo global para a fonte Montserrat */
    * {
        font-family: 'Montserrat', sans-serif;
        font-weight: 500;
    }

    /* Estilo do dropdown */
    .dropdown-content {
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        border: 1px solid #e5e7eb;
        font-family: 'Montserrat', sans-serif;
        font-weight: 500;
    }

    .dropdown-link {
        display: block;
        padding: 0.75rem 1rem;
        transition: all 0.2s;
        font-family: 'Montserrat', sans-serif;
        font-weight: 500;
    }

    .dropdown-link:hover {
        background-color: #f3f4f6;
    }

    /* Estilo do botão do usuário */
    .user-button {
        background: linear-gradient(to right, #3D44D9, #2D33B0);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        font-weight: 500;
        transition: all 0.2s;
        font-family: 'Montserrat', sans-serif;
    }

    .user-button:hover {
        background: linear-gradient(to right, #2D33B0, #1D22A0);
        transform: translateY(-1px);
    }
</style>
