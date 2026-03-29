<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::livewire('/tasks', 'pages::tasks.index')->name('tasks.index');
    Route::livewire('/tasks/create', 'pages::tasks.create')->name('tasks.create');
    Route::livewire('/tasks/{task}/update', 'pages::tasks.update')->name('tasks.update');
});

require __DIR__.'/settings.php';
