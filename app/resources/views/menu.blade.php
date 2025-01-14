@extends('master')
@section('title', 'Menu | NTGent Foyer')
@section('main')
    <main class="container menu">
        <h2>menu</h2>
        <div>
            <h3>High Tea</h3>
            <p class="text-center">14u-18u</p>
            <div>
                <p>Tussen lunch en dinner, geen brunch maar “AFTERNOON TEA“. Een ‘sweet and savory‘ samengesteld
                    buffet van kleine hapjes, voor iedereen wat wils, van kaas tot
                    charcuterie, vegetarische wraps, zoetigheden van brownies tot macarons. De combinatie van de
                    prachtige setting, vers eten, huisgemaakte limonades, thee en bubbels is al
                    een geslaagde namiddag! Met of zonder reservatie, binnen of buiten, allen welkom.</p>
            </div>
            <ul>
                @foreach($foods as $food)
                    @if ($food->getKind() == 'High Tea')
                        <li>
                            <div class="d-flex justify-content-between">
                                <div><h4 class="no-padding-left">{{$food->getName()}}</h4>
                                    <p
                                        class="col-8">{{$food->getDescription()}}</p></div>
                                <p class="menuItem">{{ number_format($food->getPrice(), 1, '.', '') }}</p></div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
        <div class="sharing-food">
            <h3>Sharing Food</h3>
            <p class="text-center">18u-23u</p>
            <div class="marginBottom">
                <p>Sharing food, tapas, petiscos, what’s in a name.. Verfijnde en uitgekiende bordjes om te smullen, om
                    te delen, werelds eten, vis, vlees en vegetarisch. Samen met je vrienden, collega’s of je lief een
                    optreden meepikken en je maag vullen? Bij ons, NTGent terras , is dit mogelijk!
                    Vanop de eerste verdieping, vanaf 18u zijn jullie allen welkom.</p>
            </div>
            <ul>
                @foreach($foods as $food)
                    @if ($food->getKind() == 'Sharing Food')
                        <li>

                            <div class="d-flex justify-content-between">
                                <div><h4 class="no-padding-left">{{$food->getName()}}</h4>
                                    <p
                                        class="col-8">{{$food->getDescription()}}</p></div>
                                <p class="menuItem">{{ number_format($food->getPrice(), 1, '.', '') }}</p></div>

                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
        <div class="drinks">
            <h3>Aperitieven</h3>

            <div class="row">

                <div class="col-12 col-md-6">
                    <h4>Cocktails</h4>
                    <ul>
                        @foreach($drinks as $drink)
                            @if ($drink->getSubkind() == 'Cocktail')
                                <li class="row">
                                    <div class="d-flex justify-content-between">
                                        <div><p
                                            >{{$drink->getName()}}</p>
                                            <p class="ms-1"><em>{{$drink->getDescription()}}</em></p></div>
                                        <p class="menuItem">{{ number_format($drink->getPrice(), 1, '.', '') }}</p>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="col-12 col-md-6">
                    <h4>Aperitief</h4>
                    <ul>
                        @foreach($drinks as $drink)
                            @if ($drink->getSubkind() == 'Aperitief')
                                <li class="row">
                                    <div class="d-flex justify-content-between">
                                        <div><p
                                            >{{$drink->getName()}}</p>
                                            <p class="ms-1"><em>{{$drink->getDescription()}}</em></p></div>
                                        <p class="menuItem">{{ number_format($drink->getPrice(), 1, '.', '') }}</p>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <h4>Sterke dranken</h4>
                    <ul>
                        @foreach($drinks as $drink)
                            @if ($drink->getSubkind() == 'Sterke Drank')
                                <li class="row">
                                    <div class="d-flex justify-content-between"><p
                                        >{{$drink->getName()}}</p>
                                        <p class="menuItem">{{ number_format($drink->getPrice(), 1, '.', '') }}</p>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                        <li class="row">
                            <div class="d-flex justify-content-between">
                                <div><p
                                    >shot</p>
                                    <p class="ms-1"><em>sterke drank in shot vorm</em></p></div>
                                <p class="menuItem">{{ number_format(-2, 1, '.', '') }}</p></div>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-md-6">
                    <div>
                        <h4>Mocktails</h4>
                        <ul>
                            @foreach($drinks as $drink)
                                @if ($drink->getSubkind() == 'Mocktail')
                                    <li class="row">
                                        <div class="d-flex justify-content-between">
                                            <div><p
                                                >{{$drink->getName()}}</p>
                                                <p class="ms-1"><em>{{$drink->getDescription()}}</em></p></div>
                                            <p class="menuItem">{{ number_format($drink->getPrice(), 1, '.', '') }}</p>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <div>
                        <h4>Non-alcoholisch</h4>
                        <ul>
                            @foreach($drinks as $drink)
                                @if ($drink->getSubkind() == 'Non-alcoholisch')
                                    <li class="row">
                                        <div class="d-flex justify-content-between">
                                            <div><p
                                                >{{$drink->getName()}}</p>
                                                <p class="ms-1"><em>{{$drink->getDescription()}}</em></p></div>
                                            <p class="menuItem">{{ number_format($drink->getPrice(), 1, '.', '') }}</p>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        <div class="drinks">
            <h3>Drinks</h3>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div>
                        <h4 class="d-flex justify-content-between">Bieren</h4>
                        <ul>
                            @foreach($drinks as $drink)
                                @if ($drink->getSubkind() == 'Bier')
                                    <li class="row">
                                        <div class="d-flex justify-content-between">
                                            <div><p
                                                >{{$drink->getName()}}</p>
                                                <p class="ms-1"><em>{{$drink->getDescription()}}</em></p></div>
                                            <p class="menuItem">{{ number_format($drink->getPrice(), 1, '.', '') }}</p>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <div>
                        <h4 class="d-flex justify-content-between">Non-alcoholische bieren</h4>
                        <ul>
                            @foreach($drinks as $drink)
                                @if ($drink->getSubkind() == 'BierNA')
                                    <li class="row">
                                        <div class="d-flex justify-content-between">
                                            <div><p
                                                >{{$drink->getName()}}</p>
                                                <p class="ms-1"><em>{{$drink->getDescription()}}</em></p></div>
                                            <p class="menuItem">{{ number_format($drink->getPrice(), 1, '.', '') }}</p>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <h4>Soft</h4>
                    <ul>
                        @foreach($drinks as $drink)
                            @if ($drink->getSubkind() == 'Soft')
                                <li class="row">
                                    <div class="d-flex justify-content-between">
                                        <div><p
                                            >{{$drink->getName()}}</p>
                                            <p class="ms-1"><em>{{$drink->getDescription()}}</em></p></div>
                                        <p class="menuItem">{{ number_format($drink->getPrice(), 1, '.', '') }}</p>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <h4>Wijnen</h4>
                    <ul>
                        @foreach($drinks as $drink)
                            @if ($drink->getSubkind() == 'Wijn')
                                <li class="row">
                                    <div class="d-flex justify-content-between">
                                        <div><p
                                            >{{$drink->getName()}}</p>
                                            <p class="ms-1"><em>{{$drink->getDescription()}}</em></p></div>
                                        <p class="menuItem">{{ number_format($drink->getPrice(), 1, '.', '') }}</p>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="col-12 col-md-6">
                    <h4>Warme Dranken</h4>
                    <ul>
                        @foreach($drinks as $drink)
                            @if ($drink->getSubkind() == 'Warme Drank')
                                <li class="row">
                                    <div class="d-flex justify-content-between">
                                        <div><p
                                            >{{$drink->getName()}}</p>
                                            <p class="ms-1"><em>{{$drink->getDescription()}}</em></p></div>
                                        <p class="menuItem">{{ number_format($drink->getPrice(), 1, '.', '') }}</p>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </main>
@endsection
