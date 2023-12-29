<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Heaven Shop | 404 Page</title>
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700,900" rel="stylesheet">

    <!-- Custom stlylesheet -->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/frontend/errors/404/style.css') !!}" />
</head>

<body>
    <div id="rocket"></div>

    <hgroup>
        <h1>Page Not Found</h1>
        <h2>We couldn't find what you were looking for.</h2>
    </hgroup>

    <p class="createdBy">
        <a href="{{ route('home_page') }}">
            HOMEPAGE
        </a>
    </p>


    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <script src="{!! asset('public/frontend/errors/404/main.js') !!}"></script>
</body>

</html>
