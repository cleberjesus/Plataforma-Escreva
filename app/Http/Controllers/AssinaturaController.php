<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssinaturaController extends Controller
{
    public function assinar(Request $request)
    {
        return $request->user()->newSubscription('default', 'prod_S74DC6gtP1np6l')
            ->checkout([
                'success_url' => route('dashboard') . '?assinatura=sucesso',
                'cancel_url' => route('dashboard'),
            ]);
    }
}
