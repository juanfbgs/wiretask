<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    // tasks
    Route::livewire('/tasks', 'pages::tasks.index')->name('tasks.index');
    Route::livewire('/tasks/create', 'pages::tasks.create')->name('tasks.create');
    Route::livewire('/tasks/update', 'pages::tasks.update')->name('tasks.update');
    Route::livewire('/tasks/delete', 'pages::tasks.delete')->name('tasks.delete');
});

require __DIR__.'/settings.php';
