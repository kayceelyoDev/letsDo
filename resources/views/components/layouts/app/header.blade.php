<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
    
    {{-- Typography --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <style>
        body { font-family: 'Instrument Sans', sans-serif; }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        .dark ::-webkit-scrollbar-thumb { background: #3f3f46; }
    </style>
</head>

<body class="min-h-screen bg-zinc-50 dark:bg-zinc-950 text-zinc-900 dark:text-zinc-100 antialiased">

    {{-- DESKTOP & MOBILE HEADER --}}
    <flux:header container class="sticky top-0 z-50 w-full border-b border-zinc-200/80 bg-white/80 dark:border-zinc-800/80 dark:bg-zinc-900/80 backdrop-blur-md">
        
        {{-- Mobile Menu Toggle --}}
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        {{-- Logo --}}
        <a href="{{ route('dashboard') }}" class="ms-2 me-8 flex items-center gap-2 transition hover:opacity-80 lg:ms-0" wire:navigate>
            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-br from-blue-600 to-indigo-600 text-white shadow-sm">
                <x-app-logo-icon class="size-5 fill-current" />
            </div>
            <span class="hidden font-bold tracking-tight md:block">FeedBox</span>
        </a>

        {{-- Desktop Navigation --}}
        <flux:navbar class="-mb-px max-lg:hidden">
            <flux:navbar.item icon="house" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                {{ __('FeedBox') }}
            </flux:navbar.item>

            <flux:navbar.item icon="globe-alt" :href="route('joinfeedbox')" :current="request()->routeIs('joinfeedbox')" wire:navigate>
                {{ __('Explore') }}
            </flux:navbar.item>

            <flux:navbar.item icon="user" :href="route('profile')" :current="request()->routeIs('profile')" wire:navigate>
                {{ __('Profile') }}
            </flux:navbar.item>
        </flux:navbar>

        <flux:spacer />

        {{-- Desktop User Dropdown --}}
        <flux:dropdown position="top" align="end">
            <flux:profile class="cursor-pointer" :initials="auth()->user()->initials()" />

            <flux:menu class="min-w-[220px]">
                <flux:menu.radio.group>
                    <div class="p-2">
                        <div class="flex items-center gap-3 rounded-md px-2 py-2 hover:bg-zinc-100 dark:hover:bg-zinc-800">
                            <span class="relative flex h-10 w-10 shrink-0 overflow-hidden rounded-full ring-1 ring-zinc-200 dark:ring-zinc-700">
                                <span class="flex h-full w-full items-center justify-center bg-zinc-100 text-zinc-500 dark:bg-zinc-800 dark:text-zinc-400 font-medium">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-left text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs text-zinc-500">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('profile.edit')" icon="cog-6-tooth" wire:navigate>
                        {{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-900/20">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    {{-- MOBILE SIDEBAR --}}
    <flux:sidebar stashable sticky class="lg:hidden border-r border-zinc-200 bg-zinc-50 dark:border-zinc-800 dark:bg-zinc-900">
        
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <a href="{{ route('dashboard') }}" class="px-2 flex items-center gap-2" wire:navigate>
            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-br from-blue-600 to-indigo-600 text-white">
                <x-app-logo-icon class="size-5 fill-current" />
            </div>
            <span class="font-bold tracking-tight text-lg">FeedBox</span>
        </a>

        <flux:navlist variant="outline" class="space-y-1 mt-4">
            <flux:navlist.group heading="Menu">
                <flux:navlist.item icon="house" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                    {{ __('FeedBox') }}
                </flux:navlist.item>

                <flux:navlist.item icon="globe-alt" :href="route('joinfeedbox')" :current="request()->routeIs('joinfeedbox')" wire:navigate>
                    {{ __('Explore Communities') }}
                </flux:navlist.item>

                <flux:navlist.item icon="user" :href="route('profile')" :current="request()->routeIs('profile')" wire:navigate>
                    {{ __('My Profile') }}
                </flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>

        <flux:spacer />

        <div class="px-2 py-4 border-t border-zinc-200 dark:border-zinc-800">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex w-full items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-900/20">
                    <flux:icon icon="arrow-right-start-on-rectangle" variant="mini" />
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </flux:sidebar>

    {{-- MAIN CONTENT --}}
    <main class="w-full">
        {{ $slot }}
    </main>

    @fluxScripts
</body>

</html>