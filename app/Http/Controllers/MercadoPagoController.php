<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;

class MercadoPagoController extends Controller
{
    public function showBuyForm()
    {
        $cartItems = Movie::whereIn('movie_id', [5, 7])->get();

        $purchase = Purchase::create([
            'user_fk' => Auth::user()->id,
            'amount' => $cartItems->sum('price')
        ]);

        $purchaseMovie = $cartItems->mapWithKeys( fn ($cartItem) => [
            $cartItem->movie_id => [
                'unit_price' => $cartItem->price,
                'queantity' => 1 //esta hardcodeado por ahora
            ]
        ] );

        $purchase->movies()->attach($purchaseMovie);

        $items = [];

        foreach ($cartItems as $item) {
            $items[] = [
                'title' => $item->title,
                'unit_price' => $item->price,
                'quantity' => 1
            ];
        }

        MercadoPagoConfig::setAccessToken("APP_USR-1307778228459514-061918-e88192edc7174117255fe7b08556f429-2508930020");

        // $backUrls = [
        //     'success' => "http://127.0.0.1:8000/mp/exito",
        //     'failure' => "http://127.0.0.1:8000/mp/exito",
        //     'pending' => "http://127.0.0.1:8000/mp/exito"
        // ];

        $preferenceFactory = new PreferenceClient();
        // try {

            $preference = $preferenceFactory->create([
                'items' => $items,
                // 'back_urls' => $backUrls,
                // "auto_return" => 'approved'
            ]);
        // } catch (\MercadoPago\Exceptions\MPApiException $e) {
        //     $resp = $e->getApiResponse();
        //     dd($resp->getStatusCode(), $resp->getContent());
        // }

        return view('mercadopago.buy-form', compact('cartItems', 'preference'));
    }

    public function success(Request $request)
    {
        // dd($request->query());
        return view('mercadopago.success');
    }

    public function pending(Request $request)
    {
        // dd($request->query());
        return view('mercadopago.pending');
    }

    public function failure(Request $request)
    {
        // dd($request->query());
        return view('mercadopago.failure');
    }
    public function paymentConfirmation($request){
        Log::info(collect($request->input()));
    }
}
