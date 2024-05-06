<?php

namespace App\Http\Controllers\Backends;

use App\Models\City;
use App\Models\Ruang;
use App\Models\User;
use App\Models\Order;
use App\Models\Promotion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = request()->search;
        $pagination = request()->has('pagination') ? request()->pagination : 5;

        $orders = Order::when($search, function ($query) use ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        })->orderBy('id', 'desc')->paginate($pagination);

        $orders->appends(['search' => $search]);
        return view('backends.order.index', compact('orders', 'search', 'pagination'));
    }

    public function status(Order $order)
    {
        if ($order->status == 'process') {
            $order->where('id', $order->id)->update(['status' => 'success']);

            return redirect()->back()->with('success', 'Status order An. <strong style="color: blue;">' . Auth::user()->name . '</strong> berhasil di update.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::with('order')->get();
        $ruangs = Ruang::with('order')->get();
        $promotions = Promotion::with('order')->get();
        return view('backends.order.create', compact('users', 'ruangs', 'promotions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'ruang_id' => 'required',
                'name' => 'required|min:1|max:255',
                'phone' => 'required|numeric',
                'email' => 'required|email',
                'payment_method' => 'required',
                'check_in' => 'required|date|after_or_equal:today',
                'check_out' => 'required|date|after:check_in',
                'total_nights' => 'required|numeric|in:' . (strtotime($request->check_out) - strtotime($request->check_in)) / 86400, // 1 day = 86400 seconds
            ],
            [
                'ruang_id.required' => 'Pilih kamar terlebih dahulu!',
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
        // $request->merge(['check_in' => date('Y-m-d H:i:s', strtotime($request->check_in))]);
        $request->merge(['check_in' => date('Y-m-d', strtotime($request->check_out)) . ' 14:00:00']);

        // Check Out
        $request->merge(['check_out' => date('Y-m-d', strtotime($request->check_out)) . ' 14:00:00']);

        // Total harga setelah diskon
        $promo = Promotion::where('id', $request->promo_id)->first();
        $discount = $promo ? $promo->discount : 0;
        $ruang = Ruang::where('id', $request->ruang_id)->first();

        $total_price = ($request->total_nights * $ruang->price) * (100 - $discount) / 100;

        // Insert data order
        Order::create([
            'user_id' => Auth::user()->id,
            'ruang_id' => $request->ruang_id,
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
            return redirect()->route('order.index')->with('success', 'Data order An. <strong style="color: blue;">' . Auth::user()->name . '</strong> berhasil ditambahkan!');
        } else {
            return redirect()->route('order.create')->with('error', 'Data order An. <strong style="color: blue;">' . Auth::user()->name . '</strong> gagal ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        Order::destroy($order->id);
        return redirect()->back()->with('success', 'Status order An. <strong style="color: blue;">' . Auth::user()->name . '</strong> berhasil di hapus.');
    }
}
