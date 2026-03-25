<?php

use App\Models\Task;
use Livewire\Component;

new class extends Component
{
    public function toggleComplete(int $id)
    {
        $task = Auth::user()->tasks()->findOrFail($id);
        $task->update([
            'is_completed' => ! $task->is_completed,
        ]);
    }

    public function delete(Task $task)
    {
        $task->delete();

        session()->flash('success', 'Product deleted successfully.');
        $this->redirectRoute('tasks.index', navigate: true);
    }

    public function render()
    {
        return $this->view([
            'tasks' => Auth::user()->tasks()->latest()->get(),
        ]);
    }
};
