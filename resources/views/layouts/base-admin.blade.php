<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/tables.css">
    <link rel="stylesheet" href="../css/color.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/media.css">
    <link rel="stylesheet" href="../css/air-datepicker.css">
    <title>@yield('page.title', config('app.name'))</title>
    @stack('css')
</head>

<body>
    <div class="d-flex flex-column justify-content-between min-vh-100">
        @include('includes.alert')
        @include('includes.header-admin')
        <main class="flex-grow-1 py-3">
            @yield('content')
        </main>
        @include('includes.footer')
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <script src="http://localhost/laravel/katyabach/public/js/jquery-3.7.0.js"></script>
    <script src="http://localhost/laravel/katyabach/public/js/dropDown.js"></script>
    <script src="http://localhost/laravel/katyabach/public/js/calculator.js"></script>
    <script src="http://localhost/laravel/katyabach/public/js/examination.js"></script>
    <script src="http://localhost/laravel/katyabach/public/js/time.js"></script>
    <script src="http://localhost/laravel/katyabach/public/js/air-datepicker.js"></script>
    <script>
        new AirDatepicker('#calendar', {
            inline: true
        });
    </script>
    <script>
        jQuery(document).ready(function() {
            jQuery('.jQuery_button').click (function() {
                jQuery('.JQuery_button').css("color", "#808080")
                jQuery('.jQuery_appear').css("font-size", "24px").css("border", "1px white solid").show();
            });
        });
    </script>
    @stack('js')
</body>

</html>
