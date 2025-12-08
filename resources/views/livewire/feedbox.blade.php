<div class="max-w-xl mx-auto space-y-8 py-10 px-4 sm:px-0">
    
    <div class="space-y-4">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <flux:heading size="xl">{{ $box->box_name }}</flux:heading>
                <flux:subheading>
                    Created by <span class="font-medium text-zinc-800 dark:text-zinc-200">{{ $box->user->name }}</span>
                </flux:subheading>
            </div>
            
            <div class="flex items-center gap-2">
                
                <flux:button wire:click="$set('showModal', true)" variant="primary" icon="plus">
                    New Post
                </flux:button>

                @if (auth()->id() == $box->user->id || $box->privacy == "Public")
                    <flux:button 
                        icon="share" 
                        variant="subtle"
                        onclick="navigator.clipboard.writeText(window.location.href); alert('Link copied!');" 
                    />
                @endif
            </div>
        </div>

        <div class="flex p-1 bg-zinc-100 dark:bg-zinc-800 rounded-lg w-full sm:w-fit">
            <button 
                wire:click="setTab('latest')"
                class="flex-1 sm:flex-none px-4 py-1.5 text-sm font-medium rounded-md transition-all duration-200 text-center
                {{ $activeTab === 'latest' ? 'bg-white dark:bg-zinc-600 shadow-sm text-zinc-900 dark:text-white' : 'text-zinc-500 hover:text-zinc-700 dark:hover:text-zinc-300' }}"
            >
                Latest
            </button>

            <button 
                wire:click="setTab('top')" 
                class="flex-1 sm:flex-none px-4 py-1.5 text-sm font-medium rounded-md transition-all duration-200 text-center
                {{ $activeTab === 'top' ? 'bg-white dark:bg-zinc-600 shadow-sm text-zinc-900 dark:text-white' : 'text-zinc-500 hover:text-zinc-700 dark:hover:text-zinc-300' }}"
            >
                Top Rated
            </button>
        </div>
    </div>

    <div class="space-y-5">
        @foreach($this->messages as $msg)
            <div class="p-5 bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl shadow-sm hover:border-zinc-300 dark:hover:border-zinc-700 transition duration-200 space-y-4">
                <div class="flex justify-between items-start gap-3">
                    <div class="flex gap-3 min-w-0"> 
                        <div class="w-10 h-10 rounded-full bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center font-bold text-zinc-600 dark:text-zinc-400 text-sm shrink-0">
                            {{ $msg['avatar_initial'] }}
                        </div>
                        <div>
                            <div class="font-semibold text-sm text-zinc-900 dark:text-white truncate">
                                {{ $msg['username'] }}
                            </div>
                            <div class="text-xs text-zinc-500">
                                {{ $msg['time_ago'] }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-zinc-700 dark:text-zinc-300 leading-relaxed text-[15px]">
                    {{ $msg['content'] }}
                </div>

                <div class="h-px bg-zinc-100 dark:bg-zinc-800/50"></div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-1 bg-zinc-50 dark:bg-zinc-800/50 rounded-lg p-1">
                        <button class="p-1 rounded hover:bg-white dark:hover:bg-zinc-700 text-zinc-400 hover:text-orange-500 transition shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="size-4">
                              <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                            </svg>
                        </button>
                        <span class="font-bold text-sm min-w-[24px] text-center text-zinc-700 dark:text-zinc-300">
                            {{ $msg['upvotes'] - $msg['downvotes'] }}
                        </span>
                        <button class="p-1 rounded hover:bg-white dark:hover:bg-zinc-700 text-zinc-400 hover:text-indigo-500 transition shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="size-4">
                              <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <flux:modal wire:model="showModal" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Create a message</flux:heading>
                <flux:subheading>Any exciting thoughts?</flux:subheading>
            </div>

            <flux:textarea 
                wire:model="newContent" 
                rows="4" 
                placeholder="Share something..." 
            />

            <div class="flex gap-2">
                <flux:button wire:click="createMessage" variant="primary" class="w-full">
                    Post Message
                </flux:button>
                
                <flux:button wire:click="$set('showModal', false)" variant="ghost" class="w-full">
                    Cancel
                </flux:button>
            </div>
        </div>
    </flux:modal>

</div>