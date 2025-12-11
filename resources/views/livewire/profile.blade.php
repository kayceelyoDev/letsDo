<div class="max-w-3xl mx-auto py-6 sm:py-10 px-4 sm:px-6 space-y-6 sm:space-y-8">

    {{-- 1. PROFILE HEADER CARD --}}
    <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-2xl p-5 sm:p-6 shadow-sm">
        <div class="flex flex-col sm:flex-row items-center gap-5 sm:gap-6 text-center sm:text-left">
            
            {{-- Avatar --}}
            <div class="shrink-0">
                <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center text-xl sm:text-2xl font-bold text-zinc-400 border-4 border-white dark:border-zinc-900 shadow-sm">
                    {{ strtoupper(substr($this->user->name, 0, 1)) }}
                </div>
            </div>

            {{-- User Info --}}
            <div class="flex-1 min-w-0 space-y-0.5 w-full">
                <flux:heading size="lg" level="1" class="truncate">{{ $this->user->name }}</flux:heading>
                <div class="text-zinc-500 text-sm truncate">{{ $this->user->email }}</div>
                <div class="text-zinc-400 text-xs mt-1">Member since {{ $this->user->created_at->format('M Y') }}</div>
            </div>

            {{-- Stats Grid --}}
            <div class="w-full sm:w-auto grid grid-cols-3 sm:flex sm:gap-6 border-t sm:border-t-0 sm:border-l border-zinc-100 dark:border-zinc-800 pt-4 sm:pt-0 sm:pl-6 mt-2 sm:mt-0">
                <div class="text-center">
                    <div class="text-lg sm:text-xl font-bold text-zinc-900 dark:text-white">{{ $this->stats['joined_boxes'] }}</div>
                    <div class="text-[10px] font-medium text-zinc-500 uppercase tracking-wide">Joined</div>
                </div>
                <div class="text-center border-l sm:border-none border-zinc-100 dark:border-zinc-800">
                    <div class="text-lg sm:text-xl font-bold text-zinc-900 dark:text-white">{{ $this->stats['total_messages'] }}</div>
                    <div class="text-[10px] font-medium text-zinc-500 uppercase tracking-wide">Posts</div>
                </div>
                <div class="text-center border-l sm:border-none border-zinc-100 dark:border-zinc-800">
                    <div class="text-lg sm:text-xl font-bold text-zinc-900 dark:text-white">{{ $this->stats['total_upvotes'] }}</div>
                    <div class="text-[10px] font-medium text-zinc-500 uppercase tracking-wide">Upvotes</div>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. ACTIVITY HISTORY --}}
    <div class="space-y-4">
        <div class="flex items-center gap-2 px-1">
            <flux:icon icon="clock" variant="mini" class="text-zinc-400" />
            <flux:heading size="base">Recent Activity</flux:heading>
        </div>

        <div class="space-y-3">
            @forelse ($this->messageHistory as $msg)
                <div class="group relative bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl p-4 sm:p-5 hover:border-zinc-300 dark:hover:border-zinc-700 transition-all duration-200">
                    
                    {{-- Message Header --}}
                    <div class="flex justify-between items-start mb-2 gap-3">
                        <div class="flex flex-wrap items-center gap-x-2 gap-y-0.5 text-xs sm:text-sm min-w-0">
                            <span class="text-zinc-500 text-[11px] sm:text-xs">Posted in</span>
                            <a href="{{ route('feedbox', $msg->box->id) }}" wire:navigate class="font-medium text-indigo-600 dark:text-indigo-400 hover:underline flex items-center gap-1 truncate max-w-[140px] sm:max-w-none">
                                <flux:icon icon="archive-box" variant="mini" class="w-3 h-3 shrink-0" />
                                <span class="truncate">{{ $msg->box->box_name }}</span>
                            </a>
                            <span class="hidden sm:inline text-zinc-300 dark:text-zinc-700">•</span>
                            <span class="text-[11px] sm:text-xs text-zinc-400 whitespace-nowrap">{{ $msg->created_at->diffForHumans() }}</span>
                        </div>

                        {{-- Actions Dropdown --}}
                        <flux:dropdown align="end">
                            <flux:button icon="ellipsis-horizontal" variant="ghost" size="sm" class="-mr-2 -mt-1 text-zinc-400 h-6 w-6" />
                            <flux:menu>
                                <flux:menu.item icon="pencil-square" wire:click="editMessage({{ $msg->id }})">Edit</flux:menu.item>
                                <flux:menu.item icon="trash" variant="danger" wire:click="deleteMessage({{ $msg->id }})" wire:confirm="Delete this message?">Delete</flux:menu.item>
                            </flux:menu>
                        </flux:dropdown>
                    </div>

                    {{-- Message Content (FIXED WHITESPACE) --}}
                    @php
                        $isLongText = Str::length($msg->content) > 250;
                    @endphp

                    <div x-data="{ expanded: false }" class="mb-3 relative">
                        {{-- IMPORTANT: The text content must touch the div tag directly to prevent indentation --}}
                        <div class="text-zinc-800 dark:text-zinc-200 text-sm leading-relaxed whitespace-pre-wrap break-words transition-all duration-300"
                             :class="expanded ? 'max-h-96 overflow-y-auto pr-2' : '{{ $isLongText ? 'max-h-20 overflow-hidden' : '' }}'">{{ $msg->content }}@if($isLongText)<div x-show="!expanded" class="absolute bottom-0 left-0 w-full h-8 bg-gradient-to-t from-white dark:from-zinc-900 to-transparent pointer-events-none"></div>@endif</div>

                        {{-- Toggle Button --}}
                        @if($isLongText)
                            <button @click="expanded = !expanded" 
                                    class="mt-1 text-[11px] font-semibold text-blue-600 dark:text-blue-400 hover:text-blue-500 hover:underline focus:outline-none flex items-center gap-1">
                                <span x-text="expanded ? 'Show Less' : 'Show More'"></span>
                                <div x-show="expanded" style="display: none;">
                                    <flux:icon icon="chevron-up" variant="mini" class="w-3 h-3" />
                                </div>
                                <div x-show="!expanded">
                                    <flux:icon icon="chevron-down" variant="mini" class="w-3 h-3" />
                                </div>
                            </button>
                        @endif
                    </div>

                    {{-- Footer: Upvotes --}}
                    <div class="flex items-center gap-1 text-[11px] font-medium text-zinc-500 bg-zinc-50 dark:bg-zinc-800/50 w-fit px-2 py-0.5 rounded border border-zinc-100 dark:border-zinc-800">
                        <flux:icon icon="arrow-up" variant="mini" class="w-3 h-3 text-orange-500" />
                        <span>{{ $msg->upvotes }} Upvotes</span>
                    </div>
                </div>
            @empty
                <div class="text-center py-10">
                    <div class="w-12 h-12 bg-zinc-100 dark:bg-zinc-800 rounded-full flex items-center justify-center mx-auto mb-3">
                        <flux:icon icon="chat-bubble-left-right" variant="solid" class="w-6 h-6 text-zinc-300" />
                    </div>
                    <p class="text-sm text-zinc-500">You haven't posted any messages yet.</p>
                    <div class="mt-3">
                        <flux:button href="{{ route('dashboard') }}" variant="subtle" size="sm">Explore Feedboxes</flux:button>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    {{-- EDIT MODAL --}}
    <flux:modal wire:model="showEditModal" class="w-full sm:w-96">
        <div class="space-y-4">
            <div>
                <flux:heading size="lg">Edit Message</flux:heading>
            </div>
            <flux:textarea wire:model="content" rows="4" class="resize-none" />
            <div class="flex flex-col sm:flex-row gap-2 pt-2">
                <flux:button wire:click="updateMessage" variant="primary" class="w-full">Save Changes</flux:button>
                <flux:button wire:click="$set('showEditModal', false)" variant="ghost" class="w-full">Cancel</flux:button>
            </div>
        </div>
    </flux:modal>

</div>