<div class="min-h-screen bg-white dark:bg-zinc-950 pb-20 sm:pb-12">
    
    {{-- TOP NAVIGATION & HERO --}}
    <div class="relative bg-white dark:bg-zinc-950 pt-4 sm:pt-6 pb-2 px-3 sm:px-6">
        <div class="max-w-2xl mx-auto">
            {{-- Meta Header --}}
            <div class="flex items-start justify-between mb-3 sm:mb-4 gap-2">
                <div class="space-y-1 min-w-0 flex-1">
                    <div class="flex items-center gap-2 sm:gap-3 flex-wrap">
                        <h1 class="text-xl sm:text-2xl md:text-3xl font-bold tracking-tight text-zinc-900 dark:text-white truncate">
                            {{ $box->box_name }}
                        </h1>
                        <span class="px-2 py-0.5 rounded-full bg-zinc-100 dark:bg-zinc-800 text-[10px] uppercase tracking-wider font-bold text-zinc-500 border border-zinc-200 dark:border-zinc-700 whitespace-nowrap">
                            {{ $box->privacy }}
                        </span>
                    </div>
                    <div class="flex items-center gap-2 text-xs sm:text-sm text-zinc-500">
                        <span class="truncate">Curated by <span class="text-zinc-900 dark:text-zinc-200 font-medium">{{ $box->user->name }}</span></span>
                    </div>
                </div>

                {{-- Desktop Actions --}}
                <div class="hidden sm:flex items-center gap-2 shrink-0">
                    @if (auth()->id() == $box->user->id || $box->privacy == 'Public')
                        <flux:button icon="share" variant="ghost" size="sm" x-on:click="navigator.clipboard.writeText('{{ route('feedbox', $box->id) }}'); $wire.dispatch('trigger-toast', { message: 'Link copied!' });" />
                    @endif
                    
                    @if (auth()->id() === $box->user->id)
                        <flux:button icon="users" variant="ghost" size="sm" wire:click="$set('showCommunityModal', true)" class="relative">
                            @if ($this->pendingList->count() > 0)
                                <div class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full border-2 border-white dark:border-zinc-950"></div>
                            @endif
                        </flux:button>
                        <flux:dropdown align="end">
                            <flux:button icon="cog-6-tooth" variant="ghost" size="sm" />
                            <flux:menu>
                                <flux:menu.item icon="pencil-square" wire:click="editBox">Edit Details</flux:menu.item>
                                <flux:menu.separator />
                                <flux:menu.item icon="trash" variant="danger" wire:click="confirmDeleteBox">Delete Box</flux:menu.item>
                            </flux:menu>
                        </flux:dropdown>
                    @else
                        <flux:dropdown align="end">
                            <flux:button icon="ellipsis-horizontal" variant="ghost" size="sm" />
                            <flux:menu>
                                <flux:menu.item icon="arrow-right-start-on-rectangle" variant="danger" wire:click="confirmLeaveBox">Leave Box</flux:menu.item>
                            </flux:menu>
                        </flux:dropdown>
                    @endif
                    
                    <flux:button wire:click="$set('showModal', true)" variant="primary" size="sm" icon="plus">Post</flux:button>
                </div>

                {{-- Mobile Settings Icon (Top Right) --}}
                <div class="sm:hidden shrink-0">
                    <flux:dropdown align="end">
                        <flux:button icon="ellipsis-horizontal" variant="subtle" size="sm" />
                        <flux:menu>
                            @if (auth()->id() === $box->user->id)
                                <flux:menu.item icon="users" wire:click="$set('showCommunityModal', true)">
                                    Community 
                                    @if ($this->pendingList->count() > 0) ({{ $this->pendingList->count() }} Pending) @endif
                                </flux:menu.item>
                                <flux:menu.item icon="pencil-square" wire:click="editBox">Edit Details</flux:menu.item>
                                <flux:menu.separator />
                                <flux:menu.item icon="trash" variant="danger" wire:click="confirmDeleteBox">Delete Box</flux:menu.item>
                            @else
                                <flux:menu.item icon="arrow-right-start-on-rectangle" variant="danger" wire:click="confirmLeaveBox">Leave Box</flux:menu.item>
                            @endif
                            <flux:menu.item icon="share" x-on:click="navigator.clipboard.writeText('{{ route('feedbox', $box->id) }}'); $wire.dispatch('trigger-toast', { message: 'Link copied!' });">Share Link</flux:menu.item>
                        </flux:menu>
                    </flux:dropdown>
                </div>
            </div>
        </div>
    </div>

    {{-- STICKY TABS --}}
    <div class="sticky top-0 z-10 bg-white/95 dark:bg-zinc-950/95 backdrop-blur-xl border-b border-zinc-100 dark:border-zinc-800">
        <div class="max-w-2xl mx-auto px-3 sm:px-6">
            <div class="flex items-center gap-4 sm:gap-6 overflow-x-auto no-scrollbar">
                @foreach (['latest' => 'Latest', 'top' => 'Top Rated', 'my_posts' => 'My Posts'] as $key => $label)
                    <button wire:click="setTab('{{ $key }}')"
                        class="relative py-2.5 sm:py-3 text-sm sm:text-[15px] font-medium transition-colors whitespace-nowrap outline-none
                        {{ $activeTab === $key ? 'text-zinc-900 dark:text-white font-semibold' : 'text-zinc-500 hover:text-zinc-800 dark:text-zinc-400 dark:hover:text-zinc-200' }}">
                        {{ $label }}
                        @if($activeTab === $key)
                            <div class="absolute bottom-0 left-0 right-0 h-[2px] bg-zinc-900 dark:bg-white rounded-full"></div>
                        @endif
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    {{-- FEED STREAM --}}
    <div class="max-w-2xl mx-auto px-0 sm:px-6 py-2 sm:py-3" wire:poll.5s>
        <div class="space-y-0 sm:space-y-3">
            @forelse ($userMessages as $msg)
                <div class="group bg-white dark:bg-zinc-950 sm:bg-zinc-50/50 sm:dark:bg-zinc-900/50 sm:rounded-2xl border-b sm:border border-zinc-100 dark:border-zinc-800 px-2 py-1.5 sm:px-2.5 sm:py-2 transition-colors">
                    <div class="flex gap-2">
                        {{-- Avatar Column --}}
                        <div class="shrink-0">
                            <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center font-bold text-zinc-500 text-xs ring-1 ring-zinc-200 dark:ring-zinc-700">
                                {{ strtoupper(substr($msg->user?->name ?? 'A', 0, 1)) }}
                            </div>
                        </div>

                        {{-- Content Column --}}
                        <div class="flex-1 min-w-0">
                            {{-- Header --}}
                            <div class="flex justify-between items-start gap-2">
                                <div class="flex items-baseline gap-1.5 sm:gap-2 min-w-0 flex-1">
                                    <span class="font-bold text-zinc-900 dark:text-white text-sm sm:text-[15px] truncate">
                                        {{ $msg->user->name ?? 'Anonymous' }}
                                    </span>
                                    <span class="text-[11px] sm:text-xs text-zinc-400 shrink-0">
                                        {{ $msg->readable_date }}
                                    </span>
                                </div>
                                
                                @if (auth()->id() === $msg->user_id)
                                    <flux:dropdown align="end">
                                        <button class="text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-200 p-1 -mr-2 -mt-1 shrink-0">
                                            <flux:icon icon="ellipsis-horizontal" variant="mini" />
                                        </button>
                                        <flux:menu>
                                            <flux:menu.item icon="pencil-square" wire:click="editMessage({{ $msg->id }})">Edit</flux:menu.item>
                                            <flux:menu.item icon="trash" variant="danger" wire:click="deleteMessage({{ $msg->id }})">Delete</flux:menu.item>
                                        </flux:menu>
                                    </flux:dropdown>
                                @endif
                            </div>

                            {{-- SCROLLABLE TEXT with fixed height --}}
                            @php $isLong = Str::length($msg['content']) > 150; @endphp
                            <div x-data="{ expanded: false }" class="mt-0.5 sm:mt-1">
                                <div 
                                    x-bind:class="expanded ? 'max-h-[250px] overflow-y-auto' : 'max-h-[80px] overflow-hidden'"
                                    class="text-sm sm:text-[15px] leading-relaxed text-zinc-800 dark:text-zinc-200 whitespace-pre-wrap break-words scrollbar-thin scrollbar-thumb-zinc-300 dark:scrollbar-thumb-zinc-700 scrollbar-track-transparent pr-2"
                                    style="scrollbar-width: thin;"
                                >{{ trim($msg['content']) }}</div>
                                @if($isLong)
                                    <button @click="expanded = !expanded" class="text-xs font-medium text-zinc-500 hover:text-zinc-900 dark:hover:text-white mt-1 flex items-center gap-1">
                                        <span x-text="expanded ? 'Show less' : 'Read more'"></span>
                                    </button>
                                @endif
                            </div>

                            {{-- LARGER VOTING BUTTONS --}}
                            <div class="mt-1.5 flex items-center gap-3 sm:gap-4">
                                <div class="inline-flex items-center gap-2">
                                    <button wire:click="toggleVote({{ $msg->id }}, 'up')" 
                                        class="group flex items-center justify-center w-9 h-9 sm:w-10 sm:h-10 rounded-lg transition-all {{ $msg->userVote?->type === 'up' ? 'text-orange-600 bg-orange-100 dark:bg-orange-950' : 'text-zinc-400 hover:bg-orange-50 hover:text-orange-500 dark:hover:bg-zinc-800 active:scale-95' }}">
                                        <flux:icon icon="arrow-up" variant="solid" class="w-5 h-5 sm:w-6 sm:h-6" />
                                    </button>
                                    
                                    <span class="text-sm sm:text-base font-bold tabular-nums min-w-[2rem] text-center {{ ($msg->upvotes - $msg->downvotes) > 0 ? 'text-orange-600' : 'text-zinc-500' }}">
                                        {{ $msg->upvotes - $msg->downvotes }}
                                    </span>

                                    <button wire:click="toggleVote({{ $msg->id }}, 'down')" 
                                        class="group flex items-center justify-center w-9 h-9 sm:w-10 sm:h-10 rounded-lg transition-all {{ $msg->userVote?->type === 'down' ? 'text-indigo-600 bg-indigo-100 dark:bg-indigo-950' : 'text-zinc-400 hover:bg-indigo-50 hover:text-indigo-500 dark:hover:bg-zinc-800 active:scale-95' }}">
                                        <flux:icon icon="arrow-down" variant="solid" class="w-5 h-5 sm:w-6 sm:h-6" />
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="py-16 sm:py-20 text-center px-4 sm:px-6">
                    <div class="inline-flex items-center justify-center w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-zinc-50 dark:bg-zinc-900 mb-3 sm:mb-4">
                        <flux:icon icon="pencil-square" class="text-zinc-300 w-7 h-7 sm:w-8 sm:h-8" />
                    </div>
                    <h3 class="text-base sm:text-lg font-semibold text-zinc-900 dark:text-white">Start the conversation</h3>
                    <p class="text-sm sm:text-base text-zinc-500 mt-1 mb-4 sm:mb-6 max-w-sm mx-auto">This feed is empty. Be the first to share something with the group.</p>
                    <flux:button wire:click="$set('showModal', true)" variant="primary" size="sm">Create First Post</flux:button>
                </div>
            @endforelse
        </div>
    </div>

    {{-- FLOATING ACTION BUTTON (MOBILE ONLY) --}}
    <div class="fixed bottom-6 right-4 sm:hidden z-40">
        <button wire:click="$set('showModal', true)" class="w-14 h-14 bg-zinc-900 dark:bg-white text-white dark:text-zinc-900 rounded-full shadow-lg flex items-center justify-center hover:scale-105 active:scale-95 transition-transform">
            <flux:icon icon="plus" class="w-6 h-6 stroke-2" />
        </button>
    </div>

    {{-- MODALS --}}

    {{-- Create/Edit Post Modal --}}
    @if($showModal)
        <flux:modal wire:model="showModal" class="z-50">
            <div class="space-y-4" x-data="{ charCount: 0 }" x-init="charCount = ($wire.content || '').length">
                <div class="flex items-center justify-between">
                    <flux:heading size="lg">{{ $editingMessageId ? 'Edit Post' : 'New Post' }}</flux:heading>
                </div>
                @if ($errorMessages)
                    <div class="p-3 bg-red-50 text-red-600 text-sm rounded-lg border border-red-100 flex gap-2">
                        <flux:icon icon="exclamation-circle" variant="mini" class="mt-0.5 shrink-0" />
                        <span>{{ $errorMessages }}</span>
                    </div>
                @endif
                <div>
                    <flux:textarea 
                        wire:model="content" 
                        rows="6" 
                        placeholder="What's happening?" 
                        class="resize-none text-base sm:text-lg border-0 bg-transparent focus:ring-0 px-2"
                        maxlength="250"
                        x-on:input="charCount = $event.target.value.length"
                    />
                    <div class="flex justify-end mt-2">
                        <span class="text-xs" :class="charCount >= 250 ? 'text-red-500 font-semibold' : 'text-zinc-400'">
                            <span x-text="charCount"></span>/250
                        </span>
                    </div>
                </div>
                <div class="flex justify-end gap-2 sm:gap-3 pt-2 border-t border-zinc-100 dark:border-zinc-800">
                    <flux:button wire:click="resetModal" variant="ghost" size="sm">Cancel</flux:button>
                    <flux:button wire:click="saveMessage" variant="primary" size="sm">{{ $editingMessageId ? 'Update' : 'Post' }}</flux:button>
                </div>
            </div>
        </flux:modal>
    @endif

    {{-- Community Modal --}}
    @if($showCommunityModal)
        <flux:modal wire:model="showCommunityModal" class="z-50">
            <div class="flex-1 min-h-0 flex flex-col max-h-[70vh]">
                <div class="shrink-0 pb-3 sm:pb-4 border-b border-zinc-100 dark:border-zinc-800 mb-2 sm:mb-3">
                    <flux:heading size="lg">Community</flux:heading>
                </div>
                
                <div class="flex gap-4 sm:gap-6 border-b border-zinc-100 dark:border-zinc-800 shrink-0 mb-3 sm:mb-4">
                    <button wire:click="$set('communityTab', 'members')" class="pb-2 text-xs sm:text-sm font-medium border-b-2 transition-colors {{ $communityTab === 'members' ? 'border-zinc-900 text-zinc-900 dark:border-white dark:text-white' : 'border-transparent text-zinc-500' }}">
                        Members
                    </button>
                    <button wire:click="$set('communityTab', 'requests')" class="pb-2 text-xs sm:text-sm font-medium border-b-2 transition-colors relative {{ $communityTab === 'requests' ? 'border-zinc-900 text-zinc-900 dark:border-white dark:text-white' : 'border-transparent text-zinc-500' }}">
                        Requests
                        @if ($this->pendingList->count() > 0)
                            <span class="ml-1 bg-red-500 text-white text-[10px] px-1.5 rounded-full">{{ $this->pendingList->count() }}</span>
                        @endif
                    </button>
                </div>

                <div class="overflow-y-auto flex-1 -mr-2 pr-2" style="scrollbar-width: thin;">
                    @if ($communityTab === 'members')
                        <div class="space-y-1.5 sm:space-y-2">
                            @foreach ($this->membersList as $member)
                                <div class="flex items-center justify-between p-2 hover:bg-zinc-50 dark:hover:bg-zinc-900 rounded-lg">
                                    <div class="flex items-center gap-2.5 sm:gap-3 min-w-0 flex-1">
                                        <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center text-xs font-bold text-zinc-500 shrink-0">
                                            {{ substr($member->user->name, 0, 1) }}
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <div class="text-xs sm:text-sm font-medium truncate">{{ $member->user->name }}</div>
                                            <div class="text-[10px] text-zinc-400">Joined {{ $member->created_at->format('M Y') }}</div>
                                        </div>
                                    </div>
                                    <flux:button icon="no-symbol" variant="ghost" size="sm" class="text-zinc-400 hover:text-red-500 shrink-0" wire:click="banMember({{ $member->user->id }})" wire:confirm="Ban this user?" />
                                </div>
                            @endforeach
                        </div>
                    @else
                        @if($this->pendingList->isEmpty())
                            <div class="text-center py-12 text-zinc-400 text-xs sm:text-sm">No pending requests</div>
                        @else
                            <div class="space-y-2">
                                @foreach ($this->pendingList as $request)
                                    <div class="flex items-center justify-between p-2.5 sm:p-3 bg-zinc-50 dark:bg-zinc-900 rounded-lg gap-2">
                                        <span class="text-xs sm:text-sm font-medium truncate flex-1 min-w-0">{{ $request->user->name }}</span>
                                        <div class="flex gap-1.5 sm:gap-2 shrink-0">
                                            <button wire:click="acceptRequest({{ $request->id }})" class="w-7 h-7 sm:w-8 sm:h-8 flex items-center justify-center rounded-full bg-green-100 text-green-600 hover:bg-green-200 transition-colors">
                                                <flux:icon icon="check" variant="mini" />
                                            </button>
                                            <button wire:click="denyRequest({{ $request->id }})" class="w-7 h-7 sm:w-8 sm:h-8 flex items-center justify-center rounded-full bg-red-100 text-red-600 hover:bg-red-200 transition-colors">
                                                <flux:icon icon="x-mark" variant="mini" />
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </flux:modal>
    @endif

    {{-- Edit Box Modal --}}
    @if($showEditBoxModal)
        <flux:modal wire:model="showEditBoxModal" class="z-50">
            <div class="space-y-4">
                <flux:heading size="lg">Box Settings</flux:heading>
                <flux:input wire:model="edit_box_name" label="Name" />
                <flux:textarea wire:model="edit_box_description" label="Description" rows="3" />
                <flux:radio.group wire:model="edit_privacy" label="Privacy">
                    <flux:radio value="Public" label="Public" />
                    <flux:radio value="Private" label="Private" />
                </flux:radio.group>
                <div class="flex justify-end gap-2 mt-4">
                    <flux:button wire:click="$set('showEditBoxModal', false)" variant="ghost" size="sm">Cancel</flux:button>
                    <flux:button wire:click="updateBox" variant="primary" size="sm">Save</flux:button>
                </div>
            </div>
        </flux:modal>
    @endif

    {{-- Delete Confirmation Modal --}}
    @if($showDeleteConfirmModal)
        <flux:modal wire:model="showDeleteConfirmModal" class="z-50">
            <div class="text-center p-2">
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4">
                    <flux:icon icon="trash" class="w-5 h-5 sm:w-6 sm:h-6" />
                </div>
                <flux:heading size="lg">Delete this box?</flux:heading>
                <p class="text-xs sm:text-sm text-zinc-500 mt-2 mb-4 sm:mb-6">All posts and data will be permanently removed.</p>
                <div class="flex flex-col gap-2">
                    <flux:button wire:click="deleteBox" variant="danger" class="w-full" size="sm">Delete Everything</flux:button>
                    <flux:button wire:click="$set('showDeleteConfirmModal', false)" variant="ghost" class="w-full" size="sm">Cancel</flux:button>
                </div>
            </div>
        </flux:modal>
    @endif

    {{-- Leave Confirmation Modal --}}
    @if($showLeaveConfirmModal)
        <flux:modal wire:model="showLeaveConfirmModal" class="z-50">
            <div class="text-center p-2">
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-orange-100 text-orange-600 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4">
                    <flux:icon icon="arrow-right-start-on-rectangle" class="w-5 h-5 sm:w-6 sm:h-6" />
                </div>
                <flux:heading size="lg">Leave box?</flux:heading>
                <p class="text-xs sm:text-sm text-zinc-500 mt-2 mb-4 sm:mb-6">You will need to request access to join again.</p>
                <div class="flex flex-col gap-2">
                    <flux:button wire:click="leaveBox" variant="danger" class="w-full" size="sm">Leave</flux:button>
                    <flux:button wire:click="$set('showLeaveConfirmModal', false)" variant="ghost" class="w-full" size="sm">Cancel</flux:button>
                </div>
            </div>
        </flux:modal>
    @endif

</div>