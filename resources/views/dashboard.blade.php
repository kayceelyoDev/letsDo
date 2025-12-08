<x-layouts.app :title="__('Dashboard')">
    <div class="min-h-screen py-12 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">

                <div class="w-full md:w-1/2 flex gap-2">
                    <flux:input 
                        icon="magnifying-glass" 
                        placeholder="Enter box link or code..." 
                        class="flex-1" 
                    />
                    <flux:button>Join</flux:button>
                </div>

                <div class="w-full md:w-auto">
                    <livewire:create-box />
                </div>
            </div>

            <div class="flex items-center mb-6 px-1">
                <flux:heading size="lg" level="2">Your Joined Boxes</flux:heading>
                <flux:badge color="zinc" size="sm" class="ml-3">3</flux:badge>
            </div>

            <livewire:box-list/>
        </div>
    </div>
</x-layouts.app>