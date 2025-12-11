<x-layouts.app :title="__('Dashboard')">
    {{-- Main Wrapper: Zinc-50 for subtle contrast against white cards --}}
    <div class="min-h-screen py-10 sm:py-16 bg-zinc-50 dark:bg-black text-zinc-900 dark:text-zinc-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

            {{-- 1. PAGE HEADER SECTION --}}
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6">
                <div class="space-y-2">
                    <flux:heading size="xl" level="1" class="!text-3xl font-bold tracking-tight">
                        Dashboard
                    </flux:heading>
                    
                    <flux:subheading class="text-lg">
                        Welcome back, 
                        {{-- Gradient Text Effect for User Name --}}
                        <span class="font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600 dark:from-blue-400 dark:to-indigo-400">
                            {{ auth()->user()->name }}
                        </span>. 
                        <br class="hidden sm:block">
                        Here is an overview of your communities.
                    </flux:subheading>
                </div>

                {{-- Action Button --}}
                <div class="w-full md:w-auto">
                    <livewire:create-box />
                </div>
            </div>

            {{-- Custom Separator with Gradient Fade --}}
            <div class="h-px w-full bg-gradient-to-r from-transparent via-zinc-200 dark:via-zinc-800 to-transparent"></div>

            {{-- 2. MAIN CONTENT SECTION --}}
            <div class="space-y-8">
                
                {{-- Section Title --}}
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        {{-- Icon Box with Shadow/Border --}}
                        <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 shadow-sm text-blue-600 dark:text-blue-500">
                            <flux:icon icon="archive-box" variant="mini" class="w-5 h-5" />
                        </div>
                        
                        <div>
                            <flux:heading size="lg" level="2" class="font-semibold">Your Boxes</flux:heading>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400">Manage your joined and created feeds</p>
                        </div>
                    </div>
                </div>

                {{-- The Grid of Boxes --}}
                <livewire:box-list />
            </div>

        </div>
    </div>
</x-layouts.app>