<?php

namespace App\Http\Controllers\Frontends;

use App\Models\City;
use App\Models\Ruang;
use App\Models\Kosan;
use App\Models\Order;
use App\Models\Lokasi;
use App\Models\Rating;
use App\Models\Promotion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $pagination = $request->has('pagination') ? $request->pagination : 4;

        $kosans = Kosan::with('city')
            ->when($search, function ($kosans) use ($search) {
                $kosans->where('title', 'like', '%' . $search . '%')
                    ->orWhereHas('city', function ($city) use ($search) {
                        $city->where('title', 'like', '%' . $search . '%');
                    });
            })->orderBy('id', 'asc')->paginate($pagination);

        $kosans->appends(['search' => $search]);

        return view('frontends.lokasi.index', compact('kosans', 'search', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function detail($slug)
    {
        $kosan = Kosan::with('city')->where('slug', $slug)->first();

        // cek apakah kosan ada
        if (!$kosan) {
            return redirect()->back()->with('error', 'Kosan tidak ditemukan!');
        }

        // rating count
        $rating = Rating::whereHas('kosann', function ($query) use ($kosan) {
            $query->where('kosan_id', $kosan->id);
        })->get();

        // rating sum
        $rating_sum = Rating::whereHas('kosan', function ($query) use ($kosan) {
            $query->where('kosan_id', $kosan->id);
        })->sum('stars_rated');

        // user rating - stars_rated
        $user_rating = null; // kenapa nul, karena jka user belum login, maka tidak bisa memberikan rating
        if ($kosan && Auth::user()) {
            $user_rating = Rating::where('kosan_id', $kosan->id)->where('user_id', Auth::user()->id)->first();
        }

        // rating sum - raitng count
        if ($rating->count() > 0) {
            $rating_count = $rating_sum / $rating->count();
        } else {
            $rating_count = 0;
        }

        $order_count = Order::whereHas('ruangRuang', function ($ruangRuang) use ($kosan) {
            $ruangRuang->where('kosan_id', $kosan->id);
        })->where('status', 'success')->count();



        // dd($kosann);

        return view('frontends.booking.detail', compact('kosan', 'user_rating', 'rating', 'rating_count', 'order_count'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function ruangRuang($slug)
    {
        $kosan = Kosan::with('city')->where('slug', $slug)->first();

        // cek apakah kosan ada
        if (!$kosan) {
            return redirect()->back()->with('error', 'Kosan tidak ditemukan!');
        }

        $ruangRuang = Ruang::where('kosan_id', $kosan->id)->get();
        $city = City::where('id', $kosan->city_id)->get();

        // dd($kosan, $ruangRuang, $city);

        return view('frontends.lokasi.ruangRuang', compact('kosan', 'ruangRuang', 'city'));
    }

    public function order( $slug, $slug_ruangRuang)
    {
        $kosan = Kosan::with('city')->where('slug', $slug)->first();
        $ruangRuang = Ruang::where('slug', $slug_ruangRuang)->first();

        // cek apakah kosan atau kamar ada
        if (!$kosan || !$ruangRuang) {
            return redirect()->back()->with('error', 'Kosan atau Kamar tidak ditemukan!');
        }

        // dd($kosan, $ruangRuang, $promotion);

        return view('frontends.lokasi.order', compact('kosan', 'ruangRuang', 'promotion'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|min:1|max:255',
                'phone' => 'required|numeric',
                'email' => 'required|email',
                'payment_method' => 'required',
                'check_in' => 'required|date|after_or_equal:today',
                'check_out' => 'required|date|after:check_in',
                'total_nights' => 'required|numeric|in:' . (strtotime($request->check_out) - strtotime($request->check_in)) / 86400, // 1 day = 86400 seconds
            ],
            [
                'name.required' => 'Nama tidak boleh kosong!',
                'name.min' => 'Nama minimal 1 karakter!',
                'name.max' => 'Nama maksimal 255 karakter!',
                'phone.required' => 'Nomor telepon tidak boleh kosong!',
                'phone.numeric' => 'Nomor telepon harus berupa angka!',
                'email.required' => 'Email tidak boleh kosong!',
                'email.email' => 'Email tidak valid!',
                'payment_method.required' => 'Pilih metode pembayaran terlebih dahulu!',
                'check_in.required' => 'Tanggal check in tidak boleh kosong!',
                'check_in.date' => 'Tanggal check in tidak valid!',
                'check_in.after_or_equal' => 'Tanggal check in tidak boleh kurang dari hari ini!',
                'check_out.required' => 'Tanggal check out tidak boleh kosong!',
                'check_out.date' => 'Tanggal check out tidak valid!',
                'check_out.after' => 'Tanggal check out tidak boleh kurang dari tanggal check in!',
                'total_nights.required' => 'Total malam tidak boleh kosong!',
                'total_nights.numeric' => 'Total malam harus berupa angka!',
                'total_nights.in' => 'Total malam tidak valid!',
            ]
        );

        // Check In
        $request->merge(['check_in' => date('Y-m-d', strtotime($request->check_in)) . ' 14:00:00']);

        // Check Out
        $request->merge(['check_out' => date('Y-m-d', strtotime($request->check_out)) . ' 14:00:00']);

        // Total harga setelah diskon slug_ruangRuang
        $promo = Promotion::where('id', $request->promo_id)->first();
        $discount = $promo ? $promo->discount : 0;
        // $ruangRuang = Ruang::where('id', $request->ruangRuang_id)->first();
        $ruangRuang = Ruang::where('slug', $request->slug_ruangRuang)->first();
        $total_price = ($request->total_nights * $ruangRuang->price) * (100 - $discount) / 100;

        // Insert data order
        Order::create([
            'user_id' => Auth::user()->id,
            // 'ruangRuang_id' => $request->ruangRuang_id,
            'ruangRuang_id' => $ruangRuang->id, // ruangRuang id diganti dengan slug_ruangRuang
            'promo_id' => $request->promo_id ? $request->promo_id : 0,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'payment_method' => $request->payment_method,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'total_nights' => $request->total_nights,
            'total_price' => $total_price,
        ]);

        // Redirect
        if ($request) {
            return redirect()->route('pembayaran.index')->with('success1', 'Lokasi Kosan')->with('success2', 'Telah')->with('success3', 'Berhasil!');
        } else {
            return redirect()->route('lokasi.order')->with('error', 'Data lokasi gagal ditambahkan!');
        }
    }
}
