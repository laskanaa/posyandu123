<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        main {
            flex: 1;
            padding: 0;
            margin: 0;
            width: 100%;
        }
    </style>
</head>

<body>

    {{-- HEADER --}}
    @if (!View::hasSection('hideHeader'))
        @include('components.header')
    @endif

    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    @if (!View::hasSection('hideFooter'))
        @include('components.footer')
    @endif

</body>

</html>