@extends('master')
@section('title', 'About | NTGent Foyer')
@section('main')
<main class="container">
    <article class="row">
        <div class="d-flex flex-wrap">
            <div class="col-lg-6 aboutText">
                <h3>NTGent Foyer</h3>
                <p>De NTGent Foyer, op de eerste verdieping van de NTGent Schouwburg, leent zich uitstekend voor bruiloften, recepties, koffietafels, lezingen, of andere events.</p>
                <p>Deze statige, modern ingerichte zaal beschikt over een goed uitgeruste keuken, waar ons cateringteam heerlijke gerechten bereidt die perfect passen bij uw smaak en stijl. Alsook is er de mogelijkheid om te opteren voor een externe cateraar die gebruik kan maken van de keuken. Onze sfeervolle bar biedt een uitgebreide selectie drankjes aan, verzorgd door ons barpersoneel.</p>
                <p>Naast de grote binnenruimte, beschikt De Foyer over een ruim terras dat uitkijkt op het Sint-Baafsplein. Het is de ideale setting voor een zomerse receptie. Laat de sfeer van de stad en het theater u omarmen terwijl u samenkomt met uw gasten in deze unieke omgeving.</p>
                <p>Uitleg over de koningklijke nederlandse schouwburg/foyer</p>
            </div>
            <div class="col-lg-6">
                <img class="img-fluid" src="{{ url('img/sfeer/terras_leeg.avif') }}" alt="leeg terras">
            </div>
        </div>
    </article>
    <article class="row">
        <div class="d-flex flex-wrap">
            <div class="col-lg-6">
                <img class="img-fluid" src="{{ url('img/sfeer/zaal_hapjes.avif') }}" alt="zaal hapjes">
            </div>
            <div class="col-lg-6 aboutText">
                <div class="textIndent">
                    <h3>Het concept</h3>
                    <p>Higthtea/tapas + info</p>
                    <p>tekstje hoe david de beste dingen maakt</p>
                </div>
            </div>
        </div>
    </article>

</main>
@endsection
