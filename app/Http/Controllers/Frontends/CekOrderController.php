<?php

namespace App\Http\Controllers\Frontends;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CekOrderController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $pagination = $request->input('pagination', 5);

        $orders = Order::with('ruang.kosan', 'promotion')
            ->where('user_id', Auth::user()->id)
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('phone', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%')
                        ->orWhere('payment_method', 'like', '%' . $search . '%')
                        ->orWhereHas('ruang.kosan', function ($kosan) use ($search) {
                            $kosan->where('title', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('ruang', function ($ruang) use ($search) {
                            $ruang->where('title', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('promotion', function ($promo) use ($search) {
                            $promo->where('title', 'like', '%' . $search . '%');
                        });
                });
            })
            ->orderBy('id', 'desc')
            ->paginate($pagination);

        $orders->appends(['search' => $search, 'pagination' => $pagination]);

        return view('frontends.CekOrder.index', compact('orders', 'search', 'pagination'));
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();

        if ($order) {
            return redirect()->route('cekOrder.index')->with('success', 'Data booking berhasil dihapus!');
        } else {
            return redirect()->route('cekOrder.index')->with('error', 'Data booking gagal dihapus!');
        }
    }
}
