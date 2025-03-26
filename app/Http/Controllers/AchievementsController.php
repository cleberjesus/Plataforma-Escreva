<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AchievementsController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $achievements = $user->achievements;
        return view('achievements.index', compact('achievements'));
    }
}
