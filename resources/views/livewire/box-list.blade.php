<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach ($boxes as $box)
        <div
            class="group relative bg-white dark:bg-zinc-900 rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 border border-zinc-200 dark:border-zinc-800 overflow-hidden hover:-translate-y-1">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-400 to-blue-600 border"></div>

            <div class="p-6 ">
                <h3
                    class="text-xl font-bold text-zinc-900 dark:text-white mb-1 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                    {{ $box->box_name }}
                </h3>
                <p class="text-sm text-zinc-500 dark:text-zinc-400">
                    By <span class="font-medium text-zinc-700 dark:text-zinc-300">{{ $box->user->name }}</span>
                </p>

                <div class="my-5 border-t border-zinc-100 dark:border-zinc-800"></div>

                <div class="flex justify-between items-center">
                    <div class="flex flex-col">
                        <span class="text-[10px] text-zinc-400 uppercase tracking-wider font-bold">Messages</span>
                        <span class="text-lg font-bold text-zinc-900 dark:text-white">12</span>
                    </div>

                </div>

                <div class="mt-6">
                    <flux:button href="{{ route('feedbox',$box->id) }}" class="w-full">
                        Open Box
                    </flux:button>
                </div>

            </div>


        </div>
    @endforeach


</div>
