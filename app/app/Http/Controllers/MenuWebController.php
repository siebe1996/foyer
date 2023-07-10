<?php

namespace App\Http\Controllers;

use App\Costum\Drink;
use App\Costum\Food;
use Illuminate\Http\Request;

class MenuWebController extends Controller
{
    public function index(){
        $drinks = [
            new Drink('Negroni', 10, 'campari, gin en rode vermouth','Aperitief', 'Cocktail', true),
            new Drink('Dark & Stormy', 10, 'havana club especial, ginger beer, verse munt, limoen en gember', 'Aperitief', 'Cocktail', true),
            new Drink('Moscow Mule', 10, 'vodka, ginger beer, verse munt, limoen en gember', 'Aperitief', 'Cocktail', true),
            new Drink('Bloody Mary', 9, 'vodka en gekruid tomatensap', 'Aperitief', 'Cocktail', true),
            new Drink('Tom Collins', 9, 'gin, tonic en citroen', 'Aperitief', 'Cocktail', true),
            new Drink('Paloma', 10, 'tequila, limoen, pompelmoes en bruisend water', 'Aperitief', 'Cocktail', true),
            new Drink('Aperol Spritz', 9, 'aperol, cava en bruisend water', 'Aperitief', 'Aperitief', true),
            new Drink('Campari Spritz', 9, 'campari, cava en bruisend water', 'Aperitief', 'Aperitief', false),
            new Drink('Ricard', 5, null, 'Aperitief', 'Aperitief', true),
            new Drink('Picon Vin Blanc', 7, null, 'Aperitief', 'Aperitief', true),
            new Drink('Martini (rood/wit)', 5, null, 'Aperitief', 'Aperitief', true),
            new Drink('Gin Tonic Beefeater', 9, null, 'Aperitief', 'Aperitief', false),
            new Drink('Gin Tonic Hendricks', 11.2, null, 'Aperitief', 'Aperitief', false),
            new Drink('Gin Beefeater', 6, null, 'Aperitief', 'Sterke Drank', true),
            new Drink('Gin Hendricks', 8, null, 'Aperitief', 'Sterke Drank', true),
            new Drink('Wiskey Bushmills', 7, null, 'Aperitief', 'Sterke Drank', true),
            new Drink('Wiskey Bushmills 10y', 9, null, 'Aperitief', 'Sterke Drank', true),
            new Drink('Bourbon Bulleit', 7, null, 'Aperitief', 'Sterke Drank', true),
            new Drink('Cognac (bisquit / dubouché)', 6, null, 'Aperitief', 'Sterke Drank', true),
            new Drink('Rum havana club especial', 7, null, 'Aperitief', 'Sterke Drank', true),
            new Drink('Rum Kraken', 8, null, 'Aperitief', 'Sterke Drank', true),
            new Drink('Vodka Absolut', 6, null, 'Aperitief', 'Sterke Drank', true),
            new Drink('Tequilla josé cuervo', 6, null, 'Aperitief', 'Sterke Drank', true),
            new Drink('Pink Lady', 10, "n'sane pink mary, sprite, limoen en vanille", 'Aperitief', 'Mocktail', true),
            new Drink('Ginger Mojito', 9, 'gember, limoen, gemberbier en bruisend water', 'Aperitief', 'Mocktail', false),
            new Drink('Virgin Tom Collins', 10, 'nona june, tonic en citroen', 'Aperitief', 'Mocktail', true),
            new Drink('Nona June Paloma', 10, 'nona june, limoen, pompelmoes en bruisend water', 'Aperitief', 'Mocktail', true),
            new Drink('Nona Tonic', 10, null, 'Aperitief', 'Non-alcoholisch', true),
            new Drink('Nona Spritz', 9, null, 'Aperitief', 'Non-alcoholisch', true),
            new Drink('Pacific', 5, null, 'Aperitief', 'Non-alcoholisch', true),
            new Drink('Belpils', 2.7, null, 'Drink', 'Bier', true),
            new Drink('Liefmans Kriek', 4, null, 'Drink', 'Bier', true),
            new Drink('Chimay Blauw', 4.5, null, 'Drink', 'Bier', true),
            new Drink('Chimay Wit', 4.5, null, 'Drink', 'Bier', true),
            new Drink('Tank 7', 4.5, null, 'Drink', 'Bier', false),
            new Drink('Bolleke', 3.5, null, 'Drink', 'Bier', true),
            new Drink('Gruut Blond', 3.7, null, 'Drink', 'Bier', false),
            new Drink('Vedett IPA', 3.7, null, 'Drink', 'Bier', true),
            new Drink('Vedett White', 3.7, null, 'Drink', 'Bier', true),
            new Drink('Vedett Blond', 3.7, null, 'Drink', 'Bier', true),
            new Drink("Triple D'Anvers", 4.5, null, 'Drink', 'Bier', true),
            new Drink('Duvel', 4.5, null, 'Drink', 'Bier', true),
            new Drink('Gentse Strop', 3.7, null, 'Drink', 'Bier', true),
            new Drink('Jupiler 0,0', 2.7, null, 'Drink', 'BierNA', true),
            new Drink('NA Liefmans', 4, null, 'Drink', 'BierNA', true),
            new Drink('NA La Chouffe', 4.5, null, 'Drink', 'BierNA', true),
            new Drink('Orval', 5.5, null, 'Drink', 'Bier', true),
            new Drink('Wijn glas', 4.5, 'wit/rosé/rood', 'Drink', 'Wijn', true),
            new Drink('Wijn fles', 19, 'wit/rosé/rood', 'Drink', 'Wijn', true),
            new Drink('B&G Sparkling glas', 6, null, 'Drink', 'Wijn', true),
            new Drink('B&G Sparkling fles', 24, null, 'Drink', 'Wijn', true),
            new Drink('Champagne fles', 55, null, 'Drink', 'Wijn', true),
            new Drink('Coca Cola', 2.7, null, 'Drink', 'Soft', true),
            new Drink('Coca Cola Zero', 2.7, null, 'Drink', 'Soft', true),
            new Drink('Fanta', 2.7, null, 'Drink', 'Soft', true),
            new Drink('Sprite', 2.7, null, 'Drink', 'Soft', true),
            new Drink('Fever-Tree Tonic', 3.2, null, 'Drink', 'Soft', true),
            new Drink('Fever-Tree Ginger Beer', 3.2,  null,'Drink', 'Soft', true),
            new Drink('Almdudler', 3.2, null, 'Drink', 'Soft', true),
            new Drink('Ice Tea', 3, null, 'Drink', 'Soft', true),
            new Drink('Kombucha', 4, null, 'Drink', 'Soft', true),
            new Drink('Bionade Elderberry', 3.7, null, 'Drink', 'Soft', true),
            new Drink('Royal Bliss Agrumes', 3, null, 'Drink', 'Soft', true),
            new Drink('Royal Bliss Tonic', 3, null, 'Drink', 'Soft', true),
            new Drink('Tomatensap', 3.5, null, 'Drink', 'Soft', true),
            new Drink('Home Made Ice Tea', 4.5, null, 'Drink', 'Soft', true),
            new Drink('Home Made Lemonade', 4, null, 'Drink', 'Soft', true),
            new Drink('Water glas', 2, 'plat/bruis', 'Drink', 'Soft', true),
            new Drink('Water fles', 6, 'plat/bruis', 'Drink', 'Soft', true),
            new Drink('Lungo', 2.7, null, 'Drink', 'Warme Drank', true),
            new Drink('Cappuccino', 3.5, null, 'Drink', 'Warme Drank', true),
            new Drink('Latte Macchiato', 4.5, null, 'Drink', 'Warme Drank', true),
            new Drink('Thee', 4, null, 'Drink', 'Warme Drank', true),
            ];

        $foods = [
            new Food('ALL-INCLUSIVE', 53, 'Buffet + koffie, water, thee, home made ice tea + 1/2e bubbles', 'High Tea', true),
            new Food('THAI', 17, 'Lauwe rundvleessalade, mihoen, pikante dipsaus', 'Sharing Food', true),
            new Food('KIP', 15, 'Spies van krokante kipfilet, mangochutney', 'Sharing Food', true),
            new Food('ALBONDIGAS', 15, 'Spaanse gehaktballetjes, wiskeysaus', 'Sharing Food', true),
            new Food('RIB', 18, 'Gemarineerde, BBQ, peterseliepesto', 'Sharing Food', true),
            new Food('BURRATA', 15, 'Gebrande Italiaanse zachte kaas, pistache, croutons', 'Sharing Food', true),
            new Food('CAMEMBERT', 15, 'Uit de oven, chimichurri, stokbrood, jalapeño', 'Sharing Food', true),
            new Food('CALAMARES', 15, 'Gebakken inktvisringen, verse tartaar', 'Sharing Food', true),
            new Food('CEVICHE', 17, 'Zeewolf, zoete aardappel, lookbrood', 'Sharing Food', true),
            new Food('SCAMPI', 19, 'Kokos, rum, citroengras', 'Sharing Food', true),
            new Food('GENTSE PLANK', 25, 'Vlees en kazen, Tierenteyn', 'Sharing Food', true),
            new Food('LIBANESE PLANK', 25, 'Hummus, baba ganoush, libanees brood', 'Sharing Food', true),
            new Food('ZOETE PLANK', 22, 'Mix van zoetigheden', 'Sharing Food', true),
            new Food('HEET IJS', 9, 'Gepaneerd, speculoos, gefrituurd', 'Sharing Food', true),
            new Food('NACHO', 17, 'Pikante salsa, zure room, advocado, jalapeño', 'Sharing Food', true),
            ];
        $drinks = collect($drinks)
            ->filter(function ($drink) {
                return $drink->getActive();
            })
            ->partition(function ($drink) {
                return $drink->getSubkind() !== 'Wijn';
            })
            ->map(function ($partition) {
                if ($partition->first() && $partition->first()->getSubkind() === 'Wijn') {
                    return $partition->values();
                } else {
                    return $partition->sortBy(function ($drink) {
                        if ($drink->getName() === 'Water glas') {
                            return 1;
                        } elseif ($drink->getName() === 'Water fles') {
                            return 2;
                        } else {
                            return $drink->getPrice();
                        }
                    });
                }
            })
            ->flatten()
            ->all();
        return view('menu', ['foods' => $foods, 'drinks'=>$drinks, 'active' => 'menu']);
    }
}
