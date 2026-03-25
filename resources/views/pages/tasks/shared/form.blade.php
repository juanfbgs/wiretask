<div class="max-w-2xl mx-auto mt-4 p-8 bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800">
    <header class="mb-8">
        <h3 class="text-2xl font-bold text-slate-900 dark:text-white">Create New Task</h3>
        <p class="text-slate-500 dark:text-slate-400 text-sm">Add a new item to your workflow.</p>
    </header>

    <form wire:submit="save" class="space-y-6">
        
        <div>
            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Title</label>
            <input type="text" wire:model="form.title" placeholder="e.g. Finish Laravel Project"
                class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition">
            @error('form.title') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Description</label>
            <textarea wire:model="form.description" rows="4" placeholder="Optional details..."
                class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition"></textarea>
            @error('form.description') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>

        <div class="flex flex-col md:flex-row gap-6">
            <div class="flex-1">
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Priority</label>
                <select wire:model="form.priority" 
                    class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition">
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>

            <div class="flex-1 flex items-end pb-2">
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" wire:model="form.is_completed" class="sr-only peer">
                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 dark:peer-focus:ring-indigo-800 rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5fter:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-indigo-600"></div>
                    <span class="ml-3 text-sm font-semibold text-slate-700 dark:text-slate-300">Mark as Completed</span>
                </label>
            </div>
        </div>

        <div class="flex justify-end items-center gap-4 pt-4 border-t border-slate-100 dark:border-slate-800">
            <a href="{{ route('tasks.index') }}" class="text-sm font-medium text-slate-600 dark:text-slate-400 hover:underline">Cancel</a>
            <button type="submit" 
            class="px-6 py-2.5 cursor-pointer bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-indigo-200 dark:shadow-none transition transform active:scale-95">
                {{ (isset($form->task) && $form->task->exists) ? 'Update Task' : 'Create Task' }}
            </button>
        </div>
    </form>
</div>