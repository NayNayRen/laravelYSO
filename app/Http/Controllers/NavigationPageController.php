<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NavigationPageController extends Controller
{
    // routes to the header navigation pages
    public function rewards()
    {
        return view('navigation_pages/rewards', [
            'pageTitle' => 'Rewards & Deals'
        ]);
    }

    public function enhance()
    {
        return view('navigation_pages/enhance', [
            'pageTitle' => 'Sales & Revenue'
        ]);
    }

    public function support()
    {
        return view('navigation_pages/support', [
            'pageTitle' => 'Business Support'
        ]);
    }

    public function about()
    {
        return view('navigation_pages/about', [
            'pageTitle' => 'About YSO'
        ]);
    }
}
