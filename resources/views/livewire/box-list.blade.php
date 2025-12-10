<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach ($boxes as $box)
        <div class="group relative flex flex-col h-full bg-white dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-800 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 overflow-hidden">
            
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-400 to-blue-600"></div>

            <div class="p-6 flex flex-col flex-1">
                <div class="mb-4">
                    <h3 class="text-lg font-bold text-zinc-900 dark:text-white leading-tight group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                        {{ $box->box_name }}
                    </h3>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">
                        By <span class="font-medium text-zinc-700 dark:text-zinc-300">{{ $box->user->name }}</span>
                    </p>
                </div>

                <p class="text-sm text-zinc-600 dark:text-zinc-300 leading-relaxed mb-6 line-clamp-3">
                    {{ $box->box_description }}
                </p>

                <div class="mt-auto pt-6 border-t border-zinc-100 dark:border-zinc-800">
                    <div class="flex justify-between items-end gap-4">
                        
                        <div class="flex flex-col">
                            <span class="text-[10px] font-semibold text-zinc-400 uppercase tracking-wider">
                                Messages
                            </span>
                            <span class="text-xl font-bold text-zinc-900 dark:text-white leading-none mt-1">
                                12
                            </span>
                        </div>

                        <div class="flex-1">
                            <flux:button href="{{ route('feedbox', $box->id) }}" class="w-full justify-center">
                                Open Box
                            </flux:button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>