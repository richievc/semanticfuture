@php
    $navLinks = [
        'home' => ['label' => 'Home', 'route' => 'home'],
        'features' => ['label' => 'Features', 'route' => 'features'],
        'pricing' => ['label' => 'Pricing', 'route' => 'pricing'],
        'about' => ['label' => 'About', 'route' => 'about'],
        'contact' => ['label' => 'Contact', 'route' => 'contact'],
    ];
@endphp

<header class="sticky top-0 z-40 border-b border-white/5">
    <div class="glass">
        <nav class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4 lg:px-8" aria-label="Main navigation">
            <a href="{{ route('home') }}" class="flex items-center gap-2 text-lg font-semibold tracking-tight text-white">
                <img src="{{ asset('images/brand/icon.png') }}" alt="" class="h-8 w-8" width="32" height="32">
                <span>Semantic<span class="text-accent-400">Future</span></span>
            </a>

            <div class="hidden items-center gap-8 lg:flex">
                @foreach ($navLinks as $key => $link)
                    <a
                        href="{{ route($link['route']) }}"
                        class="text-sm font-medium transition-colors {{ request()->routeIs($link['route']) ? 'text-accent-300' : 'text-slate-300 hover:text-white' }}"
                    >
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </div>

            <div class="hidden lg:flex lg:items-center lg:gap-4">
                @auth
                    <div class="relative group">
                        <button class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium text-slate-300 hover:bg-white/5 hover:text-white transition-colors">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275m11.963 0A24.973 24.973 0 0112 21c-4.556 0-8.689-.901-12-2.56m11.963 0A23.98 23.98 0 0112 21" /></svg>
                            <span>{{ auth()->user()->name }}</span>
                            <svg class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                        </button>
                        <div class="absolute right-0 mt-2 w-48 bg-navy-900 border border-white/10 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all">
                            <a href="{{ route('account.dashboard') }}" class="block px-4 py-2 text-sm text-slate-300 hover:bg-white/5 hover:text-white rounded-t-lg">My Account</a>
                            <a href="{{ route('account.orders') }}" class="block px-4 py-2 text-sm text-slate-300 hover:bg-white/5 hover:text-white">Orders</a>
                            <a href="{{ route('account.downloads') }}" class="block px-4 py-2 text-sm text-slate-300 hover:bg-white/5 hover:text-white">Downloads</a>
                            <form method="POST" action="{{ route('logout') }}" class="border-t border-white/5">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-slate-300 hover:bg-white/5 hover:text-white rounded-b-lg">Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-slate-300 hover:text-white transition-colors">Login</a>
                    <x-button href="{{ route('register') }}" size="sm">Sign Up</x-button>
                @endauth
            </div>

            <div class="hidden lg:block">
                <x-button href="{{ route('pricing') }}" size="sm" variant="secondary">Get the Book</x-button>
            </div>

            <button
                type="button"
                id="mobile-menu-button"
                class="inline-flex items-center justify-center rounded-lg p-2 text-slate-300 hover:bg-white/5 hover:text-white lg:hidden"
                aria-controls="mobile-menu"
                aria-expanded="false"
                aria-label="Toggle navigation menu"
            >
                <svg id="menu-icon-open" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
                </svg>
                <svg id="menu-icon-close" class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </nav>

        {{-- Mobile menu --}}
        <div id="mobile-menu" class="hidden lg:hidden">
            <div class="space-y-1 border-t border-white/5 px-6 pb-6 pt-4">
                @foreach ($navLinks as $key => $link)
                    <a
                        href="{{ route($link['route']) }}"
                        class="block rounded-lg px-3 py-2 text-base font-medium {{ request()->routeIs($link['route']) ? 'bg-white/5 text-accent-300' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}"
                    >
                        {{ $link['label'] }}
                    </a>
                @endforeach
                <div class="pt-3 space-y-2">
                    @auth
                        <a href="{{ route('account.dashboard') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-slate-300 hover:bg-white/5 hover:text-white">My Account</a>
                        <a href="{{ route('account.orders') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-slate-300 hover:bg-white/5 hover:text-white">Orders</a>
                        <a href="{{ route('account.downloads') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-slate-300 hover:bg-white/5 hover:text-white">Downloads</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left rounded-lg px-3 py-2 text-sm font-medium text-slate-300 hover:bg-white/5 hover:text-white">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-slate-300 hover:bg-white/5 hover:text-white">Login</a>
                        <a href="{{ route('register') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-accent-300 hover:bg-white/5">Sign Up</a>
                    @endauth
                    <x-button href="{{ route('pricing') }}" class="w-full justify-center">Get the Book</x-button>
                </div>
            </div>
        </div>
    </div>
</header>
