<?php

namespace App\Livewire\Forms;

use App\Models\Task;
use Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TaskForm extends Form
{
    public ?Task $task;

    #[Validate('required|min:3|max:255')]
    public string $title = '';

    #[Validate('nullable|string')]
    public string $description = '';

    #[Validate('boolean')]
    public bool $is_completed = false;

    #[Validate('required|in:low,medium,high')]
    public string $priority = 'medium';

    public function setTask(Task $task)
    {
        $this->task = $task;
 
        $this->title = $task->title;
 
        $this->description = $task->description;

        $this->is_completed = $task->is_completed;

        $this->priority = $task->priority;
    }

    public function store()
    {
        $this->validate();
 
        Auth::user()->tasks()->create($this->all());
        $this->reset();
    }

    public function update()
    {
        $this->validate();
 
        $this->task->update($this->all());
    }
}
