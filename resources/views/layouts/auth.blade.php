<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact CRM</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="flex">
        <div class="w-4/12 h-screen bg-purple-700">
            @yield('section')
        </div>
        <main class="w-8/12 h-screen">
            @yield('auth')
        </main>
    </div>
    <script src="{{ asset('js/alpine.min.js')}}" defer></script>
</body>
</html>