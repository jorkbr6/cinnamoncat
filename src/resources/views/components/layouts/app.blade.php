<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Cinnamon Cat' }}</title>
    <link rel="icon" href="{{ asset('title.jpeg') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>
<body class="min-h-screen bg-[radial-gradient(circle_at_top,_#fff6f7,_#fff)] text-slate-700">
    <div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
        <header class="mb-8 flex flex-wrap items-center justify-between gap-4 rounded-full border border-rose-200 bg-white/70 px-5 py-4 shadow-sm backdrop-blur">
            <a href="{{ route('home') }}" class="text-lg font-semibold tracking-wide text-rose-700">Cinnamon Cat</a>
            <nav class="flex flex-wrap items-center gap-3 text-sm font-medium text-slate-600">
                <a href="{{ route('questions.index') }}" class="rounded-full px-3 py-2 transition hover:bg-rose-100 hover:text-rose-700">Questions</a>
                <a href="{{ route('cinnamon.index') }}" class="rounded-full px-3 py-2 transition hover:bg-rose-100 hover:text-rose-700">Cinnamon</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="rounded-full bg-rose-500 px-4 py-2 text-white shadow-sm transition hover:bg-rose-600">Logout</button>
                </form>
            </nav>
        </header>

        @if(session('success'))
            <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        {{ $slot }}
    </div>

    @livewireScripts
</body>
</html>