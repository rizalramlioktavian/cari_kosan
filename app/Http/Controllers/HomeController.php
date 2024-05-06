<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Hero;
use App\Models\Kosan;
use App\Models\Order;
use App\Models\Promotion;
use App\Models\Application;
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

    //  Show the application dashboard.
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

    public function adminhome()
    {
        $jumlahOrder = Order::count();
        $totalPendapatan = Order::where('status', 'success')->sum('total_price');
        $jumlahProcess = Order::where('status','process')->count();
        $jumlahSuccess = Order::where('status','success')->count();
        return view('backends.home.index', compact('jumlahOrder','totalPendapatan','jumlahProcess','jumlahSuccess'));
    }
}
