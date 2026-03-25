<?php

use App\Livewire\Forms\TaskForm;
use App\Models\Task;
use Livewire\Component;

new class extends Component
{
    public TaskForm $form;
 
    public function mount(Task $task)
    {
        
        if ($task->exists) {
            $this->form->setTask($task);
        }
    }
 
    public function save()
    {
        $this->form->update();
 
        session()->flash('success', 'Task updated successfully.');
        $this->redirectRoute('tasks.index', navigate: true);
    }
};