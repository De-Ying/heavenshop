<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Leopard Shop | 500 Page</title>
     <!-- Custom stlylesheet -->
     <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/css/500.css') }}" />
</head>

<body>
    <div class="Wrapper">

        <div class="left">Error</div>
        <div class="right">
            Error
        </div>

        <canvas id="five" width=550 height=200></canvas>

    </div>

    <h1 onclick="return hrefURL()" id="error">Server Error :(</h1>
    <p>Error please return to the homepage

    <script>
        function hrefURL() {
            document.getElementById("error").innerHTML = "HOMEPAGE";

            setTimeout(function(){
                window.history.back();
            }, 3000)
        }
    </script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <script src="{{ asset('public/frontend/js/500.js') }}"></script>
</body>

</html>
