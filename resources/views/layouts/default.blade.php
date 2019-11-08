<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/img/favicon.ico">
    <title>@yield('title', 'Laravel App') - Laravel 入门教程</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>
<body>
@include('layouts._header')
<div class="container">
    <main role="main">
    @yield('content')
    </main>
    @include('layouts._footer')

</div>
</body>
</html>