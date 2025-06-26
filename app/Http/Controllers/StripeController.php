<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function checkout()
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'mode' => 'subscription',
            'line_items' => [[
                'price' => 'price_1RNgrQD6ZyfuoRtMFgZ7zTjs', // <- aqui vai seu ID
                'quantity' => 1,
            ]],
            'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.cancel'),
            'customer_email' => auth()->user()->email,
        ]);

        return redirect($session->url);
    }
}
