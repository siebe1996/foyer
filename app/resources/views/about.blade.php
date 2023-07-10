@extends('master')
@section('title', 'About | NTGent Foyer')
@section('main')
    <main class="container">
        <article class="row">
            <h2>About</h2>
            <div class="d-flex flex-wrap">
                <div class="col-lg-6 aboutText">
                    <h3>NTGent Foyer</h3>
                    <p>De NTGent Foyer, op de eerste verdieping van de NTGent Schouwburg, leent zich uitstekend voor
                        bruiloften, recepties, koffietafels, lezingen, of andere events.</p>
                    <p>Deze statige, modern ingerichte zaal beschikt over een goed uitgeruste keuken, waar ons
                        cateringteam heerlijke gerechten bereidt die perfect passen bij uw smaak en stijl. Alsook is er
                        de mogelijkheid om te opteren voor een externe cateraar die gebruik kan maken van de keuken.
                        Onze sfeervolle bar biedt een uitgebreide selectie drankjes aan, verzorgd door ons
                        barpersoneel.</p>
                    <p>Naast de grote binnenruimte, beschikt De NTGent Foyer over een ruim terras dat uitkijkt op het
                        Sint-Baafsplein. Het is de ideale setting voor een zomerse receptie. Laat de sfeer van de stad
                        en het theater u omarmen terwijl u samenkomt met uw gasten in deze unieke omgeving.</p>
                </div>
                <div class="col-lg-6">
                    <img class="img-fluid" src="{{ url('img/sfeer/_DSC6118.jpg') }}" alt="zaal de foyer">
                </div>
            </div>
        </article>
        <article class="row">
            <div class="d-flex flex-wrap">
                <div class="col-lg-6">
                    <img class="img-fluid" src="{{ url('img/sfeer/_DSC7587.jpg') }}" alt="onze kok">
                </div>
                <div class="col-lg-6 aboutText">
                    <div class="textIndent">
                        <h3>Het concept van onze kok</h3>
                        <p>Als een gepassioneerde autodidactische cateraar met een achtergrond in de horecawereld, ben
                            ik al van jongs af aan actief in deze branche. Mijn ervaring strekt zich uit van werken
                            achter de bar tot het heden. Ik ben de trotse oprichter van cateringbedrijf Walhallafood,
                            tevens eigenaar van restaurant Wunderbar en het cultuurcafé Bar Mitte.</p>

                        <p>Als een globetrotter in cultuur en smaken, reis ik zowel nationaal als internationaal als
                            cateraar voor theaterproducties, festivals, beurzen en soms zelfs met kunstenaar Arne
                            Quinze. Op dit moment ben ik de vaste cateraar van NTGent, waar ik uw huiselijke culinaire
                            ervaring verzorg.</p>

                        <p>Tussen lunch en diner bieden wij geen traditionele brunch, maar een "AFTERNOON TEA". Dit is
                            een samengesteld buffet van heerlijke zoete en hartige hapjes, waar voor iedereen iets
                            lekkers te vinden is. Van kaas en charcuterie tot vegetarische wraps en zoete lekkernijen
                            zoals brownies en macarons. De combinatie van een prachtige setting, verse gerechten,
                            huisgemaakte limonades, thee en bubbels zorgt voor een geslaagde namiddag. Of u nu binnen of
                            buiten wilt genieten, met of zonder reservering, u bent van harte welkom tussen 14.00 uur en
                            17.30 uur.</p>

                        <p>Bij ons staat "sharing food" centraal. We serveren verfijnde en uitgebalanceerde gerechten
                            die perfect zijn om te delen, zoals tapas en petiscos. Ons aanbod omvat een scala aan
                            wereldse gerechten, waaronder vis, vlees en vegetarische opties. Geniet samen met uw
                            vrienden, collega's of geliefden van een smaakvolle avond, terwijl u ook kunt genieten van
                            een optreden op het NTGent terras. Vanaf 18.00 uur heten wij u allen van harte welkom op de
                            eerste verdieping.</p>

                        <p>Kom langs en ontdek de culinaire creaties en de gezellige sfeer die ik met passie voor u heb
                            gecreëerd.</p>
                    </div>
                </div>
            </div>
        </article>

    </main>
@endsection
