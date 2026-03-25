<?php

use App\Livewire\Forms\TaskForm;
use Livewire\Component;

new class extends Component
{
    public TaskForm $form;

    public function save()
    {
        $this->form->store();

        session()->flash('status', 'Task successfully created.');
        $this->redirectRoute('tasks.index', navigate: true);
    }

};