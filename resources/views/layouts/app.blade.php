<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    @yield('css')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('js')

    <link rel="stylesheet" href="../jqwidgets/styles/jqx.base.css" type="text/css" />
    <script type="text/javascript" src="../scripts/demos.js"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>

                <div id="nav-profile-dropdown" class="btn-group navbar-right">
                <button data-toggle="dropdown" class="btn btn-lg navbar-btn dropdown-toggle" type="button" style="width: 50%;">
                    <span class="caret">Pridať galériu</span>
                </button>
                <ul class="dropdown-menu w-100">
                    <li>
                        <form class="px-4 py-3 w-100" method="post" action="/gallery" enctype="multipart/form-data">
                            @csrf
                            <label class="col-form-label" for="name">Názov galérie</label>
                            <input type="text" class="form-control" id="name" name="name">
                            
                            <button type="submit" class="btn btn-primary">Pridať galériu</button>
                        </form>
                    </li>
                </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
                <div class="col-lg-12 col-md-12 col-sd-12">
                    @yield('content')
                </div>
        </main>
    </div>
</body>
</html>