<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NavigationPageController extends Controller
{
    // routes to the header navigation pages
    public function rewards(){
        return view('navigation_pages/rewards');
    }

    public function enhance(){
        return view('navigation_pages/enhance');
    }

    public function support(){
        return view('navigation_pages/support');
    }

    public function about(){
        return view('navigation_pages/about');
    }
}
