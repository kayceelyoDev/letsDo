<div class="max-w-5xl mx-auto py-12 px-4 sm:px-6 lg:px-8 space-y-12">

    {{-- HEADER & SEARCH SECTION --}}
    <div class="text-center space-y-6 max-w-2xl mx-auto">
        <div class="space-y-2">
            <flux:heading size="xl" level="1">Explore Communities</flux:heading>
            <flux:subheading>
                Discover public Feedboxes, join conversations, and share ideas.
            </flux:subheading>
        </div>

        <div class="relative">
            <flux:input 
                wire:model.live.debounce.300ms="search" 
                icon="magnifying-glass" 
                placeholder="Search for topics, hobbies, or ideas..." 
                class="w-full"
                size="lg"
            />
            
            {{-- Loading Indicator inside search bar --}}
            <div wire:loading class="absolute right-3 top-3.5">
                <flux:icon icon="arrow-path" class="animate-spin text-zinc-400 w-5 h-5" />
            </div>
        </div>
    </div>

    {{-- GRID SECTION --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        
        @forelse ($this->publicBoxes as $box)
            <div class="group flex flex-col h-full bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                
                {{-- Decorative Gradient Header --}}
                <div class="h-2 w-full bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 opacity-75 group-hover:opacity-100 transition-opacity"></div>

                <div class="p-6 flex flex-col flex-1">
                    {{-- Header --}}
                    <div class="flex justify-between items-start mb-4">
                        <div class="space-y-1">
                            <h3 class="font-bold text-lg text-zinc-900 dark:text-white leading-tight">
                                {{ $box->box_name }}
                            </h3>
                            <div class="flex items-center gap-2 text-xs text-zinc-500 dark:text-zinc-400">
                                <flux:icon icon="user" variant="mini" class="w-3 h-3" />
                                <span>{{ $box->user->name }}</span>
                            </div>
                        </div>
                        
                        {{-- Public Badge --}}
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400 border border-blue-100 dark:border-blue-900/30">
                            {{ $box->privacy }}
                        </span>
                    </div>

                    {{-- Description --}}
                    <p class="text-sm text-zinc-600 dark:text-zinc-300 leading-relaxed line-clamp-3 mb-6 flex-1">
                        {{ $box->box_description ?: 'No description provided.' }}
                    </p>

                    {{-- Footer Info & Action --}}
                    <div class="pt-4 border-t border-zinc-100 dark:border-zinc-800 flex items-center justify-between mt-auto">
                     
                        <flux:button href="{{ route('feedbox', $box->id) }}" size="sm" variant="primary" icon-trailing="arrow-right">
                            View Box
                        </flux:button>
                    </div>
                </div>
            </div>

        @empty
            {{-- EMPTY STATE --}}
            <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-12">
                <div class="w-16 h-16 bg-zinc-100 dark:bg-zinc-800 rounded-full flex items-center justify-center mx-auto mb-4">
                    <flux:icon icon="magnifying-glass" variant="solid" class="w-8 h-8 text-zinc-400" />
                </div>
                <flux:heading size="lg">No boxes found</flux:heading>
                <p class="text-zinc-500 mt-1">Try adjusting your search terms to find what you're looking for.</p>
                
                <div class="mt-6">
                    <flux:button wire:click="$set('search', '')" variant="subtle">Clear Search</flux:button>
                </div>
            </div>
        @endforelse

    </div>
</div>