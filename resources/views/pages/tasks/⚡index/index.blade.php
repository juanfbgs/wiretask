<div class="max-w-6xl mx-auto mt-10 p-6 bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Your Tasks</h2>
        <a href="{{ route('tasks.create') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-lg transition">
            + New Task
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-slate-100 dark:border-slate-800">
                    <th class="py-4 px-4 text-sm font-semibold text-slate-400 uppercase tracking-wider w-10">Done</th>
                    <th class="py-4 px-4 text-sm font-semibold text-slate-400 uppercase tracking-wider">Task</th>
                    <th class="py-4 px-4 text-sm font-semibold text-slate-400 uppercase tracking-wider">Priority</th>
                    <th class="py-4 px-4 text-sm font-semibold text-slate-400 uppercase tracking-wider text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                @foreach($tasks as $task)
                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition">
                    <td class="py-4 px-4">
                        <input type="checkbox" 
                            wire:click="toggleComplete({{ $task->id }})"
                            {{ $task->is_completed ? 'checked' : '' }}
                            class="w-5 h-5 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 dark:bg-slate-800 dark:border-slate-700">
                    </td>

                    <td class="py-4 px-4">
                        <div class="flex flex-col">
                            <span class="font-semibold {{ $task->is_completed ? 'line-through text-slate-400' : 'text-slate-900 dark:text-slate-200' }}">
                                {{ $task->title }}
                            </span>
                            @if($task->description)
                                <span class="text-xs text-slate-500 truncate max-w-xs">{{ $task->description }}</span>
                            @endif
                        </div>
                    </td>

                    <td class="py-4 px-4">
                        @php
                            $color = match($task->priority) {
                                'high' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',
                                'medium' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400',
                                'low' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400',
                            };
                        @endphp
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-bold uppercase {{ $color }}">
                            {{ $task->priority }}
                        </span>
                    </td>

                    <td class="py-4 px-4 text-right">
                        <div class="flex justify-end gap-3">
                            <a href="{{ route('tasks.update', $task->id) }}" class="text-slate-400 hover:text-indigo-600 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </a>
                            <button wire:click="delete({{ $task->id }})" wire:confirm="Are you sure?" class="text-slate-400 hover:text-red-600 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        @if($tasks->isEmpty())
            <div class="text-center py-12">
                <p class="text-slate-500 dark:text-slate-400">No tasks found. Start by creating one!</p>
            </div>
        @endif
    </div>
</div>