<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ $title ?? 'Laravel🌷' }}</title>
    <link rel="icon" href="{{ asset('title.jpeg') }}">

    @vite(['resources/css/app.css'])

    @livewireStyles
</head>
<body>
    {{ $slot }}

    @livewireScripts
</body>
</html>