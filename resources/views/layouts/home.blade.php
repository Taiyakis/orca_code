<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @yield('head')
    </head>
    <body onload=deleteCookie();>
        <header class="container top-header">
            <h1>Crypt/Decrypt</h1>
        </header>

        <div class="container">
            <div class="form-group input-margin">
                <form METHOD="post" action="/">
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    <div class="form-group left-box">
                        <textarea class="form-control" rows="10" id="comment" name="message"></textarea>
                    </div>
                    <div class="right-box forma">
                        <div class="tab-container active right">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Žinutė ištrinama už:
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                            <select name="time" class="form-control">
                                                <option value="10">10 min.</option>
                                                <option value="30">30 min.</option>
                                                <option value="60">1 val.</option>
                                                <option value="120">2 val.</option>
                                                <option value="240">4 val.</option>
                                                <option value="480">8 val.</option>
                                                <option value="720">12 val.</option>
                                                <option value="1440">1 d.</option>
                                                <option value="2880">2 d.</option>
                                                <option value="4320">3 d.</option>
                                                <option value="10080">7 d.</option>
                                            </select>
                                        </div>
                                    <button type="submit" class="btn btn-primary right">Sukurti</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form> 
            </div> 
            <div class="form-group">
                @yield('encodedUrl')
            </div>

            <!-- Alert -->
            <div class="alerts" id="alerts">
                @stack('deleteAlert')
            </div>
        </div>
    </body>
</html>
