<div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 space-y-10">

    {{-- 1. PROFILE HEADER CARD --}}
    <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-2xl p-8 shadow-sm">
        <div class="flex flex-col sm:flex-row items-center gap-6 text-center sm:text-left">
            
            {{-- Avatar --}}
            <div class="w-24 h-24 rounded-full bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center text-3xl font-bold text-zinc-400 border-4 border-white dark:border-zinc-900 shadow-sm">
                {{ strtoupper(substr($this->user->name, 0, 1)) }}
            </div>

            {{-- User Info --}}
            <div class="flex-1 space-y-1">
                <flux:heading size="xl" level="1">{{ $this->user->name }}</flux:heading>
                <div class="text-zinc-500 text-sm">{{ $this->user->email }}</div>
                <div class="text-zinc-400 text-xs">Member since {{ $this->user->created_at->format('M Y') }}</div>
            </div>

            {{-- Stats Grid --}}
            <div class="flex gap-6 sm:gap-8 border-t sm:border-t-0 sm:border-l border-zinc-100 dark:border-zinc-800 pt-4 sm:pt-0 sm:pl-8 mt-4 sm:mt-0">
                <div class="text-center">
                    <div class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $this->stats['joined_boxes'] }}</div>
                    <div class="text-xs font-medium text-zinc-500 uppercase tracking-wide">Joined</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $this->stats['total_messages'] }}</div>
                    <div class="text-xs font-medium text-zinc-500 uppercase tracking-wide">Posts</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $this->stats['total_upvotes'] }}</div>
                    <div class="text-xs font-medium text-zinc-500 uppercase tracking-wide">Upvotes</div>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. ACTIVITY HISTORY --}}
    <div class="space-y-6">
        <div class="flex items-center gap-2 px-1">
            <flux:icon icon="clock" variant="mini" class="text-zinc-400" />
            <flux:heading size="lg">Recent Activity</flux:heading>
        </div>

        <div class="space-y-4">
            @forelse ($this->messageHistory as $msg)
                <div class="group relative bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl p-5 hover:border-zinc-300 dark:hover:border-zinc-700 transition-all duration-200">
                    
                    {{-- Message Header: Box Name & Date --}}
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex items-center gap-2 text-sm">
                            <span class="text-zinc-500">Posted in</span>
                            <a href="{{ route('feedbox', $msg->box->id) }}" wire:navigate class="font-medium text-indigo-600 dark:text-indigo-400 hover:underline flex items-center gap-1">
                                <flux:icon icon="archive-box" variant="mini" class="w-3 h-3" />
                                {{ $msg->box->box_name }}
                            </a>
                            <span class="text-zinc-300 dark:text-zinc-700">•</span>
                            <span class="text-xs text-zinc-400">{{ $msg->created_at->diffForHumans() }}</span>
                        </div>

                        {{-- Actions Dropdown --}}
                        <flux:dropdown align="end">
                            <flux:button icon="ellipsis-horizontal" variant="ghost" size="sm" class="-mr-2 text-zinc-400" />
                            <flux:menu>
                                <flux:menu.item icon="pencil-square" wire:click="editMessage({{ $msg->id }})">Edit</flux:menu.item>
                                <flux:menu.item icon="trash" variant="danger" wire:click="deleteMessage({{ $msg->id }})" wire:confirm="Delete this message?">Delete</flux:menu.item>
                            </flux:menu>
                        </flux:dropdown>
                    </div>

                    {{-- Message Content --}}
                    <div class="text-zinc-800 dark:text-zinc-200 text-[15px] leading-relaxed mb-4">
                        {{ $msg->content }}
                    </div>

                    {{-- Footer: Upvotes --}}
                    <div class="flex items-center gap-1.5 text-xs font-medium text-zinc-500 bg-zinc-50 dark:bg-zinc-800/50 w-fit px-2 py-1 rounded-md border border-zinc-100 dark:border-zinc-800">
                        <flux:icon icon="arrow-up" variant="mini" class="w-3 h-3 text-orange-500" />
                        <span>{{ $msg->upvotes }} Upvotes</span>
                    </div>

                </div>
            @empty
                <div class="text-center py-12">
                    <div class="w-16 h-16 bg-zinc-100 dark:bg-zinc-800 rounded-full flex items-center justify-center mx-auto mb-4">
                        <flux:icon icon="chat-bubble-left-right" variant="solid" class="w-8 h-8 text-zinc-300" />
                    </div>
                    <p class="text-zinc-500">You haven't posted any messages yet.</p>
                    <div class="mt-4">
                        <flux:button href="{{ route('dashboard') }}" variant="subtle">Explore Feedboxes</flux:button>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    {{-- EDIT MODAL --}}
    <flux:modal wire:model="showEditModal" class="w-full sm:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Edit Message</flux:heading>
            </div>
            <flux:textarea wire:model="content" rows="4" />
            <div class="flex gap-2">
                <flux:button wire:click="updateMessage" variant="primary" class="w-full">Save Changes</flux:button>
                <flux:button wire:click="$set('showEditModal', false)" variant="ghost" class="w-full">Cancel</flux:button>
            </div>
        </div>
    </flux:modal>

</div>