<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RiskNexa</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100">

<div class="flex min-h-screen">

    @include('partials.sidebar')

    <div class="flex-1 flex flex-col">

        @include('partials.navbar')

        <main class="p-8">
            @yield('content')
        </main>

    </div>

</div>

</body>

</html>