<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Task List | Curry Code Camp</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css"
          rel="stylesheet" type="text/css">

    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

    <!-- Your existing app.css (kept so nothing else breaks) -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        /* ---------- Base layout & animated tech background ---------- */
        html, body {
            height: 100%;
        }

        body {
            font-family: 'Lato', sans-serif;
            margin: 0;
            padding: 0;
            color: #222;
            position: relative;
            overflow-x: hidden;
        }

        /* Full-screen background image */
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background:
                radial-gradient(circle at top left, rgba(255, 255, 255, 0.09), transparent 55%),
                radial-gradient(circle at bottom right, rgba(255, 0, 128, 0.16), transparent 60%),
                url('{{ asset('abstract-background--technology-background--dark-web.jpg') }}')
                no-repeat center center fixed;
            background-size: cover;
            z-index: -2;
            /* subtle animated zoom */
            animation: bg-zoom 32s ease-in-out infinite alternate;
        }

        /* Soft dark overlay so cards are readable */
        body::after {
            content: "";
            position: fixed;
            inset: 0;
            background: linear-gradient(
                to bottom,
                rgba(0, 0, 0, 0.45),
                rgba(0, 0, 0, 0.75)
            );
            z-index: -1;
            pointer-events: none;
        }

        @keyframes bg-zoom {
            0%   { transform: scale(1); }
            100% { transform: scale(1.06); }
        }

        /* ---------- Navbar with Curry Code Camp branding ---------- */
        .navbar {
            background-color: rgba(5, 8, 20, 0.6) !important;
            border: none;
            border-radius: 0;
            box-shadow: 0 0 24px rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(10px);
        }

        .navbar .navbar-brand {
            color: #ffffff !important;
            font-weight: 900;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            text-shadow: 0 0 10px rgba(255, 0, 120, 0.75);
        }

        .navbar .navbar-brand span.ccc-accent {
            color: #ff2d6f;
        }

        .navbar .navbar-brand small {
            display: block;
            font-weight: 300;
            font-size: 11px;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.7);
        }

        .navbar-nav > li > a#theme-toggle {
            color: #f5f5f5 !important;
            font-weight: 400;
        }

        .navbar-nav > li > a#theme-toggle .fa {
            margin-right: 4px;
        }

        /* ---------- Panels / cards & task table ---------- */

        /* Main Bootstrap panel container used by the task list */
        .panel {
            background-color: rgba(248, 248, 252, 0.92) !important;
            border-radius: 14px !important;
            border: none !important;
            box-shadow: 0 14px 40px rgba(0, 0, 0, 0.45);
        }

        .panel-heading {
            background: linear-gradient(90deg, #ff2d6f, #ff7a45);
            color: #fff !important;
            border-radius: 14px 14px 0 0 !important;
            border: none !important;
            font-weight: 700;
            letter-spacing: 0.03em;
            text-transform: uppercase;
        }

        .panel-body {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 0 0 14px 14px;
        }

        /* Task table rows with subtle hover and separation */
        .task-table > tbody > tr {
            transition: background 0.18s ease, transform 0.12s ease, box-shadow 0.12s ease;
        }

        .task-table > tbody > tr:hover {
            background: rgba(255, 255, 255, 0.95);
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.08);
        }

        .task-table .table-text div {
            font-weight: 400;
        }

        /* ---------- Glowing buttons ---------- */
        .btn-default, .btn-danger {
            border-radius: 999px;
            font-weight: 600;
            border: none;
            position: relative;
            overflow: hidden;
        }

        /* Add Task button */
        .btn-default {
            background: linear-gradient(90deg, #00e0ff, #4df3c3);
            color: #041024;
            box-shadow: 0 0 18px rgba(0, 223, 255, 0.65);
        }

        .btn-default:hover {
            background: linear-gradient(90deg, #4df3c3, #00e0ff);
            box-shadow: 0 0 26px rgba(0, 223, 255, 0.9);
            color: #020813;
        }

        /* Delete button */
        .btn-danger {
            background: linear-gradient(90deg, #ff416c, #ff4b2b);
            color: #ffffff;
            box-shadow: 0 0 16px rgba(255, 65, 108, 0.65);
        }

        .btn-danger:hover {
            background: linear-gradient(90deg, #ff4b2b, #ff416c);
            box-shadow: 0 0 26px rgba(255, 77, 43, 0.9);
            color: #ffffff;
        }

        /* subtle light streak on hover */
        .btn-default::after,
        .btn-danger::after {
            content: "";
            position: absolute;
            top: -60%;
            left: -40%;
            width: 40%;
            height: 220%;
            background: rgba(255, 255, 255, 0.26);
            transform: skewX(-25deg);
            transition: transform 0.4s ease;
        }

        .btn-default:hover::after,
        .btn-danger:hover::after {
            transform: translateX(260%) skewX(-25deg);
        }

        /* ---------- Typography tweaks ---------- */
        h1, h2, h3, .panel-heading {
            letter-spacing: 0.03em;
        }

        .panel .control-label {
            font-weight: 700;
        }

        /* ---------- Response time panel ---------- */
        .panel.panel-default:last-of-type .panel-body {
            font-size: 12px;
            color: #555;
            text-align: center;
        }

        /* ---------- Dark mode toggle ---------- */
        body.dark-mode::before {
            filter: brightness(0.7) saturate(1.2);
        }

        body.dark-mode::after {
            background: radial-gradient(circle at top, rgba(255, 45, 111, 0.45), transparent 55%),
                        radial-gradient(circle at bottom, rgba(0, 224, 255, 0.30), transparent 60%),
                        rgba(0, 0, 0, 0.88);
        }

        body.dark-mode {
            color: #f6f6ff;
        }

        body.dark-mode .navbar {
            background-color: rgba(3, 5, 18, 0.9) !important;
        }

        body.dark-mode .navbar .navbar-brand small {
            color: rgba(255, 255, 255, 0.55);
        }

        body.dark-mode .panel {
            background-color: rgba(6, 10, 28, 0.96) !important;
            box-shadow: 0 18px 48px rgba(0, 0, 0, 0.9);
        }

        body.dark-mode .panel-heading {
            background: linear-gradient(90deg, #ff2d6f, #ff9322);
        }

        body.dark-mode .panel-body {
            background: rgba(7, 12, 32, 0.98);
            color: #f4f4ff;
        }

        body.dark-mode .task-table > tbody > tr:hover {
            background: rgba(15, 22, 55, 0.96);
        }

        body.dark-mode .panel.panel-default:last-of-type .panel-body {
            color: #b6b9d5;
        }
    </style>
</head>

<body id="app-layout">
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <!-- Branding -->
            <a class="navbar-brand" href="{{ url('/') }}">
                <span class="ccc-accent">Curry</span> Code Camp
                <small>Task List</small>
            </a>

            <!-- Mobile toggle button (Bootstrap default) -->
            <button type="button" class="navbar-toggle collapsed"
                    data-toggle="collapse" data-target="#navbar-main">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="navbar-main">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="javascript:void(0);" id="theme-toggle">
                        <i class="fa fa-moon-o"></i>
                        Dark Mode
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

@yield('content')

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<script>
    // Simple dark mode toggle with localStorage
    (function () {
        var body = document.body;
        var toggle = document.getElementById('theme-toggle');

        if (!toggle) return;

        // Load saved preference
        var saved = localStorage.getItem('ccc-tasklist-theme');
        if (saved === 'dark') {
            body.classList.add('dark-mode');
        }

        toggle.addEventListener('click', function () {
            body.classList.toggle('dark-mode');
            var mode = body.classList.contains('dark-mode') ? 'dark' : 'light';
            localStorage.setItem('ccc-tasklist-theme', mode);

            // Optional: icon swap
            var icon = toggle.querySelector('.fa');
            if (icon) {
                icon.className = body.classList.contains('dark-mode')
                    ? 'fa fa-sun-o'
                    : 'fa fa-moon-o';
            }
        });
    })();
</script>

</body>
</html>
