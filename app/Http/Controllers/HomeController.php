<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('fronts.welcome');
    }

    public function about()
    {
        return view('fronts.about');
    }

    public function bus()
    {
        return view('fronts.bus');
    }

    public function hotel()
    {
        return view('fronts.hotel');
    }

    public function contact()
    {
        return view('fronts.contact');
    }
}
