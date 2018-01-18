<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Banka e Parë</title>
    <link rel="shortcut icon"  href="/images/icon.png">

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="/components/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/components/font-awesome/css/font-awesome.min.css">
    <!-- My Styles -->
    @yield ('custom_styles')
    <link rel="stylesheet" type="text/css" href="/css/main-structure.css">
</head>

<body class="sidebar-mini">

<div>
    @include ('layouts.header')

    @include ('layouts.sidebar')

    <div class="content-wrapper"><!-- Main Box -->
        <div style="width: 100%;" class="container">
            <div style="margin-bottom: 60px;" class="row"></div>
            @yield ('content')
        </div> <!-- End of the container -->
    </div><!-- End Main Box -->

</div>

@include ('layouts.footer')

</body>
</html>