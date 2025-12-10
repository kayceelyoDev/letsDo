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

                @if (auth()->id() === $box->user->id)
                    <flux:dropdown align="end">
                  
                        <flux:button icon="user-plus" variant="ghost">
                            Requests
                            <span
                                class="ml-1 text-xs bg-zinc-200 dark:bg-zinc-700 px-1.5 py-0.5 rounded-full text-zinc-600 dark:text-zinc-300">
                                2 
                            </span>
                        </flux:button>

                  
                        <flux:menu class="w-80"> 

                         
                            <div
                                class="px-3 py-2 text-xs font-medium text-zinc-500 uppercase tracking-wider border-b border-zinc-100 dark:border-zinc-700">
                                Pending Approvals
                            </div>

                         
                            <div class="max-h-64 overflow-y-auto py-1 pr-1">

                               
                                <div
                                    class="flex items-center justify-between p-2 hover:bg-zinc-50 dark:hover:bg-zinc-800 rounded-lg transition group">
                                    <div class="flex items-center gap-2 min-w-0">
                                        <div
                                            class="w-8 h-8 rounded-full bg-zinc-100 dark:bg-zinc-700 flex items-center justify-center text-xs font-bold text-zinc-500 shrink-0">
                                            J 
                                        </div>
                                        <div class="truncate text-sm font-medium text-zinc-700 dark:text-zinc-200">
                                            Jon Snow
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-1">
                                        <button
                                            class="p-1.5 rounded-md text-zinc-400 hover:text-green-600 hover:bg-green-50 dark:hover:bg-green-900/20 transition"
                                            title="Approve">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m4.5 12.75 6 6 9-13.5" />
                                            </svg>
                                        </button>
                                        <button
                                            class="p-1.5 rounded-md text-zinc-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition"
                                            title="Deny">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18 18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                
                                @for ($i = 0; $i < 5; $i++)
                                    <div
                                        class="flex items-center justify-between p-2 hover:bg-zinc-50 dark:hover:bg-zinc-800 rounded-lg transition">
                                        <div class="flex items-center gap-2 min-w-0">
                                            <div
                                                class="w-8 h-8 rounded-full bg-zinc-100 dark:bg-zinc-700 flex items-center justify-center text-xs font-bold text-zinc-500 shrink-0">
                                                D
                                            </div>
                                            <div class="truncate text-sm font-medium text-zinc-700 dark:text-zinc-200">
                                                Demo User {{ $i }}
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <button
                                                class="p-1.5 rounded-md text-zinc-400 hover:text-green-600 hover:bg-green-50 dark:hover:bg-green-900/20 transition"><svg
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"
                                                    class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m4.5 12.75 6 6 9-13.5" />
                                                </svg></button>
                                            <button
                                                class="p-1.5 rounded-md text-zinc-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition"><svg
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"
                                                    class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 18 18 6M6 6l12 12" />
                                                </svg></button>
                                        </div>
                                    </div>
                                @endfor

                            </div>
                        </flux:menu>
                    </flux:dropdown>
                @endif

                <flux:button wire:click="$set('showModal', true)" variant="primary" icon="plus">
                    New Post
                </flux:button>

                @if (auth()->id() == $box->user->id || $box->privacy == 'Public')
                    <flux:button icon="share" variant="subtle"
                        onclick="navigator.clipboard.writeText(window.location.href); alert('Link copied!');" />
                @endif
            </div>
        </div>

        <div class="flex p-1 bg-zinc-100 dark:bg-zinc-800 rounded-lg w-full sm:w-fit">
            <button wire:click="setTab('latest')"
                class="flex-1 sm:flex-none px-4 py-1.5 text-sm font-medium rounded-md transition-all duration-200 text-center
                {{ $activeTab === 'latest' ? 'bg-white dark:bg-zinc-600 shadow-sm text-zinc-900 dark:text-white' : 'text-zinc-500 hover:text-zinc-700 dark:hover:text-zinc-300' }}">
                Latest
            </button>

            <button wire:click="setTab('top')"
                class="flex-1 sm:flex-none px-4 py-1.5 text-sm font-medium rounded-md transition-all duration-200 text-center
                {{ $activeTab === 'top' ? 'bg-white dark:bg-zinc-600 shadow-sm text-zinc-900 dark:text-white' : 'text-zinc-500 hover:text-zinc-700 dark:hover:text-zinc-300' }}">
                Top Rated
            </button>
        </div>
    </div>

    <div class="space-y-5">
        <div class="space-y-5">
            @foreach ($userMessages as $msg)
                <div
                    class="p-5 bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl shadow-sm hover:border-zinc-300 dark:hover:border-zinc-700 transition duration-200 space-y-4">
                    <div class="flex justify-between items-start gap-3">
                        <div class="flex gap-3 min-w-0">
                            <div
                                class="w-10 h-10 rounded-full bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center font-bold text-zinc-600 dark:text-zinc-400 text-sm shrink-0">
                                {{ strtoupper(substr($msg->user?->name ?? 'A', 0, 1)) }}
                            </div>
                            <div>
                                <div class="font-semibold text-sm text-zinc-900 dark:text-white truncate">
                                    {{ $msg->user->name ?? 'Anon' }}
                                </div>
                                <div class="text-xs text-zinc-500">
                                    {{ $msg->readable_date }}
                                </div>
                            </div>
                        </div>


                        @if (auth()->id() === $msg->user_id)
                            <flux:dropdown align="end">
                                <flux:button icon="ellipsis-horizontal" variant="ghost" size="sm" class="-mr-2" />

                                <flux:menu>
                                    <flux:menu.item icon="pencil-square" wire:click="editMessage({{ $msg->id }})">
                                        Update Message
                                    </flux:menu.item>

                                    <flux:menu.item icon="trash" variant="danger"
                                        wire:click="deleteMessage({{ $msg->id }})">
                                        Delete Message
                                    </flux:menu.item>
                                </flux:menu>
                            </flux:dropdown>
                        @endif


                    </div>

                    <div class="text-zinc-700 dark:text-zinc-300 leading-relaxed text-[15px]">
                        {{ $msg['content'] }}
                    </div>

                    <div class="h-px bg-zinc-100 dark:bg-zinc-800/50"></div>

                    <div class="flex items-center gap-1 bg-zinc-50 dark:bg-zinc-800/50 rounded-lg p-1">

                        {{-- UPVOTE BUTTON --}}
                        <button wire:click="toggleVote({{ $msg->id }}, 'up')"
                            class="p-1 rounded transition shadow-sm
        {{ $msg->userVote?->type === 'up'
            ? 'bg-orange-100 text-orange-600 dark:bg-orange-900/30 dark:text-orange-400'
            : 'hover:bg-white dark:hover:bg-zinc-700 text-zinc-400 hover:text-orange-500' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                            </svg>
                        </button>

                        {{-- SCORE --}}
                        <span
                            class="font-bold text-sm min-w-[24px] text-center 
        {{ $msg->userVote ? ($msg->userVote->type === 'up' ? 'text-orange-600' : 'text-indigo-600') : 'text-zinc-700 dark:text-zinc-300' }}">
                            {{ $msg->upvotes - $msg->downvotes }}
                        </span>

                        {{-- DOWNVOTE BUTTON --}}
                        <button wire:click="toggleVote({{ $msg->id }}, 'down')"
                            class="p-1 rounded transition shadow-sm
        {{ $msg->userVote?->type === 'down'
            ? 'bg-indigo-100 text-indigo-600 dark:bg-indigo-900/30 dark:text-indigo-400'
            : 'hover:bg-white dark:hover:bg-zinc-700 text-zinc-400 hover:text-indigo-500' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>

                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <flux:modal wire:model="showModal" class="md:w-96">
        <div class="space-y-6">
            <div>
                {{-- Dynamic Heading --}}
                <flux:heading size="lg">
                    {{ $editingMessageId ? 'Update Message' : 'Create a Message' }}
                </flux:heading>
                <flux:subheading>
                    {{ $editingMessageId ? 'Fixing a typo?' : 'Any exciting thoughts?' }}
                </flux:subheading>
            </div>

            {{-- Error Message Display (Keep your existing code here) --}}
            @if ($errorMessages)
                <div
                    class="p-4 rounded-lg bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 text-sm border border-red-200 dark:border-red-800">
                    {{-- ... keep your existing error icon/text ... --}}
                    {{ $errorMessages }}
                </div>
            @endif

            <flux:textarea wire:model="content" rows="4" placeholder="Share something..." />

            <div class="flex gap-2">
                {{-- Call saveMessage instead of createMessage --}}
                <flux:button wire:click="saveMessage" variant="primary" class="w-full">
                    {{ $editingMessageId ? 'Save Changes' : 'Post Message' }}
                </flux:button>

                {{-- Call resetModal to clear data when cancelling --}}
                <flux:button wire:click="resetModal" variant="ghost" class="w-full">
                    Cancel
                </flux:button>
            </div>
        </div>
    </flux:modal>

    <div class="fixed bottom-6 right-6 z-50" x-data="{ show: false }" x-init="window.addEventListener('scroll', () => { show = window.scrollY > 100 })" x-show="show"
        x-transition.opacity.duration.300ms>
        <button x-on:click="window.scrollTo({ top: 0, behavior: 'smooth' })" wire:click="$refresh"
            class="flex items-center gap-2 px-4 py-3 bg-zinc-900 dark:bg-white text-white dark:text-zinc-900 rounded-full shadow-xl hover:scale-105 active:scale-95 transition-all duration-200 font-medium text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
            </svg>
            Refresh
        </button>
    </div>
</div>
