<?php

namespace App\Http\Controllers\Backends;

use App\Models\City;
use App\Models\Kosan;
use App\Models\Ruang;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RuangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $pagination = $request->has('pagination') ? $request->pagination : 5;


        $ruangs = Ruang::when($search, function ($ruangs) use ($search) {
            $ruangs->where('title', 'like', '%' . $search . '%');
        })->orderBy('id', 'desc')->paginate($pagination);

        $ruangs->appends(['search' => $search]);

        return view('backends.ruang.index', compact('ruangs', 'search', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kosans = Kosan::with('ruang')->get();
        // dd($kosans);
        return view('backends.ruang.create', compact('kosans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kosan_id' => 'required',
            'title' => 'required|min:1|max:50',
            'picture' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric',
            'total_ruang'=> 'required|numeric',
            'ruang_facility' => 'required|min:1|max:255',
        ],

        [
            'kosan_id.required' => 'Kosan wajib diisi',
            'title.required' => 'Title wajib diisi',
            'title.min' => 'Title minimal 1 karakter',
            'title.max' => 'Title maksimal 50 karakter',
            'picture.required' => 'Picture wajib diisi',
            'picture.image' => 'Picture harus berupa gambar',
            'picture.mimes' => 'Picture harus berupa jpeg,png,jpg,gif,svg',
            'picture.max' => 'Picture maksimal 2 MB',
            'price.required' => 'Price wajib diisi',
            'price.numeric' => 'Price harus berupa angka',
            'total_ruang.required' => 'Total Ruang wajib diisi',
            'total_ruang.numeric' => 'Total Ruang harus berupa angka',
            'ruang_facility.required' => 'Ruang Facility wajib diisi',
        ]
        );

        $picture = $request->file('picture');
        $filename = time() . '-' . rand() . '-' . $picture->getClientOriginalName();
        $picture->move(public_path('/img/ruang'), $filename);

        $slug = Str::slug($request->title .'-'. Kosan::find( $request->kosan_id)->title .'-'. City::where('id', Kosan::find( $request->kosan_id)->city_id)->first()->title);

        Ruang::create([
            'kosan_id' => $request->kosan_id,
            'picture' => $filename,
            'title' => $request->title,
            'slug'=> $slug,
            'price' => $request->price,
            'total_ruang' => $request->total_ruang,
            'ruang_facility' => $request->ruang_facility,
        ]);

        if ($request) {
            return redirect()->route('ruang.index')->with('success', 'Data Berhasil Ditambahkan');
        } else {
            return redirect()->route('ruang.create')->with('error','Data Gagal Ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Ruang $ruang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ruang $ruang)
    {
        $kosans = Kosan::with('ruang')->get();

        // dd($cities);
        return view('backends.ruang.edit', compact('ruang', 'kosans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ruang $ruang)
    {
        $request->validate([
            'kosan_id' => 'required',
            'title' => 'required|min:1|max:50',
            'picture' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric',
            'total_ruang'=> 'required|numeric',
            'ruang_facility' => 'required|min:1|max:255',
        ],

        [
            'kosan_id.required' => 'Kosan wajib diisi',
            'title.required' => 'Title wajib diisi',
            'title.min' => 'Title minimal 1 karakter',
            'title.max' => 'Title maksimal 50 karakter',
            'picture.image' => 'Picture harus berupa gambar',
            'picture.mimes' => 'Picture harus berupa jpeg,png,jpg,gif,svg',
            'picture.max' => 'Picture maksimal 2 MB',
            'price.required' => 'Price wajib diisi',
            'price.numeric' => 'Price harus berupa angka',
            'total_ruang.required' => 'Total Ruang wajib diisi',
            'total_ruang.numeric' => 'Total Ruang harus berupa angka',
            'ruang_facility.required' => 'Ruang Facility wajib diisi',
        ]
        );

        if ($request->has('picture')) {
            $old_picture = public_path('/img/ruang/' . $ruang->picture);
            if (file_exists($old_picture)) {
                unlink($old_picture);
            }
            $picture = $request->file('picture');
            $filename = time() . '-' . rand() . '-' . $picture->getClientOriginalName();
            $picture->move(public_path('/img/ruang'), $filename);

            $slug = Str::slug($request->title .'-'. Kosan::find( $request->kosan_id)->title .'-'. City::where('id', Kosan::find( $request->kosan_id)->city_id)->first()->title);

            $ruang->update([
                'kosan_id' => $request->kosan_id,
                'picture' => $filename,
                'title' => $request->title,
                'slug'=> $slug,
                'price' => $request->price,
                'total_ruang' => $request->total_ruang,
                'ruang_facility' => $request->ruang_facility,
            ]);
        } else {
            $slug =$ruang->slug;

            if ($request->has('title') || $request->has('kosan_id' || $request->has('city_id'))) {
                $slug = Str::slug($request->title .'-'. Kosan::find( $request->kosan_id)->title .'-'. City::where('id', Kosan::find( $request->kosan_id)->city_id)->first()->title);

            }

            $ruang->update([
                'kosan_id' => $request->kosan_id,
                'title' => $request->title,
                'slug'=> $slug,
                'price' => $request->price,
                'total_ruang' => $request->total_ruang,
                'ruang_facility' => $request->ruang_facility,
            ]);
        }

        if ($request) {
            return redirect()->route('ruang.index')->with('success', 'Data Berhasil Diubah');
        } else {
            return redirect()->route('ruang.edit')->with('error','Data Gagal Diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ruang $ruang)
    {
        if (file_exists(public_path('/img/ruang/' . $ruang->picture))) {
            unlink(public_path('/img/ruang/' . $ruang->picture));
        }
        $ruang->destroy('id', $ruang->id);

        return redirect()->route('ruang.index')->with('success', 'Data Berhasil Dihapus');
    }
}
