<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CheckEmailController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $request->validate([
            'email' => ['required', 'email']
        ]);

        $exists = User::where('email', $request->email)->exists();

        return response()->json([
            'exists' => $exists
        ]);
    }
} 