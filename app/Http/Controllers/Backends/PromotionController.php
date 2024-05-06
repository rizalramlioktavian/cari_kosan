<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $pagination = $request->has('pagination') ? $request->pagination : 5;


        $promotions = Promotion::when($search, function ($promotions) use ($search) {
            $promotions->where('title', 'like', '%' . $search . '%');
        })->orderBy('id', 'desc')->paginate($pagination);

        $promotions->appends(['search' => $search]);

        return view('backends.promotion.index', compact('promotions', 'search', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backends.promotion.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|min:5|max:15',
                'discount' => 'required|numeric',
                'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'title.required' => 'Title wajib diisi!',
                'title.min' => 'Title minimal 1 karakter!',
                'title.max' => 'Title maksimal 15 karakter!',
                'discount.required' => 'Discount wajib diisi!',
                'discount.numeric' => 'Discount harus berupa angka!',
                'picture.required' => 'Picture wajib diisi!',
                'picture.image' => 'Pictue harus berupa gambar!',
                'picture.mimes' => 'Pictue harus berupa gambar dengan format jpeg,png,jpg,gif,svg!',
                'picture.max' => 'Pictue maksimal 2 Mb',
            ]
        );

        $picture = $request->file('picture');
        $filename = time() . '-' . rand() . '-' . $picture->getClientOriginalName();
        $picture->move(public_path('/img/promotion'), $filename);

        $status = $request->has('status') ? 'show' : 'hide';

        Promotion::create([
            'title' => $request->title,
            'discount' => $request->discount,
            'picture' => $filename,
            'status' => $status,
        ]);

        if ($request) {
            return redirect()->route('promotion.index')->with('success', 'Data berhasil ditambakan!');
        } else {
            return redirect()->route('promotion.index')->with('error', 'Data gagal ditambakan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Promotion $promotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promotion $promotion)
    {
        return view('backends.promotion.edit', compact('promotion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Promotion $promotion)
    {
        $request->validate(
            [
                'title' => 'required|min:5|max:15',
                'discount' => 'required|numeric',
            ],
            [
                'title.required' => 'Title wajib diisi!',
                'title.min' => 'Title minimal 1 karakter!',
                'title.max' => 'Title maksimal 15 karakter!',
                'discount.required' => 'Discount wajib diisi!',
                'discount.numeric' => 'Discount harus berupa angka!',
            ]
        );

        $status = $request->has('status') ? 'show' : 'hide';

        if ($request->has('picture')) {
            $oldPicture = public_path('/img/promotion/' . $promotion->picture);

            if (file_exists($oldPicture)) {
                unlink($oldPicture);
            }

            $picture = $request->file('picture');
            $filename = time() . '-' . rand() . '-' . $picture->getClientOriginalName();
            $picture->move(public_path('/img/promotion'), $filename);

            Promotion::where('id', $promotion->id)->update([
                'title' => $request->title,
                'discount' => $request->discount,
                'picture' => $filename,
                'status' => $status,
            ]);
        } else {
            Promotion::where('id', $promotion->id)->update([
                'title' => $request->title,
                'discount' => $request->discount,
                'status' => $status,
            ]);
        }

        if ($request) {
            return redirect()->route('promotion.index')->with('success', 'Data berhasil ditambahkan!');
        } else {
            return redirect()->route('promotion.index')->with('error', 'Data gagal ditambahkan!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promotion $promotion)
    {
        if(file_exists(public_path('img/promotion/' . $promotion->picture))){
            unlink(public_path('img/promotion/' . $promotion->picture));
        }
        Promotion::destroy('id', $promotion->id);

        return redirect()->route('promotion.index')->with('success', 'Data berhasil dihapus!');
    }
}
