<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')

    {{-- Ensure font is loaded matching other pages --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        .dark ::-webkit-scrollbar-thumb {
            background: #3f3f46;
        }
    </style>
</head>

<body
    class="min-h-screen bg-zinc-50 dark:bg-zinc-950 text-zinc-900 dark:text-zinc-100 antialiased flex flex-col relative overflow-hidden selection:bg-blue-500 selection:text-white">

    {{-- Background Decoration --}}
    <div
        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[500px] bg-blue-500/10 dark:bg-blue-500/5 blur-[120px] rounded-full pointer-events-none z-0">
    </div>

    <div class="flex-grow flex flex-col items-center justify-center p-6 relative z-10 w-full">
        <div class="w-full max-w-[400px] space-y-8">

            {{-- Logo Section --}}
            <a href="{{ route('home') }}"
                class="flex flex-col items-center gap-4 transition hover:opacity-90 hover:scale-105 duration-300"
                wire:navigate>
                <div
                    class="w-12 h-12 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-500/20">
                    <x-app-logo-icon class="size-7 fill-current text-white" />
                </div>
                <span class="font-bold text-2xl tracking-tight text-zinc-900 dark:text-white">FeedBox</span>
            </a>

            {{-- Card Content --}}
            <div
                class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-2xl shadow-xl shadow-zinc-200/50 dark:shadow-none p-8 sm:p-10 relative overflow-hidden">
                {{-- Subtle Card Highlight --}}
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-indigo-500"></div>

                <div class="flex flex-col gap-6">
                    {{ $slot }}
                </div>
            </div>

            {{-- Footer / Copyright --}}
            <div class="text-center text-xs text-zinc-500 dark:text-zinc-500">
                &copy; {{ date('Y') }} FeedBox. Create. Share. Collaborate.
            </div>
        </div>
    </div>

    @fluxScripts
</body>

</html>
