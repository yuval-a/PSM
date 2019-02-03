<!DOCTYPE html>
<html>
    <head>
        <title>App Name - @yield('title')</title>
        <link href="../css/style.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">        
    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>