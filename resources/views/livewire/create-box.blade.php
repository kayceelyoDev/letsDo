<div>
    <flux:modal.trigger name="create-box-modal">
        <flux:button variant="primary" icon="plus" class="w-full md:w-auto shadow-lg shadow-blue-500/20">
            Create New Box
        </flux:button>
    </flux:modal.trigger>

    <flux:modal name="create-box-modal" class="md:w-96">
        <form wire:submit="createbox" class="space-y-6">
            
            <div>
                <flux:heading size="lg">Create a New Box</flux:heading>
                <flux:subheading>Start collecting anonymous feedback.</flux:subheading>
            </div>

            <flux:input 
                wire:model="box_name" 
                label="Box Name" 
                placeholder="e.g. Marketing Team Feedback" 
                icon="archive-box"
                required
            />

            <flux:textarea 
                wire:model="box_description" 
                label="Description" 
                placeholder="What is this box for?" 
                rows="3"
                resize="none"
            />

            <flux:radio.group wire:model="privacy" label="Privacy Setting">
                
                <div class="flex items-start p-3 border rounded-lg hover:bg-gray-50 dark:hover:bg-zinc-800 transition cursor-pointer border-gray-200 dark:border-zinc-700">
                    <flux:radio value="Public" />
                    <div class="ml-3">
                        <span class="block text-sm font-medium text-gray-900 dark:text-white">Public</span>
                        <span class="block text-xs text-gray-500 dark:text-zinc-400">Anyone with the link can send messages.</span>
                    </div>
                </div>

                <div class="mt-2 flex items-start p-3 border rounded-lg hover:bg-gray-50 dark:hover:bg-zinc-800 transition cursor-pointer border-gray-200 dark:border-zinc-700">
                    <flux:radio value="Private" />
                    <div class="ml-3">
                        <span class="block text-sm font-medium text-gray-900 dark:text-white">Private</span>
                        <span class="block text-xs text-gray-500 dark:text-zinc-400">Only people you explicitly invite.</span>
                    </div>
                </div>

            </flux:radio.group>

            <div class="flex justify-end gap-2 pt-2">
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
                
                <flux:button type="submit" variant="primary">Create Box</flux:button>
            </div>

        </form>
    </flux:modal>
</div>