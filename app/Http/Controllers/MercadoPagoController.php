<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;

class MercadoPagoController extends Controller
{
    public function showBuyForm()
    {
        $cartItems = Movie::whereIn( 'movie_id', [5, 11] )->get();

        $items = [];

        foreach( $cartItems as $item ){
            $items[] = [
                'title' => $item->title,
                'unit_price' => $item->price,
                'quantity' => 1
            ];
        }

        MercadoPagoConfig::setAccessToken("APP_USR-1307778228459514-061918-e88192edc7174117255fe7b08556f429-2508930020");

        $preferenceFactory = new PreferenceClient();
        $preference = $preferenceFactory->create([
            'items' => $items
        ]);

        return view('mercadopago.buy-form', compact('cartItems', 'preference'));
    }
}
