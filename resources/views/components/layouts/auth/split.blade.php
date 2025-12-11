<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        @include('partials.head')
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
        
        <style>
            body { font-family: 'Instrument Sans', sans-serif; }
            /* Custom Scrollbar */
            ::-webkit-scrollbar { width: 8px; }
            ::-webkit-scrollbar-track { background: transparent; }
            ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
            .dark ::-webkit-scrollbar-thumb { background: #3f3f46; }
        </style>
    </head>
    
    <body class="min-h-screen bg-white dark:bg-zinc-950 text-zinc-900 dark:text-zinc-100 antialiased selection:bg-blue-500 selection:text-white">
        
        <div class="relative min-h-screen grid lg:grid-cols-2">
            
            {{-- LEFT COLUMN (Visual + Quote) --}}
            <div class="relative hidden lg:flex flex-col p-10 bg-zinc-900 border-r border-zinc-800 overflow-hidden">
                {{-- Background Effects --}}
                <div class="absolute inset-0 bg-zinc-950"></div>
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-blue-600/10 blur-[100px] rounded-full pointer-events-none"></div>
                <div class="absolute bottom-0 left-0 w-full h-1/2 bg-gradient-to-t from-zinc-950 to-transparent"></div>

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="relative z-20 flex items-center gap-2 text-lg font-medium text-white transition hover:opacity-80" wire:navigate>
                    <div class="w-8 h-8 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center text-white shadow-lg shadow-blue-500/20">
                        <x-app-logo-icon class="size-5 fill-current text-white" />
                    </div>
                    <span class="font-bold tracking-tight">FeedBox</span>
                </a>

                {{-- Random Quote --}}
                @php
                    [$message, $author] = str(Illuminate\Foundation\Inspiring::quotes()->random())->explode('-');
                @endphp

                <div class="relative z-20 mt-auto">
                    <blockquote class="space-y-4 max-w-lg">
                        <p class="text-xl font-medium leading-relaxed text-zinc-200">
                            &ldquo;{{ trim($message) }}&rdquo;
                        </p>
                        <footer class="text-sm font-semibold text-blue-400">
                            — {{ trim($author) }}
                        </footer>
                    </blockquote>
                </div>
            </div>

            {{-- RIGHT COLUMN (Form) --}}
            <div class="relative flex flex-col items-center justify-center p-8 lg:p-16">
                {{-- Mobile Logo (Only visible on small screens) --}}
                <a href="{{ route('home') }}" class="absolute top-8 left-8 lg:hidden flex items-center gap-2" wire:navigate>
                    <div class="w-8 h-8 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center text-white shadow-md">
                        <x-app-logo-icon class="size-5 fill-current text-white" />
                    </div>
                    <span class="font-bold text-xl tracking-tight text-zinc-900 dark:text-white">FeedBox</span>
                </a>

                <div class="w-full max-w-[350px] space-y-6">
                    {{ $slot }}
                </div>
                
                {{-- Footer Text --}}
                <div class="absolute bottom-6 text-center text-xs text-zinc-400">
                    &copy; {{ date('Y') }} FeedBox
                </div>
            </div>

        </div>

        @fluxScripts
    </body>
</html>