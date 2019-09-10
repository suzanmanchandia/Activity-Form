
<!DOCTYPE html>
<html lang="en">

    <head>
        <title>@yield('title')</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="description" content="">
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <!-- Place favicon.ico and apple-touch-icon(s) here  -->

        <!-- load inks CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('packages/css/style.css') }}">

    </head>

    <body>
		@yield('before')
        <div class="container" id="main">
		@yield('before_content')
            @yield('content')

        </div>
        <script type="text/javascript" src="{{ asset('packages/js/app.min.js') }}"></script>
        @yield('footer')

    </body>
</html>
