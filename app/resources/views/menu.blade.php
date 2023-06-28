@extends('master')
@section('title', 'Menu | NTGent Foyer')
@section('main')
    <main class="container">
        <h2>menu</h2>
        <div>
            <h3>Drinks</h3>
            <div>
                <h4>Bieren</h4>
                <ul>
                    @foreach($drinks as $drink)
                        @if ($drink->getSubkind() == 'Bier')
                            <li><p>{{$drink->getName()}}</p><p>{{$drink->getPrice()}}</p></li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div>
                <h4>Wijnen</h4>
                <ul>
                    @foreach($drinks as $drink)
                        @if ($drink->getSubkind() == 'Wijn')
                            <li><p>{{$drink->getName()}}</p><p>{{$drink->getPrice()}}</p></li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div>
                <h4>Soft</h4>
                <ul>
                    @foreach($drinks as $drink)
                        @if ($drink->getSubkind() == 'Soft')
                            <li><p>{{$drink->getName()}}</p><p>{{$drink->getPrice()}}</p></li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div>
                <h4>Warme Dranken</h4>
                <ul>
                    @foreach($drinks as $drink)
                        @if ($drink->getSubkind() == 'Warme Drank')
                            <li><p>{{$drink->getName()}}</p><p>{{$drink->getPrice()}}</p></li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
        <div>
            <h3>High Tea</h3>
            <p>14u-18u</p>
            <ul>
                @foreach($foods as $food)
                    @if ($food->getKind() == 'High Tea')
                        <li><h4>{{$food->getName()}}</h4><p>{{$food->getDescription()}}</p><p>{{$food->getPrice()}}</p></li>
                    @endif
                @endforeach
            </ul>
            <div>
                <p>Tussen lunch en dinner, geen brunch maar “ AFTERNOON TEA “</p>
                <p>Een ‘ sweet and savory ‘samengesteld buffet van kleine hapjes, voor iedereen wat wils, van kaas tot
                charcuterie, vegetarische wraps, zoetigheden van brownies tot macarons.</p>
                <p>De combinatie van de prachtige setting, vers eten, huisgemaakte limonades, thee en bubbels is al
                een geslaagde namiddag!</p>
                <p>Met of zonder reservatie, binnen of buiten, allen welkom van 14u tot 17,30u</p>
            </div>
        </div>
        <div>
            <h3>Sharing Food</h3>
            <p>18u-23u</p>
            <ul>
                @foreach($foods as $food)
                    @if ($food->getKind() == 'Sharing Food')
                        <li><h4>{{$food->getName()}}</h4><p>{{$food->getDescription()}}</p><p>{{$food->getPrice()}}</p></li>
                    @endif
                @endforeach
            </ul>
            <div>
                <p>Sharing food, tapas, petiscos, what’s in a name..</p>
                <p>Verfijnde en uitgekiende bordjes om te smullen, om te delen, global food, vis, vlees en vegetarisch.</p>
                <p>Samen met je vrienden, collega’s of je lief een optreden meepikken en je maag vullen?</p>
                <p>Bij ons, NTG terras , is dit mogelijk!</p>
                <p>Vanop de eerste verdieping, vanaf 18u zijn jullie allen welkom.</p>
            </div>
        </div>
    </main>
@endsection
