<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Van de Voorde Siebe">
    <title>@yield('title')</title>

    <link rel="icon" type="image/png" sizes="32x32" href="{{ url('logo-normal-gold.png') }}">

    <!-- Custom styles for this template -->
    <link href="{{asset('css/main.css')}}" rel="stylesheet">
</head>
<body id="top">

<div class="container">
    <header class="">
        <img src="{{ url('logo-normal-gold.png') }}" alt="logo">
        <h1>NTGent foyer</h1>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/about">About</a></li>
                <li><a href="/menu">Menu</a></li>
                <li><a href="/moodboard">Moodboard</a></li>
                <li><a href="/contact">Contact</a></li>
            </ul>
        </nav>
    </header>
</div>

@section('main')
@show

<footer class="blog-footer">
    <p>&copy; Ntgent | 2023 | template by Van de Voorde Siebe</p>
    <p>
        <a href="#top">Back to top</a>
    </p>
</footer>

<script type="text/javascript">(function(){var k=function(a,c,d,b){if(a.getElementById(d)){if(b){var e=100;var f=function(){setTimeout(function() {e--;if(window.RESENGO_WIDGET_SCRIPT_LOADED)b();else if(0<e)f();else throw Error("resengo script failed to load");},100)};f()}}else{var g=a.getElementsByTagName(c) [0];a=a.createElement(c);a.id=d;a.src="https://static.resengo.com/ResengoWidget";b&&(a.onload=b);g.parentNode.insertBefore(a,g)}},h=function() {return k(document,"script","resengo-flow-widget-script",function(){RESENGO_WIDGET({companyId:"1761113",language:"nl"})})}; window.attachEvent?window.attachEvent("onload",h):window.addEventListener("load",h,!1)})();</script>
<script src="https://kit.fontawesome.com/571d0438fc.js" crossorigin="anonymous"></script>
</body>

</html>
