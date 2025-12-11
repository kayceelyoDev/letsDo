<div class="max-w-5xl mx-auto py-12 px-4 sm:px-6">
    
    {{-- Page Title --}}
    <div class="mb-8">
        <flux:heading size="xl" level="1">Account Settings</flux:heading>
    </div>

    {{-- The Unified Card --}}
    <div class="flex flex-col md:flex-row bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-200 dark:border-zinc-800 shadow-sm overflow-hidden min-h-[600px]">
        
        {{-- LEFT: Navigation Panel --}}
        <aside class="w-full md:w-72 bg-zinc-50/80 dark:bg-zinc-950/50 border-b md:border-b-0 md:border-r border-zinc-200 dark:border-zinc-800 p-4 md:py-6 md:px-4 shrink-0">
            <div class="md:sticky md:top-6">
                <div class="px-2 mb-2 text-xs font-semibold text-zinc-400 uppercase tracking-wider">
                    General
                </div>
                
                <flux:navlist>
                    <flux:navlist.item icon="user" :href="route('profile.edit')" :current="request()->routeIs('profile.edit')" wire:navigate>
                        {{ __('My Profile') }}
                    </flux:navlist.item>
                    
                    <flux:navlist.item icon="paint-brush" :href="route('appearance.edit')" :current="request()->routeIs('appearance.edit')" wire:navigate>
                        {{ __('Appearance') }}
                    </flux:navlist.item>
                </flux:navlist>

                <flux:separator class="my-4 opacity-50" />

                <div class="px-2 mb-2 text-xs font-semibold text-zinc-400 uppercase tracking-wider">
                    Security
                </div>

                <flux:navlist>
                    <flux:navlist.item icon="key" :href="route('user-password.edit')" :current="request()->routeIs('user-password.edit')" wire:navigate>
                        {{ __('Password') }}
                    </flux:navlist.item>
                    
                    @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                        <flux:navlist.item icon="shield-check" :href="route('two-factor.show')" :current="request()->routeIs('two-factor.show')" wire:navigate>
                            {{ __('Two-Factor Auth') }}
                        </flux:navlist.item>
                    @endif
                </flux:navlist>
            </div>
        </aside>

        {{-- RIGHT: Content Area --}}
        <main class="flex-1 p-6 md:p-10 lg:p-12 bg-white dark:bg-zinc-900">
            <div class="max-w-xl">
                {{-- Dynamic Form Heading --}}
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-zinc-900 dark:text-white">
                        {{ $heading ?? 'Settings' }}
                    </h2>
                    @if($subheading ?? false)
                        <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                            {{ $subheading }}
                        </p>
                    @endif
                </div>

                {{-- The Form Slot --}}
                <div>
                    {{ $slot }}
                </div>
            </div>
        </main>

    </div>
</div>