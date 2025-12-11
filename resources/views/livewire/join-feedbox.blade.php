<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 space-y-12">

    {{-- HEADER & SEARCH SECTION --}}
    <div class="text-center space-y-8 max-w-3xl mx-auto">
        <div class="space-y-3">
            <h1 class="text-4xl font-bold tracking-tight text-zinc-900 dark:text-white sm:text-5xl">
                Explore Communities
            </h1>
            <p class="text-lg text-zinc-600 dark:text-zinc-400">
                Discover public Feedboxes, join conversations, and share ideas with like-minded people.
            </p>
        </div>

        <div class="relative max-w-xl mx-auto">
            <flux:input 
                wire:model.live.debounce.300ms="search" 
                icon="magnifying-glass" 
                placeholder="Search for topics, hobbies, or ideas..." 
                class="w-full shadow-sm"
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
            <div class="group relative flex flex-col h-full bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-2xl shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                
                {{-- Decorative Gradient Header --}}
                <div class="h-1.5 w-full bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 opacity-80 group-hover:opacity-100 transition-opacity"></div>

                <div class="p-6 flex flex-col flex-1">
                    {{-- Header --}}
                    <div class="flex justify-between items-start gap-4 mb-4">
                        <div class="space-y-1 min-w-0">
                            <h3 class="font-bold text-lg text-zinc-900 dark:text-white leading-tight truncate group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                {{ $box->box_name }}
                            </h3>
                            <div class="flex items-center gap-1.5 text-xs font-medium text-zinc-500 dark:text-zinc-400">
                                <flux:icon icon="user" variant="mini" class="w-3.5 h-3.5 text-zinc-400" />
                                <span class="truncate">Created by {{ $box->user->name }}</span>
                            </div>
                        </div>
                        
                        {{-- Public Badge --}}
                        <span class="shrink-0 inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-zinc-100 text-zinc-600 dark:bg-zinc-800 dark:text-zinc-400 border border-zinc-200 dark:border-zinc-700">
                            {{ $box->privacy }}
                        </span>
                    </div>

                    {{-- Description --}}
                    <p class="text-sm text-zinc-600 dark:text-zinc-300 leading-relaxed line-clamp-3 mb-6 flex-1">
                        {{ $box->box_description ?: 'No description provided for this community.' }}
                    </p>

                    {{-- Footer Info & Action --}}
                    <div class="pt-5 border-t border-zinc-100 dark:border-zinc-800 flex items-center justify-between mt-auto">
                      

                        <a href="{{ route('feedbox', $box->id) }}" wire:navigate class="inline-flex items-center gap-1 text-sm font-semibold text-blue-600 dark:text-blue-400 hover:underline">
                            View Box
                            <flux:icon icon="arrow-right" variant="mini" class="w-3 h-3" />
                        </a>
                    </div>
                </div>
            </div>

        @empty
            {{-- EMPTY STATE --}}
            <div class="col-span-1 md:col-span-2 lg:col-span-3 py-16 text-center">
                <div class="bg-zinc-50 dark:bg-zinc-900/50 border border-zinc-200 dark:border-zinc-800 rounded-3xl p-10 max-w-md mx-auto">
                    <div class="w-16 h-16 bg-white dark:bg-zinc-800 rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm">
                        <flux:icon icon="magnifying-glass" class="w-8 h-8 text-zinc-400" />
                    </div>
                    <h3 class="text-lg font-bold text-zinc-900 dark:text-white mb-2">No communities found</h3>
                    <p class="text-zinc-500 dark:text-zinc-400 text-sm mb-6">
                        We couldn't find any public boxes matching "<strong>{{ $search }}</strong>". Try a different keyword or browse all boxes.
                    </p>
                    <flux:button wire:click="$set('search', '')" variant="primary">Clear Search</flux:button>
                </div>
            </div>
        @endforelse

    </div>
</div>