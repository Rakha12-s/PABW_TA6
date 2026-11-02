<nav x-data="{ open: false }" class="border-b border-sky-100 bg-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
            <div class="flex items-center gap-8">
                <a href="{{ url('/') }}" class="text-lg font-semibold text-sky-700">LaporBanjir</a>

                <div class="hidden items-center gap-6 sm:flex">
                    <x-nav-link :href="route('lapor.create')" :active="request()->routeIs('lapor.*')">Form Laporan</x-nav-link>
                    @auth
                        <x-nav-link :href="route('laporan.index')" :active="request()->routeIs('laporan.*') || request()->routeIs('dashboard')">Daftar Laporan</x-nav-link>
                        <x-nav-link :href="route('petugas.profile')" :active="request()->routeIs('petugas.profile')">Profil Petugas</x-nav-link>
                    @endauth
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @guest
                    <a href="{{ route('login') }}" class="me-3 text-sm font-medium text-slate-700 hover:text-sky-700">Login</a>
                    <a href="{{ route('register') }}" class="rounded-md bg-sky-600 px-4 py-2 text-sm font-medium text-white hover:bg-sky-700">Register</a>
                @endguest

                @auth
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center rounded-md border border-transparent px-3 py-2 text-sm font-medium leading-4 text-sky-700 transition duration-150 ease-in-out hover:text-sky-900 focus:outline-none">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center rounded-md p-2 text-sky-600 transition duration-150 ease-in-out hover:bg-sky-50 hover:text-sky-800 focus:bg-sky-50 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="space-y-1">
            <x-responsive-nav-link :href="route('lapor.create')">Form Laporan</x-responsive-nav-link>
            @auth
                <x-responsive-nav-link :href="route('laporan.index')">Daftar Laporan</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('petugas.profile')">Profil Petugas</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full px-4 py-2 text-left text-sm font-medium text-sky-700 hover:bg-sky-50">Logout</button>
                </form>
            @else
                <x-responsive-nav-link :href="route('login')">Login</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')">Register</x-responsive-nav-link>
            @endauth
        </div>
    </div>
</nav>
