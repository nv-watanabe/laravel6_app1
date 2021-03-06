<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

    <link href='{{ asset('css/fullcalendar/core/main.css') }}' type="text/css" rel='stylesheet' />
    <link href='{{ asset('css/fullcalendar/daygrid/main.css') }}' type="text/css" rel='stylesheet' />

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script src='{{ asset('js/fullcalendar/core/main.js') }}'></script>
    <script src='{{ asset('js/fullcalendar/daygrid/main.js') }}'></script>
    <script src='{{ asset('js/fullcalendar/interaction/main.js') }}'></script>

    <script src='{{ asset('js/ajax-setup.js') }}'></script>
    <script src='{{ asset('js/fullcalendar.js') }}'></script>
    <script src='{{ asset('js/event-control.js') }}'></script>

    @yield('css')
</head>
<body>

@yield('content')

</body>

@yield('js')

</html>
