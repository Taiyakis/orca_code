<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @yield('head')
    </head>
    <body onload=countdown();>
        <header class="container top-header">
            <h1>Crypt/Decrypt</h1>
        </header>
        <div class="container">
            <div class="form-group left-box">
                @yield('decodedMsg')
            </div>
        @yield('time')
        </div>
        @yield('js')
    </body>
</html>
