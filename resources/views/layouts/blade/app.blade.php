<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Information -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', config('app.name'))</title>

    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600' rel='stylesheet' type='text/css'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css' rel='stylesheet' type='text/css'>

    <!-- CSS -->
    <link href="{{ Edukcate::usesRightToLeftTheme() ? 'css/app-rtl.css' : 'css/app.css' }}" rel="stylesheet">

    <!-- Scripts -->
    @yield('scripts', '')

    <!-- Global Edukcate Object -->
    <script>
        window.Edukcate = <?php echo json_encode(array_merge(
            Edukcate::scriptVariables(), []
        )); ?>;
    </script>
</head>
<body class="with-navbar">
    <div>
        <!-- Navigation -->
        @if (Auth::check())
            @include('edukcate::nav.blade.user')
        @else
            @include('edukcate::nav.guest')
        @endif

        <!-- Main Content -->
        <main class="py-4">
            @yield('content')
        </main>

        <!-- JavaScript -->
        <script src="/js/app.js"></script>
    </div>
</body>
</html>
