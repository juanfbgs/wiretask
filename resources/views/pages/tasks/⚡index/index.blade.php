<div class="max-w-6xl mx-auto mt-10 p-6 bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800">
    
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Your Tasks</h2>
            <p class="text-sm text-slate-500 dark:text-slate-400">Manage and track your work.</p>
        </div>
        <a href="{{ route('tasks.create') }}" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl shadow-sm transition-all active:scale-95">
            + New Task
        </a>
    </div>

    <div class="overflow-hidden border border-slate-100 dark:border-slate-800 rounded-xl">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/50 dark:bg-slate-800/50">
                    <th class="py-4 px-6 text-xs font-bold text-slate-400 uppercase tracking-widest w-16 text-center">Done</th>
                    <th class="py-4 px-4 text-xs font-bold text-slate-400 uppercase tracking-widest">Task Detail</th>
                    <th class="py-4 px-4 text-xs font-bold text-slate-400 uppercase tracking-widest">Priority</th>
                    <th class="py-4 px-6 text-xs font-bold text-slate-400 uppercase tracking-widest text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @foreach($tasks as $task)
                <tr class="group hover:bg-slate-50/80 dark:hover:bg-slate-800/30 transition-colors">
                    <td class="py-4 px-6 text-center">
                        <input type="checkbox" 
                            wire:click="toggleComplete({{ $task->id }})"
                            {{ $task->is_completed ? 'checked' : '' }}
                            class="w-5 h-5 rounded-md border-slate-300 text-indigo-600 focus:ring-indigo-500 dark:bg-slate-800 dark:border-slate-700 cursor-pointer">
                    </td>

                    <td class="py-4 px-4">
                        <div class="flex flex-col">
                            <span class="font-semibold transition-all {{ $task->is_completed ? 'line-through text-slate-400 opacity-60' : 'text-slate-900 dark:text-slate-200' }}">
                                {{ $task->title }}
                            </span>
                            @if($task->description)
                                <span class="text-xs text-slate-500 dark:text-slate-400 mt-0.5 line-clamp-1 max-w-sm">
                                    {{ $task->description }}
                                </span>
                            @endif
                        </div>
                    </td>

                    <td class="py-4 px-4">
                        @php
                            $priorityStyle = match($task->priority) {
                                'high' => 'bg-red-50 text-red-700 dark:bg-red-900/20 dark:text-red-400',
                                'medium' => 'bg-amber-50 text-amber-700 dark:bg-amber-900/20 dark:text-amber-400',
                                'low' => 'bg-emerald-50 text-emerald-700 dark:bg-emerald-900/20 dark:text-emerald-400',
                                default => 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400'
                            };
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider {{ $priorityStyle }}">
                            {{ $task->priority }}
                        </span>
                    </td>

                    <td class="py-4 px-6 text-right">
                        <div class="flex justify-end items-center gap-1.5">
                            <a href="{{ route('tasks.update', $task->id) }}" 
                               class="p-2 text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 rounded-lg transition"
                               title="Edit Task">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </a>

                            <div x-data="{ showDeleteModal: false }" class="inline-block">
                                <button @click="showDeleteModal = true" 
                                        class="p-2 text-slate-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition"
                                        title="Delete Task">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                             
                                <div x-show="showDeleteModal" 
                                     x-transition.opacity 
                                     class="fixed inset-0 z-[100] flex items-center justify-center bg-slate-900/60 backdrop-blur-sm p-4" 
                                     style="display: none;">
                                    
                                    <div @click.away="showDeleteModal = false" 
                                         class="w-full max-w-sm bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-2xl border border-slate-200 dark:border-slate-700 text-left">
                                        
                                        <h3 class="text-xl font-bold text-slate-900 dark:text-white">Delete Task?</h3>
                                        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400 leading-relaxed">
                                            Are you sure you want to permanently delete <span class="font-bold text-slate-700 dark:text-slate-200">"{{ $task->title }}"</span>? This action cannot be undone.
                                        </p>
                             
                                        <div class="mt-6 flex flex-col-reverse sm:flex-row gap-3">
                                            <button @click="showDeleteModal = false" class="flex-1 px-4 py-2 text-sm font-semibold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-xl transition">
                                                Cancel
                                            </button>
                                            <button wire:click="delete({{ $task->id }})" @click="showDeleteModal = false" class="flex-1 px-4 py-2 text-sm font-bold text-white bg-red-600 hover:bg-red-700 rounded-xl shadow-sm transition">
                                                Yes, Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        @if($tasks->isEmpty())
            <div class="flex flex-col items-center justify-center py-20 text-center">
                <div class="w-16 h-16 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center mb-4">
                    <svg class="h-8 w-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white">No tasks found!</h3>
            </div>
        @endif
    </div>
</div>