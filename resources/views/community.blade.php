<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Our Community - FeedBox</title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'media',
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
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        .dark ::-webkit-scrollbar-thumb { background: #3f3f46; }
    </style>
</head>

<body class="antialiased bg-white dark:bg-zinc-950 text-zinc-900 dark:text-zinc-100 flex flex-col min-h-screen">

    {{-- NAVIGATION --}}
    <nav class="fixed top-0 w-full z-50 border-b border-zinc-200/80 dark:border-zinc-800/80 bg-white/80 dark:bg-zinc-950/80 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center gap-2">
                    <a href="/" class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center text-white font-bold">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                <path d="M12.378 1.602a.75.75 0 00-.756 0L3 6.632l9 5.25 9-5.25-8.622-5.03zM21.75 7.93l-9 5.25v9l8.628-5.032a.75.75 0 00.372-.648V7.93zM11.25 22.18v-9l-9-5.25v8.57a.75.75 0 00.372.648l8.628 5.033z" />
                            </svg>
                        </div>
                        <span class="font-bold text-xl tracking-tight">FeedBox</span>
                    </a>
                </div>

                <div class="hidden md:flex items-center gap-8 text-sm font-medium text-zinc-600 dark:text-zinc-400">
                    <a href="/" class="hover:text-blue-600 dark:hover:text-blue-400 transition">Home</a>
                     <a href="{{ route('howitworks') }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition">How it
                        Works</a>
                    <a href="{{route('community')}}" class="text-blue-600 dark:text-blue-400 transition">Community</a>
                </div>

                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-4 py-2 text-sm font-medium text-white bg-zinc-900 dark:bg-white dark:text-zinc-900 rounded-lg hover:opacity-90 transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="hidden sm:block text-sm font-medium text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition">Log in</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition shadow-lg shadow-blue-500/20">Get Started</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- HERO / ORIGIN STORY --}}
    <main class="flex-grow pt-32 pb-24 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-purple-500/5 dark:bg-purple-500/10 blur-[120px] rounded-full pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            {{-- Intro Header --}}
            <div class="text-center max-w-3xl mx-auto mb-24">
                <div class="inline-flex -space-x-3 mb-6">
                    <img class="w-10 h-10 rounded-full border-2 border-white dark:border-zinc-950" src="https://i.pravatar.cc/100?img=33" alt="">
                    <img class="w-10 h-10 rounded-full border-2 border-white dark:border-zinc-950" src="https://i.pravatar.cc/100?img=47" alt="">
                    <img class="w-10 h-10 rounded-full border-2 border-white dark:border-zinc-950" src="https://i.pravatar.cc/100?img=12" alt="">
                    <img class="w-10 h-10 rounded-full border-2 border-white dark:border-zinc-950" src="https://i.pravatar.cc/100?img=59" alt="">
                    <div class="w-10 h-10 rounded-full border-2 border-white dark:border-zinc-950 bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center text-xs font-bold text-zinc-500 dark:text-zinc-400">+2k</div>
                </div>
                <h1 class="text-4xl md:text-6xl font-bold mb-6 tracking-tight">Built by a Creator, <br> <span class="text-blue-600">For the Community.</span></h1>
                <p class="text-xl text-zinc-600 dark:text-zinc-400 leading-relaxed">
                    It started with a simple idea: meaningful conversations shouldn't get lost in the noise.
                </p>
            </div>

            {{-- The Story Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center mb-32">
                <div class="space-y-6">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 text-xs font-bold uppercase tracking-wider">
                        The Origin Story
                    </div>
                    <h2 class="text-3xl font-bold">Why Kayceelyodev built this.</h2>
                    <div class="prose prose-lg dark:prose-invert text-zinc-600 dark:text-zinc-400">
                        <p>
                            As a developer and content creator, <strong>Kayceelyodev</strong> loved interacting with viewers, but the tools were broken. YouTube comments were messy. Discord was chaotic.
                        </p>
                        <p>
                            He wanted a hybrid solution. He envisioned a place that had the <strong>community warmth of a Facebook Group</strong> combined with the <strong>utility and voting power of Reddit.</strong>
                        </p>
                        <p>
                            So, he coded FeedBox. A dedicated space where supporters can collaborate on ideas, vote for the best content, and actually build things together.
                        </p>
                    </div>
                    
                    <div class="pt-4">
                        <div class="border-l-4 border-blue-600 pl-6 py-2 bg-zinc-50 dark:bg-zinc-900/50 rounded-r-xl">
                            <p class="text-lg italic font-medium text-zinc-800 dark:text-zinc-200">
                                "I didn't just want an audience. I wanted a collaboration. I wanted to build WITH my supporters, not just FOR them."
                            </p>
                            <p class="text-sm font-bold text-blue-600 mt-2">— Kayceelyodev</p>
                        </div>
                    </div>
                </div>
                
             
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-tr from-blue-600 to-purple-600 rounded-2xl blur-2xl opacity-20"></div>
                    <div class="relative bg-zinc-100 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-2xl p-6 md:p-10 shadow-xl">
                        <div class="space-y-6">
                           
                            <div class="flex items-start gap-4 p-4 bg-white dark:bg-zinc-950 rounded-xl border border-zinc-200 dark:border-zinc-800 shadow-sm">
                                <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" /></svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-sm">Community Connection</h4>
                                    <p class="text-xs text-zinc-500 mt-1">Like a Facebook Group, everyone belongs to a "FeedBox" where they share a common passion.</p>
                                </div>
                            </div>

                            {{-- Fake UI Component 2: The Reddit Logic --}}
                            <div class="flex items-start gap-4 p-4 bg-white dark:bg-zinc-950 rounded-xl border border-zinc-200 dark:border-zinc-800 shadow-sm">
                                <div class="w-10 h-10 rounded-full bg-orange-100 dark:bg-orange-900/30 flex items-center justify-center text-orange-600 dark:text-orange-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-sm">Quality Control</h4>
                                    <p class="text-xs text-zinc-500 mt-1">Like Reddit, good ideas get upvoted. The best content rises to the top automatically.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TESTIMONIALS SECTION --}}
            <div class="bg-zinc-50 dark:bg-zinc-900/30 rounded-3xl p-8 md:p-16 border border-zinc-200 dark:border-zinc-800">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold mb-4">What the community is saying</h2>
                    <p class="text-zinc-600 dark:text-zinc-400">Real feedback from real users creating inside FeedBox.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                  
                    <div class="bg-white dark:bg-zinc-950 p-6 rounded-2xl border border-zinc-200 dark:border-zinc-800 shadow-sm">
                        <div class="flex gap-1 text-orange-400 mb-4">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        </div>
                        <p class="text-zinc-600 dark:text-zinc-300 text-sm mb-6 leading-relaxed">
                            "I run a game development channel and the feedback loop here is insane. My fans vote on the next character design, and I build it. It's collaboration on autopilot."
                        </p>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-zinc-200 dark:bg-zinc-800"></div>
                            <div>
                                <h4 class="font-bold text-sm">Marcus D.</h4>
                                <p class="text-xs text-zinc-500">Game Developer</p>
                            </div>
                        </div>
                    </div>

         
                    <div class="bg-white dark:bg-zinc-950 p-6 rounded-2xl border border-zinc-200 dark:border-zinc-800 shadow-sm">
                        <div class="flex gap-1 text-orange-400 mb-4">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        </div>
                        <p class="text-zinc-600 dark:text-zinc-300 text-sm mb-6 leading-relaxed">
                            "Finally, a place that feels like a community but functions like a forum. No more scrolling through endless chats to find the one good idea."
                        </p>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-zinc-200 dark:bg-zinc-800"></div>
                            <div>
                                <h4 class="font-bold text-sm">Sarah L.</h4>
                                <p class="text-xs text-zinc-500">Community Manager</p>
                            </div>
                        </div>
                    </div>

                  
                    <div class="bg-white dark:bg-zinc-950 p-6 rounded-2xl border border-zinc-200 dark:border-zinc-800 shadow-sm">
                        <div class="flex gap-1 text-orange-400 mb-4">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        </div>
                        <p class="text-zinc-600 dark:text-zinc-300 text-sm mb-6 leading-relaxed">
                            "Kayceelyodev really solved a huge problem. This is basically 'Discord but organized.' I use it for my local study group."
                        </p>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-zinc-200 dark:bg-zinc-800"></div>
                            <div>
                                <h4 class="font-bold text-sm">Alex R.</h4>
                                <p class="text-xs text-zinc-500">Student</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-center mt-20">
                <a href="{{ route('register') }}" class="px-8 py-3.5 text-base font-semibold text-white bg-zinc-900 dark:bg-white dark:text-zinc-900 rounded-xl hover:scale-105 active:scale-95 transition duration-200">
                    Join the Community
                </a>
            </div>

        </div>
    </main>

    {{-- FOOTER --}}
    <footer class="border-t border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-950 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-6">
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
                <a href="#" class="text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition">
                    <span class="sr-only">GitHub</span>
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </footer>

</body>
</html>