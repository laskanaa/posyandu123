<!DOCTYPE html>
<html>

<script src="{{ asset('js/bootstrap.js') }}"></script>

<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body style="margin:0; font-family: Arial; min-height:100vh; display:flex; flex-direction:column;">

    @include('components.header')

    <main style="flex:1; padding:20px;">
        @yield('content')
    </main>

    @include('components.footer')

</body>

</html>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>