<nav x-data="{ open: false }" class="bg-white shadow-md border-b border-gray-200 relative w-full">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Left Section -->
            <div class="flex items-center">
                <!-- Logo -->
                <a href="{{ route('dashboard',['lang' => app()->getLocale()]) }}" class="flex items-center gap-2">
                    <x-application-logo class="h-9 w-auto text-indigo-600" />
                    <span class="font-bold text-lg text-gray-700">Final Project</span>
                </a>

                <!-- Navigation Links -->
                <div class="hidden sm:flex sm:space-x-6 sm:ms-10">
                    <x-nav-link :href="route('dashboard',['lang'=>App::getLocale()])" :active="request()->routeIs('dashboard')">
                        {{ __('messages.Dashboard') }}
                    </x-nav-link>

                    <!-- Posts Dropdown -->
                    <x-dropdown align="left" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center gap-1 px-3 py-2 text-gray-600 hover:text-indigo-600 transition">
                                {{ __('messages.posts') }}
                                <i class="fa-solid fa-chevron-down text-xs"></i>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('posts',['lang'=>App::getLocale()])">
                                {{ __('messages.posts') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('posts.create',['lang'=>App::getLocale()])">
                                {{ __('messages.create_post') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>

                    <!-- Categories Dropdown -->
                    <x-dropdown align="left" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center gap-1 px-3 py-2 text-gray-600 hover:text-indigo-600 transition">
                                {{ __('messages.categories') }}
                                <i class="fa-solid fa-chevron-down text-xs"></i>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('categories',['lang'=>App::getLocale()])">
                                {{ __('messages.categories') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('categories.create',['lang'=>App::getLocale()])">
                                {{ __('messages.create_category') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>

                    <!-- Language -->
                    <x-dropdown align="left" width="32">
                        <x-slot name="trigger">
                            <button class="flex items-center gap-1 px-3 py-2 text-gray-600 hover:text-indigo-600 transition">
                                🌐 {{ strtoupper(app()->getLocale()) }}
                                <i class="fa-solid fa-chevron-down text-xs"></i>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="url('en' . substr(request()->getRequestUri(), 3))">EN</x-dropdown-link>
                            <x-dropdown-link :href="url('ar' . substr(request()->getRequestUri(), 3))">AR</x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Right Section -->
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-2 px-3 py-2 text-gray-600 hover:text-indigo-600 transition">
                            <span>{{ Auth::user()->name }}</span>
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit',['lang'=>app()->getLocale()])">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile Menu Button -->
            <div class="flex sm:hidden">
                <button @click="open = !open" class="p-2 rounded-md text-gray-600 hover:text-indigo-600 focus:outline-none">
                    <i :class="open ? 'fa-solid fa-xmark text-xl' : 'fa-solid fa-bars text-xl'"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="open ? 'block' : 'hidden'" class="sm:hidden bg-white border-t border-gray-200">
        <div class="px-4 py-3 space-y-2">
            <x-responsive-nav-link :href="route('dashboard',['lang'=>app()->getLocale()])" :active="request()->routeIs('dashboard')">
                {{ __('messages.Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('profile.edit',['lang'=>app()->getLocale()])">
                {{ __('Profile') }}
            </x-responsive-nav-link>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
</nav>
