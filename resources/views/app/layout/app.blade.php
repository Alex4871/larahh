<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'Электронная ярмарка вакансий')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>

{{-- Navbar --}}
@include('app.layout.navbar')

<main class="container">

    {{-- Main (logo + search) --}}
    @include('app.layout.logo')

    {{-- Vacancies list --}}
    @yield('content')

</main>


{{-- footer --}}
@include('app.layout.footer')

<script src="{{asset('bootstrap/bootstrap.bundle.min.js')}}"></script>
@stack('scripts')

</body>
</html>
