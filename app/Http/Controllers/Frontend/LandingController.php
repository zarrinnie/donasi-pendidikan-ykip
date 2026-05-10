<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class LandingController extends Controller
{
    /**
     * Show the landing page.
     */
    public function index()
    {
        return view('Features.DonationFlow.pages.landing');
    }
}
