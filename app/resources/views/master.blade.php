<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Van de Voorde Siebe">
    <title>@yield('title')</title>

    <link rel="icon" href="{{asset('img/icons/scared.ico')}}">

    <!-- Custom styles for this template -->
    <link href="{{asset('css/main.css')}}" rel="stylesheet">
</head>
<body id="top">

<div class="container">
    <header class="blog-header py-3">
        <a href="{{ url('/') }}" ><h1>Gotcha</h1></a>
        @if($buttons['create'])
            <a href="{{ url('') }}">Create Game</a>
        @endif
        @if($buttons['logout'])
            <a href="{{ url('') }}">Logout</a>
        @endif
    </header>
</div>

@section('main')
@show

<footer class="blog-footer">
    <p>&copy; Web &amp; Mobile Full-stack @ <a href="https://www.odisee.be">odisee</a> | 2022 | template by Van de Voorde Siebe</p>
    <p>
        <a href="#top">Back to top</a>
    </p>
</footer>



</body>
</html>
