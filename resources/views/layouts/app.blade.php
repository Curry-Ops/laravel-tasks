<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Task List</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel="stylesheet" type="text/css">

    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

    <!-- Your existing app.css (still fine to keep) -->
    <link href="{{ asset('css/app.css') }}?v=2" rel="stylesheet">

    <!-- Inline styles to FORCE the tech background -->
    <style>
        body {
            font-family: 'Lato', sans-serif;
            background: url('{{ asset('abstract-background--technology-background--dark-web.jpg') }}')
                        no-repeat center center fixed;
            background-size: cover;
        }

        /* Make content readable on top of the image */
        .container,
        .panel,
        .table {
            background-color: rgba(255, 255, 255, 0.88);
            border-radius: 10px;
        }

        .panel {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.35);
        }

        .navbar {
            margin-bottom: 30px;
        }

        .btn-danger {
            opacity: 0.95;
            font-weight: bold;
        }
    </style>
</head>

<body id="app-layout">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Task List
                </a>
            </div>
        </div>
    </nav>

    {{-- This is where tasks.blade.php content is injected --}}
    @yield('content')

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>
