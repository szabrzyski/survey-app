<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Survey app')</title>
    @vite(['resources/css/app.css'])
    @stack('css')
    @stack('head')
    @vite(['resources/js/app.js'])
    @stack('js')
</head>

<body>
    <main class="d-flex flex-column min-vh-100">
        <div class="container py-4">
            @includeWhen(session()->has('alert'), 'partials.alert', ['alert' => session('alert')])
            @yield('body')
        </div>
    </main>
</body>

</html>
