<?php

namespace App\Http\Controllers\Frontends;

use App\Models\Bank;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function index()
    {
        $bank = Bank::where('status', 'show')->orderBy('id', 'desc')->limit(3)->get();
        return view('frontends.pembayaran.index', compact('bank'));
    }
}
