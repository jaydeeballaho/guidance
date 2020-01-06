<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Guidance | @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('_assets/css/bootstrap.min.css') }}">
    <script src="{{ asset('_assets/js/jquery-3.3.1.slim.min.js') }}"></script>
</head>
<body>
    <header>
        @include('student.extends.navbar')
    </header>
    <main>
        @yield('contents')
    </main>

    <script src="{{ asset('_assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('_assets/js/bootstrap.min.js') }}"></script>
    @yield('scripts')
</body>
</html>