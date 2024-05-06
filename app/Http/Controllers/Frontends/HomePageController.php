<?php

namespace App\Http\Controllers\Frontends;

use App\Models\City;
use App\Models\Hero;
use App\Models\Kosan;
use App\Models\Promotion;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomePageController extends Controller
{
    public function index()
    {
        // hero
        $heroes = Hero::where('status', 'show')->orderBy('id', 'desc')->limit(1)->get();
        // kosan
        $kosans = Kosan::with('city')->orderBy('id', 'asc')->limit(4)->get();
        // cities
        $cities = City::where('status', 'show')->orderBy('id', 'asc')->limit(4)->get();
        // promotion
        $promotions = Promotion::where('status', 'show')->orderBy('id', 'desc')->limit(1)->get();
        // application
        $applications = Application::where('status', 'show')->orderBy('id', 'desc')->limit(1)->get();

        // dd($heroes, $kosans, $cities, $promotions, $applications);

        return view('frontends.home.index', compact('heroes', 'kosans', 'cities', 'promotions', 'applications'));
    }
}
