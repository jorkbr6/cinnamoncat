<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('home', [
            'welcomeMessage' => 'Your cozy garden is ready for another lovely visit.',
        ]);
    }
}
