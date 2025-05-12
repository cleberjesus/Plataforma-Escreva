<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssinaturaController extends Controller
{
    public function assinar(Request $request)
    {
        return $request->user()->newSubscription('default', 'price_1RNgrQD6ZyfuoRtMFgZ7zTjs')
            ->checkout([
        'success_url' => route('assinatura.sucesso'),
        'cancel_url' => route('dashboard'),
    ]);

    }
    public function sucesso(Request $request)
{
    $user = $request->user();
    $user->is_premium = true;
    $user->save();

    return redirect()->route('dashboard')->with('status', 'Assinatura Premium ativada com sucesso!');
}

}
