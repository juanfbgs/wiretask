<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ __('Welcome') }} - {{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#FDFDFC] dark:bg-slate-950 text-[#1b1b18] flex p-6 lg:p-8 items-center min-h-screen flex-col">
    <header class="w-full lg:max-w-4xl max-w-83.75 text-sm mb-6 not-has-[nav]:hidden">
        @if (Route::has('login'))
            <nav class="flex items-center justify-end gap-4">
                @auth
                    <a href="{{ route('tasks.index') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                        Tasks
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>
    <div
        class="flex grow items-center justify-center w-full transition-opacity opacity-100 duration-750 bg-white dark:bg-slate-950 px-6">
        <main class="flex max-w-4xl w-full flex-col items-center text-center">

            <h1
                class="mb-2 text-4xl font-black tracking-tighter uppercase text-indigo-600 dark:text-indigo-500 sm:text-7xl">
                Wiretask
            </h1>

            <h2 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white sm:text-4xl">
                Organize your work <span class="text-indigo-500 dark:text-indigo-400">all in one place.</span>
            </h2>

            <p class="mt-4 text-lg leading-8 text-slate-600 dark:text-slate-300 max-w-2xl">
                A simple task manager built with <span class="font-bold">Laravel 13</span> and <span class="font-bold">Livewire 4</span>.
                Create tasks, set priorities, and track your progress.
            </p>

        </main>
    </div>
    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif
</body>

</html>