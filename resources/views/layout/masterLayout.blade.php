<html>
    <head>
        <title>
            @yield('title')
        </title>
    </head>
    <body>
        @section('menuBar')
        This is menu bar
        @show
        
        <div class="main">
            @yield('content')
        </div>
    </body>
</html>