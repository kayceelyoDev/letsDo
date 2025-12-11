<div class="max-w-md mx-auto py-20 px-6 text-center space-y-6" wire:poll.3s>
    
    {{-- SCENARIO 0: BOX UNAVAILABLE (Archived/Deleted) --}}
    @if($box->status !== 'available') 
        <div class="w-20 h-20 bg-zinc-100 dark:bg-zinc-800 rounded-full flex items-center justify-center mx-auto mb-4 grayscale opacity-50">
            <flux:icon icon="archive-box-x-mark" variant="solid" class="w-10 h-10 text-zinc-500" />
        </div>

        <div class="space-y-2">
            <flux:heading size="xl" class="text-zinc-500">Box Unavailable</flux:heading>
            <p class="text-zinc-500">
                This Feedbox is currently unavailable or has been archived by the owner.
            </p>
        </div>

        <div class="pt-4">
            <flux:button href="/dashboard" variant="ghost" class="w-full">
                Return to Dashboard
            </flux:button>
        </div>

    {{-- SCENARIO 1: BANNED USER --}}
    @elseif($membershipStatus === 'banned')
        <div class="w-20 h-20 bg-red-50 dark:bg-red-900/20 rounded-full flex items-center justify-center mx-auto mb-4 border-2 border-red-100 dark:border-red-900/30">
            <flux:icon icon="hand-raised" variant="solid" class="w-10 h-10 text-red-600" />
        </div>

        <div class="space-y-2">
            <flux:heading size="xl" class="text-red-600 dark:text-red-500">Access Revoked</flux:heading>
            <p class="text-zinc-500">
                You have been banned from <strong>{{ $box->box_name }}</strong>.
                <br>Contact the owner if you believe this is a mistake.
            </p>
        </div>

        <div class="pt-4">
            <flux:button href="/dashboard" variant="subtle" class="w-full text-red-500 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/10">
                Return to Dashboard
            </flux:button>
        </div>

    {{-- SCENARIO 2: REJECTED REQUEST --}}
    @elseif($membershipStatus === 'rejected')
        <div class="w-20 h-20 bg-red-50 dark:bg-red-900/20 rounded-full flex items-center justify-center mx-auto mb-4">
            <flux:icon icon="x-circle" variant="solid" class="w-10 h-10 text-red-500" />
        </div>

        <div class="space-y-2">
            <flux:heading size="xl" class="text-red-600 dark:text-red-400">Request Declined</flux:heading>
            <p class="text-zinc-500">
                Your request to join <strong>{{ $box->box_name }}</strong> was declined by the owner.
            </p>
        </div>

        <div class="pt-4">
            <flux:button href="/dashboard" variant="primary" class="w-full">
                Return to Dashboard
            </flux:button>
        </div>

    {{-- SCENARIO 3: PENDING (Waiting for approval) --}}
    @elseif($membershipStatus === 'pending')
        <div class="w-20 h-20 bg-orange-50 dark:bg-orange-900/20 rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse">
            <flux:icon icon="clock" variant="solid" class="w-10 h-10 text-orange-500" />
        </div>

        <div class="space-y-2">
            <flux:heading size="xl">Request Sent</flux:heading>
            <p class="text-zinc-500">
                Waiting for <strong>{{ $box->user->name }}</strong> to approve your request.
                <br>This page will update automatically.
            </p>
        </div>

        <div class="pt-4">
            <flux:button href="/dashboard" variant="ghost" class="w-full">
                Go Back Dashboard
            </flux:button>
        </div>

    {{-- SCENARIO 4: PUBLIC BOX (New User) --}}
    @elseif($box->privacy === 'Public')
        <div class="w-20 h-20 bg-blue-50 dark:bg-blue-900/20 rounded-full flex items-center justify-center mx-auto mb-4">
            <flux:icon icon="globe-alt" variant="solid" class="w-10 h-10 text-blue-500" />
        </div>

        <div class="space-y-2">
            <flux:heading size="xl">Welcome to {{ $box->box_name }}</flux:heading>
            <p class="text-zinc-500">
                This is a public community created by <strong>{{ $box->user->name }}</strong>. 
                <br>Join now to start posting!
            </p>
        </div>

        <div class="pt-4 space-y-3">
            <flux:button wire:click="joinBox" variant="primary" class="w-full">
                Join Room
            </flux:button>
            <flux:button href="/dashboard" variant="ghost" class="w-full">
                Go Back Dashboard
            </flux:button>
        </div>

    {{-- SCENARIO 5: PRIVATE BOX (New User) --}}
    @else
        <div class="w-20 h-20 bg-zinc-100 dark:bg-zinc-800 rounded-full flex items-center justify-center mx-auto mb-4">
            <flux:icon icon="lock-closed" variant="solid" class="w-10 h-10 text-zinc-400" />
        </div>

        <div class="space-y-2">
            <flux:heading size="xl">This Box is Private</flux:heading>
            <p class="text-zinc-500">
                You need permission from <strong>{{ $box->user->name }}</strong> to view 
                <span class="font-semibold text-zinc-900 dark:text-white">"{{ $box->box_name }}"</span>.
            </p>
        </div>

        <div class="pt-4 space-y-3">
            <flux:button wire:click="joinBox" variant="primary" class="w-full">
                Request to Join
            </flux:button>
            <flux:button href="/dashboard" variant="ghost" class="w-full">
                Go Back Dashboard
            </flux:button>
        </div>
    @endif

</div>