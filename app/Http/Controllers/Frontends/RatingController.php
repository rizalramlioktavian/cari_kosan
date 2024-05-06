<?php

namespace App\Http\Controllers\Frontends;

use App\Models\Kosan;
use App\Models\Order;
use App\Models\Rating;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request)
    {

        $stars_rated = $request->input('kosan_rating');

        $kosan_id = $request->kosan_id;

        $kosan_check = Kosan::where('id', $kosan_id)->first();

        if ($kosan_check)
        {
            $verified_booking = Order::where('orders.user_id', Auth::user()->id)
                ->join('ruangs', 'orders.ruang_id', '=', 'ruangs.id')
                ->join('kosans', 'ruangs.kosan_id', '=', 'kosans.id')
                ->where('kosans.id', $kosan_id)
                ->where('orders.status', 'success')
                ->get();

            if ($verified_booking->count() > 0)
            {
                $existing_rating = Rating::where('user_id', Auth::user()->id)
                    ->where('kosan_id', $kosan_id)
                    ->first();
                if ($existing_rating)
                {
                    $existing_rating->stars_rated = $stars_rated;
                    $existing_rating->comment = $request->comment;
                    $existing_rating->update();
                } else {
                    Rating::create([
                        'user_id' => Auth::user()->id,
                        'kosan_id' => $kosan_id,
                        'stars_rated' => $stars_rated,
                        'comment' => $request->comment
                    ]);
                }
                return redirect()->back()->with('success', 'Terimakasih telah memberikan rating.');
            } else {
                $booking_status = Order::where('orders.user_id', Auth::user()->id)
                    ->join('ruangs', 'orders.ruang_id', '=', 'ruangs.id')
                    ->join('kosans', 'ruangs.kosan_id', '=', 'kosans.id')
                    ->where('kosans.id', $kosan_id)
                    ->value('orders.status');

                if ($booking_status == 'process') {
                    return redirect()->back()->with('error', 'Anda belum bisa memberikan rating. Harap segera melakukan pembayaran agar bisa memberikan rating!');
                } else {
                    return redirect()->back()->with('error', 'Anda belum melakukan booking kamar pada kosan ini. Tidak bisa memberikan rating!');
                }
            }
        } else {
            return redirect()->back()->with('error', 'Kosan tidak ditemukan!');
        }
    }
}

