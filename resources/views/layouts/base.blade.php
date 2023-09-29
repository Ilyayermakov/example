<!DOCTYPE html>
<html lang="en>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/color.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/posts.css">
    <link rel="stylesheet" href="./css/media.css">
    <link rel="stylesheet" href="./air-datepicker.css">
    <title>@yield('page.title', config('app.name'))</title>
    @stack('css')
</head>

<body>
    <div class="d-flex flex-column justify-content-between min-vh-100">
        @include('includes.alert')
        @include('includes.header')
        <main class="flex-grow-1 py-3">
            @yield('content')
        </main>
        @include('includes.footer')
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <script src="./js/jquery-3.7.0.js"></script>
    <script src="./js/dropDown.js"></script>
    <script src="./js/slides.js"></script>
    <script src="./js/examination.js"></script>
    <script src="./js/time.js"></script>
    <script src="./js/air-datepicker.js"></script>
    <script>
        new AirDatepicker('#calendar', {
            inline: true
        });
    </script>
    @stack('js')
</body>

</html>
