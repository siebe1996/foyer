<?php

namespace App\Http\Controllers;

use App\Costum\Drink;
use App\Costum\Food;
use Illuminate\Http\Request;

class MenuWebController extends Controller
{
    public function index(){
        $drinks = [
            new Drink('Negroni', 10, 'campari, gin en rode vermouth','Aperitief', 'Cocktail'),
            new Drink('Dark & Stormy', 10, 'havana club especial, ginger beer, verse munt, limoen en gember', 'Aperitief', 'Cocktail'),
            new Drink('Moscow Mule', 10, 'wodka, ginger beer, verse munt, limoen en gember', 'Aperitief', 'Cocktail'),
            new Drink('Bloody Mary', 9, 'wodka en gekruid tomatensap', 'Aperitief', 'Cocktail'),
            new Drink('Tom Collins', 9, 'gin, tonic en citroen', 'Aperitief', 'Cocktail'),
            new Drink('Paloma', 10, 'tequila, limoen, pompelmoes en bruisend water', 'Aperitief', 'Cocktail'),
            new Drink('Aperol Spritz', 9, 'aperol, cava en bruisend water', 'Aperitief', 'Aperitief'),
            new Drink('Campari Spritz', 9, 'campari, cava en bruisend water', 'Aperitief', 'Aperitief'),
            new Drink('Picon Vin Blanc', 7, null, 'Aperitief', 'Aperitief'),
            new Drink('Martini (rood/wit)', 5, null, 'Aperitief', 'Aperitief'),
            new Drink('Gin Tonic Beefeater', 9, null, 'Aperitief', 'Aperitief'),
            new Drink('Gin Tonic Hendricks', 11.2, null, 'Aperitief', 'Aperitief'),
            new Drink('Gin Beefeater', 6, null, 'Aperitief', 'Sterke Drank'),
            new Drink('Gin Hendricks', 8, null, 'Aperitief', 'Sterke Drank'),
            new Drink('Wiskey Bushmills', 7, null, 'Aperitief', 'Sterke Drank'),
            new Drink('Wiskey Bushhmills 10y', 9, null, 'Aperitief', 'Sterke Drank'),
            new Drink('Bourbon Bulleit', 7, null, 'Aperitief', 'Sterke Drank'),
            new Drink('Cognac (bisquit / dubouché)', 6, null, 'Aperitief', 'Sterke Drank'),
            new Drink('Rum Kraken', 8, null, 'Aperitief', 'Sterke Drank'),
            new Drink('Vodka Absolut', 6, null, 'Aperitief', 'Sterke Drank'),
            new Drink('Tequilla josé cuervo', 6, null, 'Aperitief', 'Sterke Drank'),
            new Drink('Pink Lady', 10, "n'sane pink mary, sprite, limoen en vanille", 'Aperitief', 'Mocktail'),
            new Drink('Ginger Mojito', 9, 'gember, limoen, gemberbier en bruisend water', 'Aperitief', 'Mocktail'),
            new Drink('Virgin Tom Collins', 10, 'nona june, tonic en citroen', 'Aperitief', 'Mocktail'),
            new Drink('Nona June Paloma', 10, 'nona june, limoen, pompelmoes en bruisend water', 'Aperitief', 'Mocktail'),
            new Drink('Nona Tonic', 10, null, 'Aperitief', 'Non-alcoholisch'),
            new Drink('Nona Spritz', 9, null, 'Aperitief', 'Non-alcoholisch'),
            new Drink('Pacific', 5, null, 'Aperitief', 'Non-alcoholisch'),
            new Drink('Belpils', 3, null, 'Drink', 'Bier'),
            new Drink('Liefmans Kriek', 4, null, 'Drink', 'Bier'),
            new Drink('Chimay Blauw', 4.5, null, 'Drink', 'Bier'),
            new Drink('Chimay Wit', 4.5, null, 'Drink', 'Bier'),
            new Drink('Tank 7', 4.5, null, 'Drink', 'Bier'),
            new Drink('Bolleke', 3.5, null, 'Drink', 'Bier'),
            new Drink('Gruut Blond', 3.7, null, 'Drink', 'Bier'),
            new Drink('Vedett IPA', 3.7, null, 'Drink', 'Bier'),
            new Drink('Vedett White', 3.7, null, 'Drink', 'Bier'),
            new Drink("Triple D'Anvers", 4.5, null, 'Drink', 'Bier'),
            new Drink('Duvel', 4.5, null, 'Drink', 'Bier'),
            new Drink('Gentse Strop', 3.7, null, 'Drink', 'Bier'),
            new Drink('Jupiler 0,0', 3, null, 'Drink', 'Bier'),
            new Drink('NA Liefmans', 4, null, 'Drink', 'Bier'),
            new Drink('NA La Chouffe', 4.5, null, 'Drink', 'Bier'),
            new Drink('Champagne fles', 55, null, 'Drink', 'Wijn'),
            new Drink('B&G Sparkling glas', 6, null, 'Drink', 'Wijn'),
            new Drink('B&G Sparkling fles', 24, null, 'Drink', 'Wijn'),
            new Drink('Wijn glas', 4.5, null, 'Drink', 'Wijn'),
            new Drink('Wijn fles', 19, null, 'Drink', 'Wijn'),
            new Drink('Coca Cola', 2.7, null, 'Drink', 'Soft'),
            new Drink('Coca Cola Zero', 2.7, null, 'Drink', 'Soft'),
            new Drink('Fanta', 2.7, null, 'Drink', 'Soft'),
            new Drink('Sprite', 2.7, null, 'Drink', 'Soft'),
            new Drink('Fever Tree Tonic', 3.2, null, 'Drink', 'Soft'),
            new Drink('Fever Tree Ginger Beer', 3.2,  null,'Drink', 'Soft'),
            new Drink('Almdudler', 3.2, null, 'Drink', 'Soft'),
            new Drink('Ice Tea', 3, null, 'Drink', 'Soft'),
            new Drink('Kombucha', 4, null, 'Drink', 'Soft'),
            new Drink('Bionade Elderberry', 3.7, null, 'Drink', 'Soft'),
            new Drink('Royal Bliss Agrume', 3, null, 'Drink', 'Soft'),
            new Drink('Royal Bliss Tonic', 3, null, 'Drink', 'Soft'),
            new Drink('Tomatensap', 3.5, null, 'Drink', 'Soft'),
            new Drink('Home Made Ice Tea', 4.5, null, 'Drink', 'Soft'),
            new Drink('Home Made Limonade', 3.5, null, 'Drink', 'Soft'),
            new Drink('Lungo', 2.7, null, 'Drink', 'Warme Drank'),
            new Drink('Cappuccino', 3.5, null, 'Drink', 'Warme Drank'),
            new Drink('Latte Macchiato', 4.5, null, 'Drink', 'Warme Drank'),
            new Drink('Thee', 4, null, 'Drink', 'Warme Drank'),
            ];

        $foods = [
            new Food('ALL-INCLUSIVE', 53, 'Buffet + koffie, water, thee, home made ice tea + 1/2e bubbles', 'High Tea'),
            new Food('THAI', 17, 'Lauwe rundvleessalade, mihoen, pikante dipsaus', 'Sharing Food'),
            new Food('KIP', 15, 'Spies van krokante kipfilet, mangochutney', 'Sharing Food'),
            new Food('ALBONDIGAS', 15, 'Spaanse gehaktballetjes, wiskeysaus', 'Sharing Food'),
            new Food('RIB', 18, 'Gemarineerde, BBQ, peterseliepesto', 'Sharing Food'),
            new Food('BURRATA', 15, 'Gebrande Italiaanse zachte kaas, pistache, croutons', 'Sharing Food'),
            new Food('CAMEMBERT', 15, 'Oven, chimichurri, stokbrood', 'Sharing Food'),
            new Food('CALAMARES', 15, 'Gebakken inktvisringen, verse tartaar', 'Sharing Food'),
            new Food('CEVICHE', 17, 'Zeewolf, zoete aardappel, lookbrood', 'Sharing Food'),
            new Food('SCAMPI', 19, 'Kokos, rum, citroengras', 'Sharing Food'),
            new Food('GENTSE PLANK', 25, 'Vlees en kazen, tierenteyn', 'Sharing Food'),
            new Food('LIBANESE PLANK', 25, 'Hummus, baba ganoush, libanees brood', 'Sharing Food'),
            new Food('ZOETE PLANK', 22, 'Mix van zoetigheden', 'Sharing Food'),
            new Food('HEET IJS', 9, 'Gepaneerd, speculoos, gefrituurd', 'Sharing Food'),
            new Food('NACHO', 17, 'Pikante salsa, zure room, advocado', 'Sharing Food'),
            ];
        $drinks = collect($drinks)->sortByDesc(function (Drink $drink) {
            return $drink->getPrice();
        })->values()->all();
        return view('menu', ['foods' => $foods, 'drinks'=>$drinks, 'active' => 'menu']);
    }
}
