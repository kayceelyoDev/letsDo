<div class="max-w-2xl mx-auto space-y-8 py-8 px-4 sm:px-6 sm:py-12">

    {{-- HEADER SECTION --}}
    <div class="space-y-6">
        <div class="flex flex-col md:flex-row md:items-start justify-between gap-4 md:gap-6">
            {{-- Title & Author --}}
            <div class="space-y-2 min-w-0 flex-1">
                <div class="flex items-center gap-3">
                    <flux:heading size="xl" class="truncate font-bold tracking-tight text-zinc-900 dark:text-white leading-tight">
                        {{ $box->box_name }}
                    </flux:heading>
                    <span class="px-2.5 py-0.5 rounded-full bg-zinc-100 dark:bg-zinc-800 text-xs font-semibold text-zinc-500 border border-zinc-200 dark:border-zinc-700 shrink-0">
                        {{ $box->privacy }}
                    </span>
                </div>

                <div class="flex items-center gap-2 text-sm text-zinc-500 dark:text-zinc-400">
                    <flux:icon icon="user" variant="mini" class="text-zinc-400 shrink-0" />
                    <span class="truncate">Curated by <span class="font-medium text-zinc-800 dark:text-zinc-200">{{ $box->user->name }}</span></span>
                </div>
            </div>

            {{-- Primary Actions --}}
            <div class="flex items-center gap-1.5 flex-wrap sm:gap-2 justify-start md:justify-end shrink-0">
                @if (auth()->id() === $box->user->id)
                    {{-- Member Count Badge --}}
                    <div class="relative">
                        <flux:button icon="users" variant="subtle" wire:click="$set('showCommunityModal', true)" />
                        @if ($this->pendingList->count() > 0)
                            <span class="absolute top-0 right-0 flex h-2.5 w-2.5 translate-x-1/4 -translate-y-1/4">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500"></span>
                            </span>
                        @endif
                    </div>

                    <flux:dropdown align="end">
                        <flux:button icon="cog-6-tooth" variant="subtle" />
                        <flux:menu>
                            <flux:menu.item icon="pencil-square" wire:click.stop="editBox">Edit Details</flux:menu.item>
                            <flux:menu.separator />
                            <flux:menu.item icon="trash" variant="danger" wire:click.stop="confirmDeleteBox">Delete Box</flux:menu.item>
                        </flux:menu>
                    </flux:dropdown>
                @else
                    <flux:dropdown align="end">
                        <flux:button icon="ellipsis-horizontal" variant="subtle" />
                        <flux:menu>
                            <flux:menu.item icon="arrow-right-start-on-rectangle" variant="danger" wire:click.stop="confirmLeaveBox">Leave Box</flux:menu.item>
                        </flux:menu>
                    </flux:dropdown>
                @endif

                @if (auth()->id() == $box->user->id || $box->privacy == 'Public')
                    <flux:button icon="share" variant="subtle"
                        x-on:click="navigator.clipboard.writeText('{{ route('feedbox', $box->id) }}'); $wire.dispatch('trigger-toast', { message: 'Link copied!' });" />
                @endif

                <div class="hidden sm:block w-px h-6 bg-zinc-200 dark:bg-zinc-700 mx-1"></div>

                <flux:button wire:click="$set('showModal', true)" variant="primary" icon="plus" class="w-full sm:w-auto">New Post</flux:button>
            </div>
        </div>

        {{-- TABS --}}
        <div class="w-full overflow-x-auto pb-1 no-scrollbar">
            <div class="flex p-1 space-x-1 bg-zinc-100/50 dark:bg-zinc-900/50 rounded-xl border border-zinc-200/50 dark:border-zinc-800 backdrop-blur-sm sm:w-fit min-w-full sm:min-w-0">
                @foreach (['latest' => 'Latest', 'top' => 'Top Rated', 'my_posts' => 'My Posts'] as $key => $label)
                    <button wire:click="setTab('{{ $key }}')"
                        class="flex-1 sm:flex-none px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 whitespace-nowrap
                        {{ $activeTab === $key
                            ? 'bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white shadow-sm ring-1 ring-zinc-900/5 dark:ring-white/10'
                            : 'text-zinc-500 hover:text-zinc-700 dark:hover:text-zinc-300 hover:bg-white/50 dark:hover:bg-zinc-800' }}">
                        {{ $label }}
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    {{-- FEED SECTION --}}
    <div class="space-y-6" wire:poll.5s>
        @forelse ($userMessages as $msg)
            <div class="group relative bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-200 dark:border-zinc-800 p-5 sm:p-6 shadow-sm hover:shadow-md hover:border-zinc-300 dark:hover:border-zinc-700 transition-all duration-300">

                {{-- Card Header --}}
                <div class="flex justify-between items-start mb-4">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-zinc-100 to-zinc-200 dark:from-zinc-800 dark:to-zinc-900 flex items-center justify-center text-sm font-bold text-zinc-600 dark:text-zinc-400 ring-1 ring-white dark:ring-zinc-800 shadow-sm shrink-0">
                            {{ strtoupper(substr($msg->user?->name ?? 'A', 0, 1)) }}
                        </div>
                        <div class="min-w-0">
                            <div class="font-semibold text-zinc-900 dark:text-zinc-100 text-sm truncate">
                                {{ $msg->user->name ?? 'Anonymous' }}
                            </div>
                            <div class="text-xs text-zinc-500 truncate">
                                {{ $msg->readable_date }}
                            </div>
                        </div>
                    </div>

                    @if (auth()->id() === $msg->user_id)
                        <flux:dropdown align="end">
                            <flux:button icon="ellipsis-horizontal" size="sm" variant="ghost" class="text-zinc-400 hover:text-zinc-600 -mr-2" />
                            <flux:menu>
                                <flux:menu.item icon="pencil-square" wire:click="editMessage({{ $msg->id }})">Edit</flux:menu.item>
                                <flux:menu.separator />
                                <flux:menu.item icon="trash" variant="danger" wire:click="deleteMessage({{ $msg->id }})">Delete</flux:menu.item>
                            </flux:menu>
                        </flux:dropdown>
                    @endif
                </div>

                {{-- Content --}}
                <div class="prose prose-zinc dark:prose-invert max-w-none mb-6">
                    <p class="text-[15px] leading-7 text-zinc-700 dark:text-zinc-300 text-pretty whitespace-pre-wrap break-words">{{ $msg['content'] }}</p>
                </div>

                {{-- Footer / Voting Pill --}}
                <div class="flex items-center justify-between select-none">
                    <div class="inline-flex items-center p-1 rounded-xl bg-zinc-50 dark:bg-zinc-800/50 border border-zinc-100 dark:border-zinc-800 shadow-sm">
                        
                        {{-- UPVOTE BUTTON --}}
                        <button wire:click="toggleVote({{ $msg->id }}, 'up')"
                            class="group relative p-1.5 rounded-lg transition-all duration-200 ease-[cubic-bezier(0.23,1,0.32,1)] active:scale-90
                            {{ $msg->userVote?->type === 'up' 
                                ? 'bg-orange-100 text-orange-600 ring-1 ring-orange-200 dark:bg-orange-500/20 dark:text-orange-400 dark:ring-orange-500/30' 
                                : 'text-zinc-400 hover:text-orange-500 hover:bg-orange-50 dark:hover:bg-orange-500/10' 
                            }}">
                            <flux:icon icon="chevron-up" variant="mini" class="w-4 h-4 stroke-[2.5]" />
                        </button>

                        {{-- SCORE --}}
                        <span class="min-w-[2.5rem] text-center text-sm font-bold tabular-nums transition-colors duration-200
                            {{ $msg->userVotes ? ($msg->userVotes->type === 'up' ? 'text-orange-600 dark:text-orange-400' : 'text-indigo-600 dark:text-indigo-400') : 'text-zinc-600 dark:text-zinc-400' }}">
                            {{ $msg->upvotes - $msg->downvotes }}
                        </span>

                        {{-- DOWNVOTE BUTTON --}}
                        <button wire:click="toggleVote({{ $msg->id }}, 'down')"
                            class="group relative p-1.5 rounded-lg transition-all duration-200 ease-[cubic-bezier(0.23,1,0.32,1)] active:scale-90
                            {{ $msg->userVote?->type === 'down' 
                                ? 'bg-indigo-100 text-indigo-600 ring-1 ring-indigo-200 dark:bg-indigo-500/20 dark:text-indigo-400 dark:ring-indigo-500/30' 
                                : 'text-zinc-400 hover:text-indigo-500 hover:bg-indigo-50 dark:hover:bg-indigo-500/10' 
                            }}">
                            <flux:icon icon="chevron-down" variant="mini" class="w-4 h-4 stroke-[2.5]" />
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="flex flex-col items-center justify-center py-16 text-center border-2 border-dashed border-zinc-200 dark:border-zinc-800 rounded-2xl bg-zinc-50/50 dark:bg-zinc-900/20">
                <div class="w-12 h-12 rounded-full bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center mb-4">
                    <flux:icon icon="chat-bubble-left-right" class="text-zinc-400" />
                </div>
                <h3 class="text-zinc-900 dark:text-white font-medium">No posts yet</h3>
                <p class="text-zinc-500 text-sm mt-1 max-w-xs">Be the first to share something with the community!</p>
                <flux:button wire:click="$set('showModal', true)" variant="primary" size="sm" class="mt-4">Create Post</flux:button>
            </div>
        @endforelse
    </div>

    {{-- ================= MODALS SECTION ================= --}}

    <flux:modal wire:model="showModal" class="w-full sm:w-[32rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ $editingMessageId ? 'Update Message' : 'New Post' }}</flux:heading>
                <flux:subheading>Share your thoughts with the {{ $box->box_name }} community.</flux:subheading>
            </div>
            @if ($errorMessages)
                <div class="p-3 rounded-lg bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 text-sm border border-red-200 dark:border-red-800 flex items-start gap-2">
                    <flux:icon icon="exclamation-circle" variant="mini" class="mt-0.5 shrink-0" />
                    {{ $errorMessages }}
                </div>
            @endif
            <flux:textarea wire:model="content" rows="6" placeholder="What's on your mind?" class="resize-none" />
            <div class="flex gap-3 justify-end pt-2">
                <flux:button wire:click="resetModal" variant="ghost">Cancel</flux:button>
                <flux:button wire:click="saveMessage" variant="primary">{{ $editingMessageId ? 'Save Changes' : 'Post' }}</flux:button>
            </div>
        </div>
    </flux:modal>

    <flux:modal wire:model="showCommunityModal" class="w-full sm:w-[32rem] min-h-[500px]">
        <div class="flex flex-col h-full space-y-4">
            <div>
                <flux:heading size="lg">Community Members</flux:heading>
                <flux:subheading>Manage access and view members.</flux:subheading>
            </div>

            <div class="flex border-b border-zinc-200 dark:border-zinc-700">
                <button wire:click="$set('communityTab', 'members')"
                    class="px-4 py-2 text-sm font-medium border-b-2 transition-colors {{ $communityTab === 'members' ? 'border-zinc-900 dark:border-white text-zinc-900 dark:text-white' : 'border-transparent text-zinc-500 hover:text-zinc-700 dark:hover:text-zinc-300' }}">
                    Members ({{ $this->membersList->count() }})
                </button>
                <button wire:click="$set('communityTab', 'requests')"
                    class="px-4 py-2 text-sm font-medium border-b-2 transition-colors flex items-center gap-2 {{ $communityTab === 'requests' ? 'border-zinc-900 dark:border-white text-zinc-900 dark:text-white' : 'border-transparent text-zinc-500 hover:text-zinc-700 dark:hover:text-zinc-300' }}">
                    Requests
                    @if ($this->pendingList->count() > 0)
                        <span class="bg-red-500 text-white text-[10px] px-1.5 py-0.5 rounded-full">{{ $this->pendingList->count() }}</span>
                    @endif
                </button>
            </div>

            <div class="flex-1 overflow-y-auto custom-scrollbar -mr-2 pr-2 max-h-[400px]">
                @if ($communityTab === 'members')
                    <div class="space-y-1">
                        @foreach ($this->membersList as $member)
                            <div class="flex items-center justify-between p-2 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 rounded-lg transition group">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center font-bold text-zinc-500 text-xs shrink-0">
                                        {{ strtoupper(substr($member->user->name, 0, 1)) }}
                                    </div>
                                    <div class="min-w-0">
                                        <div class="text-sm font-medium text-zinc-900 dark:text-zinc-200 truncate">{{ $member->user->name }}</div>
                                        <div class="text-[10px] text-zinc-400">Joined {{ $member->created_at->format('M d, Y') }}</div>
                                    </div>
                                </div>
                                {{-- FIX: Removed 'opacity-0' so this button is visible on mobile --}}
                                <flux:dropdown align="end">
                                    <flux:button icon="ellipsis-vertical" variant="ghost" size="sm" class="text-zinc-400" />
                                    <flux:menu>
                                        <flux:menu.item icon="no-symbol" variant="danger" wire:click="banMember({{ $member->user->id }})" wire:confirm="Ban this user?">Ban Member</flux:menu.item>
                                    </flux:menu>
                                </flux:dropdown>
                            </div>
                        @endforeach
                    </div>
                @endif

                @if ($communityTab === 'requests')
                    @if ($this->pendingList->count() === 0)
                        <div class="flex flex-col items-center justify-center h-40 text-zinc-400">
                            <flux:icon icon="inbox" variant="mini" class="mb-2 opacity-50" />
                            <span class="text-sm">No pending requests</span>
                        </div>
                    @else
                        <div class="space-y-2">
                            @foreach ($this->pendingList as $request)
                                <div class="flex items-center justify-between p-3 bg-zinc-50 dark:bg-zinc-800/30 border border-zinc-100 dark:border-zinc-800 rounded-lg">
                                    <div class="flex items-center gap-3 min-w-0">
                                        <div class="w-8 h-8 rounded-full bg-orange-100 dark:bg-orange-900/30 text-orange-600 dark:text-orange-400 flex items-center justify-center font-bold text-xs shrink-0">
                                            {{ strtoupper(substr($request->user->name, 0, 1)) }}
                                        </div>
                                        <div class="text-sm font-medium truncate">{{ $request->user->name }}</div>
                                    </div>
                                    <div class="flex gap-1 shrink-0">
                                        <flux:button size="sm" icon="check" wire:click="acceptRequest({{ $request->id }})" class="text-green-600 hover:bg-green-50" />
                                        <flux:button size="sm" icon="x-mark" wire:click="denyRequest({{ $request->id }})" class="text-red-600 hover:bg-red-50" />
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </flux:modal>

    <flux:modal wire:model="showEditBoxModal" class="w-full sm:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Settings</flux:heading>
                <flux:subheading>Update your box details.</flux:subheading>
            </div>
            <div class="space-y-4">
                <flux:input wire:model="edit_box_name" label="Name" />
                <flux:textarea wire:model="edit_box_description" label="Description" rows="3" />
                <flux:radio.group wire:model="edit_privacy" label="Privacy">
                    <flux:radio value="Public" label="Public" description="Anyone can join." />
                    <flux:radio value="Private" label="Private" description="Approval required." />
                </flux:radio.group>
            </div>
            <div class="flex gap-3 justify-end">
                <flux:button wire:click="$set('showEditBoxModal', false)" variant="ghost">Cancel</flux:button>
                <flux:button wire:click="updateBox" variant="primary">Save Changes</flux:button>
            </div>
        </div>
    </flux:modal>

    <flux:modal wire:model="showDeleteConfirmModal" class="w-full sm:w-96">
        <div class="text-center space-y-4 pt-2">
            <div class="mx-auto w-12 h-12 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center text-red-600">
                <flux:icon icon="trash" variant="mini" />
            </div>
            <div>
                <flux:heading size="lg">Delete Feedbox?</flux:heading>
                <p class="text-zinc-500 text-sm mt-2">This action is permanent and cannot be undone.</p>
            </div>
            <div class="flex flex-col gap-2 pt-2">
                <flux:button wire:click="deleteBox" variant="danger" class="w-full">Yes, Delete Everything</flux:button>
                <flux:button wire:click="$set('showDeleteConfirmModal', false)" variant="ghost" class="w-full">Cancel</flux:button>
            </div>
        </div>
    </flux:modal>

    <flux:modal wire:model="showLeaveConfirmModal" class="w-full sm:w-96">
        <div class="text-center space-y-4 pt-2">
            <div class="mx-auto w-12 h-12 rounded-full bg-orange-100 dark:bg-orange-900/30 flex items-center justify-center text-orange-600">
                <flux:icon icon="arrow-right-start-on-rectangle" variant="mini" />
            </div>
            <div>
                <flux:heading size="lg">Leave Community?</flux:heading>
                <p class="text-zinc-500 text-sm mt-2">You may need to request access to join again later.</p>
            </div>
            <div class="flex flex-col gap-2 pt-2">
                <flux:button wire:click="leaveBox" variant="danger" class="w-full">Confirm Leave</flux:button>
                <flux:button wire:click="$set('showLeaveConfirmModal', false)" variant="ghost" class="w-full">Cancel</flux:button>
            </div>
        </div>
    </flux:modal>

    <div class="fixed bottom-6 right-6 z-40" x-data="{ show: false }" x-init="window.addEventListener('scroll', () => { show = window.scrollY > 300 })" x-show="show"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4"
        style="display: none;">
        <button x-on:click="window.scrollTo({ top: 0, behavior: 'smooth' }); $wire.call('$refresh')"
            class="flex items-center justify-center w-12 h-12 bg-zinc-900 dark:bg-white text-white dark:text-zinc-900 rounded-full shadow-xl hover:scale-105 transition-transform">
            <flux:icon icon="arrow-up" variant="mini" />
        </button>
    </div>
</div>