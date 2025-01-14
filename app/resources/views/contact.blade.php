@extends('master')
@section('title', 'Contact | NTGent Foyer')
@section('main')
<main class="container">
    <h2>Contact</h2>
    <div>
        <p class="text-center">
            Tijdens de gentse feesten van 14 juli tot 23 juli zijn wij alle dagen open van 14u tot 23u
        </p>
    </div>
    <div class="row">
  <div class="d-flex justify-content-center subMenu flex-wrap">
    <div class="subMenuItem">
      <p><a class="subMenuButton" href="tel:+32474873914">+32 474 87 39 14</a></p>
    </div>
    <div class="subMenuItem">
      <p><a class="subMenuButtonOff" href="https://wwc.resengo.com/ntgent">Reserveer hier</a></p>
    </div>
    <div class="subMenuItem">
      <p><a class="subMenuButton" href="mailto:event@ntgent.be">Stuur ons een mail</a></p>
    </div>
  </div>
</div>
    <div>
        <p class="text-center">Sint-Baafsplein 17, 9000 Gent</p>
    </div>
    <div class="marginBottom">
        <script type="text/javascript" data-name="resengo-widget-iframe-script">(function(){var k=function(a,c,d,b){if(a.getElementById(d)) {if(b){var e=100;var f=function(){setTimeout(function(){e--;if(window.RESENGO_WIDGET_SCRIPT_LOADED)b();else if(0<e)f();else throw Error("resengo widget script failed to load");},100)};f()}} else{var g=a.getElementsByTagName(c)[0];a=a.createElement(c);a.id=d;a.src="https://static.resengo.com/ResengoWidget";b&&(a.onload=b);g.parentNode.insertBefore(a,g)}},h=function() {return k(document,"script","resengo-flow-widget-script",function(){RESENGO_WIDGET({companyId:"1761113",language:"nl",mode:"iframe"})})}; window.attachEvent?window.attachEvent("onload",h):window.addEventListener("load",h,!1)})();</script>
    </div>
</main>
@endsection
