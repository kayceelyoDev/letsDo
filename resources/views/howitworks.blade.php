<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>How It Works - FeedBox</title>

    <link rel="icon" href="/favicon.svg" sizes="any">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'media', // Uses system settings
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Instrument Sans', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#eff6ff',
                            500: '#3b82f6',
                            600: '#2563eb',
                            900: '#1e3a8a',
                        }
                    }
                }
            }
        }
    </script>

    <style>
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
    class="antialiased bg-white dark:bg-zinc-950 text-zinc-900 dark:text-zinc-100 selection:bg-blue-500 selection:text-white flex flex-col min-h-screen">

    {{-- NAVIGATION --}}
    <nav
        class="fixed top-0 w-full z-50 border-b border-zinc-200/80 dark:border-zinc-800/80 bg-white/80 dark:bg-zinc-950/80 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center gap-2">
                    <a href="/" class="flex items-center gap-2">
                        <div
                            class="w-8 h-8 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center text-white font-bold">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-5 h-5">
                                <path
                                    d="M12.378 1.602a.75.75 0 00-.756 0L3 6.632l9 5.25 9-5.25-8.622-5.03zM21.75 7.93l-9 5.25v9l8.628-5.032a.75.75 0 00.372-.648V7.93zM11.25 22.18v-9l-9-5.25v8.57a.75.75 0 00.372.648l8.628 5.033z" />
                            </svg>
                        </div>
                        <span class="font-bold text-xl tracking-tight">FeedBox</span>
                    </a>
                </div>

                <div class="hidden md:flex items-center gap-8 text-sm font-medium text-zinc-600 dark:text-zinc-400">
                    <a href="/" class="hover:text-blue-600 dark:hover:text-blue-400 transition">Home</a>
                     <a href="{{ route('howitworks') }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition">How it
                        Works</a>
                    <a href="{{route('community')}}" class="hover:text-blue-600 dark:hover:text-blue-400 transition">Community</a>
                </div>

                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="px-4 py-2 text-sm font-medium text-white bg-zinc-900 dark:bg-white dark:text-zinc-900 rounded-lg hover:opacity-90 transition">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="hidden sm:block text-sm font-medium text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition">
                            Log in
                        </a>
                        <a href="{{ route('register') }}"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition shadow-lg shadow-blue-500/20">
                            Get Started
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- MAIN CONTENT (How It Works) --}}
    <main class="flex-grow pt-32 pb-24 relative overflow-hidden">
        {{-- Background Decoration --}}
        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[500px] bg-indigo-500/5 dark:bg-indigo-500/10 blur-[120px] rounded-full pointer-events-none">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-2xl mx-auto mb-20">
                <div
                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-zinc-100 dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 text-xs font-medium text-zinc-600 dark:text-zinc-400 mb-6">
                    <span class="flex h-2 w-2 rounded-full bg-blue-500"></span>
                    Simple & Powerful
                </div>
                <h1 class="text-4xl md:text-5xl font-bold mb-6 tracking-tight">From idea to community in minutes</h1>
                <p class="text-lg text-zinc-600 dark:text-zinc-400">
                    No complex setup. Just a simple, streamlined process to get your community up and running.
                </p>
            </div>

            <div class="relative mt-16">
                {{-- Connector Line (Desktop Only) --}}
                <div
                    class="hidden md:block absolute top-12 left-0 w-full h-0.5 bg-gradient-to-r from-zinc-200 via-blue-200 to-zinc-200 dark:from-zinc-800 dark:via-blue-900/50 dark:to-zinc-800">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                    {{-- Step 1 --}}
                    <div class="relative flex flex-col items-center text-center group">
                        <div
                            class="w-24 h-24 bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-200 dark:border-zinc-800 flex items-center justify-center relative z-10 mb-6 group-hover:scale-110 group-hover:border-blue-500/50 transition duration-300 shadow-lg shadow-zinc-200/50 dark:shadow-none">
                            <div
                                class="w-12 h-12 bg-blue-50 dark:bg-blue-900/20 rounded-lg flex items-center justify-center text-blue-600 dark:text-blue-400">
                                <span class="font-bold text-xl">1</span>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold mb-2">Create Account</h3>
                        <p class="text-sm text-zinc-500 dark:text-zinc-400 leading-relaxed">
                            Sign up for free in seconds. No credit card required to get started.
                        </p>
                    </div>

                    {{-- Step 2 --}}
                    <div class="relative flex flex-col items-center text-center group">
                        <div
                            class="w-24 h-24 bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-200 dark:border-zinc-800 flex items-center justify-center relative z-10 mb-6 group-hover:scale-110 group-hover:border-indigo-500/50 transition duration-300 shadow-lg shadow-zinc-200/50 dark:shadow-none">
                            <div
                                class="w-12 h-12 bg-indigo-50 dark:bg-indigo-900/20 rounded-lg flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold mb-2">Create a Box</h3>
                        <p class="text-sm text-zinc-500 dark:text-zinc-400 leading-relaxed">
                            Give your box a name and description. Choose public or private access.
                        </p>
                    </div>

                    {{-- Step 3 --}}
                    <div class="relative flex flex-col items-center text-center group">
                        <div
                            class="w-24 h-24 bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-200 dark:border-zinc-800 flex items-center justify-center relative z-10 mb-6 group-hover:scale-110 group-hover:border-purple-500/50 transition duration-300 shadow-lg shadow-zinc-200/50 dark:shadow-none">
                            <div
                                class="w-12 h-12 bg-purple-50 dark:bg-purple-900/20 rounded-lg flex items-center justify-center text-purple-600 dark:text-purple-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z" />
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold mb-2">Share Link</h3>
                        <p class="text-sm text-zinc-500 dark:text-zinc-400 leading-relaxed">
                            Copy your unique FeedBox link and share it with your fans or team.
                        </p>
                    </div>

                    {{-- Step 4 --}}
                    <div class="relative flex flex-col items-center text-center group">
                        <div
                            class="w-24 h-24 bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-200 dark:border-zinc-800 flex items-center justify-center relative z-10 mb-6 group-hover:scale-110 group-hover:border-orange-500/50 transition duration-300 shadow-lg shadow-zinc-200/50 dark:shadow-none">
                            <div
                                class="w-12 h-12 bg-orange-50 dark:bg-orange-900/20 rounded-lg flex items-center justify-center text-orange-600 dark:text-orange-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold mb-2">Engage</h3>
                        <p class="text-sm text-zinc-500 dark:text-zinc-400 leading-relaxed">
                            Watch the ideas flow in. Upvote the best ones and reply instantly.
                        </p>
                    </div>
                </div>

                <div class="mt-20 flex justify-center">
                    <a href="{{ route('register') }}"
                        class="px-8 py-3.5 text-base font-semibold text-white bg-zinc-900 dark:bg-white dark:text-zinc-900 rounded-xl hover:scale-105 active:scale-95 transition duration-200 shadow-xl shadow-blue-500/10">
                        Start your journey
                    </a>
                </div>
            </div>
        </div>
    </main>

    {{-- FOOTER --}}
    <footer class="border-t border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-950 py-12">
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-2">
                <div class="flex items-center justify-center gap-3">
                    <x-app-logo-icon />
                    <span class="font-bold">FeedBox</span>
                </div>
            </div>

            <div class="text-sm text-zinc-500">
                &copy; {{ date('Y') }} FeedBox. Built with Laravel Livewire.
            </div>

            <div class="flex gap-4">
                <a href="https://github.com/kayceelyoDev/letsDo.git" class="text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition">
                    <span class="sr-only">GitHub</span>
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </footer>

</body>

</html>