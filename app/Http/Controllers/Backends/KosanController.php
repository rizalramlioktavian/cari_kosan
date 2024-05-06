<?php

namespace App\Http\Controllers\Backends;

use App\Models\City;
use App\Models\Kosan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KosanController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index(Request $request)
    {
        $search = $request->search;
        $pagination = $request->has('pagination') ? $request->pagination : 5;


        $kosans = Kosan::with('city')
            ->when($search, function ($kosans) use ($search) {

            $kosans->where('title', 'like', '%' . $search . '%')
            ->orWhereHas('city', function ($city) use ($search) {
              $city->where('title', 'like', '%' . $search . '%');
            });

        })->orderBy('id', 'desc')->paginate($pagination);

        $kosans->appends(['search' => $search]);

        // dd($kosans);

        return view('backends.kosan.index', compact('kosans', 'search', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = City::with('kosan')->get();

        // dd($cities);
        return view('backends.kosan.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'city_id' => 'required',
            'title' => 'required|min:1|max:255',
            'slug'=> 'slug',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric',
            'address' => 'required|min:1|max:255',
            'description' => 'required|max:255',
            'kosan_facility' => 'required|min:1|max:255',
            'public_facility' => 'required|min:1|max:255',
            'other_facility' => 'required|min:1|max:255',


        ]
    );

    $picture = $request->file('picture');
        $filename = time() . '-' . rand() . '-' . $picture->getClientOriginalName();
        $picture->move(public_path('/img/kosan'), $filename);

        $slug = Str::slug($request->title .'-'. City::find($request->city_id)->title);

        Kosan::create([
            'city_id' => $request->city_id,
            'picture' => $filename,
            'title' => $request->title,
            'slug'=> $slug,
            'price' => $request->price,
            'address' => $request->address,
            'description'=> $request->description,
            'kosan_facility' => $request->kosan_facility,
            'public_facility' => $request->public_facility,
            'other_facility' => $request->other_facility
        ]);

        if($request){
            return redirect()->route('kosan.index')->with('success', 'Data berhasil ditambakan!');
        } else {
            return redirect()->route('kosan.index')->with('error', 'Data gagal ditambakan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kosan $kosan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kosan $kosan)
    {
        $cities = City::with('kosan')->get();

        // dd($cities);
        return view('backends.kosan.edit', compact('kosan', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kosan $kosan)
    {
        $request->validate(
            [
                'city_id' => 'required',
            'title' => 'required|min:1|max:255',
            'slug' =>'slug',
            'price' => 'required|numeric',
            'address' => 'required|min:1|max:255',
            'description' => 'required|max:255',
            'kosan_facility' => 'required|min:1|max:255',
            'public_facility' => 'required|min:1|max:255',
            'other_facility' => 'required|min:1|max:255',
        ]);


        if ($request->has('picture')) {
            $oldPicture = public_path('/img/kosan/' . $kosan->picture);

            if (file_exists($oldPicture)) {
                unlink($oldPicture);
            }

            $picture = $request->file('picture');
            $filename = time() . '-' . rand() . '-' . $picture->getClientOriginalName();
            $picture->move(public_path('/img/kosan'), $filename);

            $slug = Str::slug($request->title .'-'. City::find($request->city_id)->title);


            Kosan::where('id', $kosan->id)->update([
            // $kosan->update([
            'city_id' => $request->city_id,
            'picture' => $filename,
            'title' => $request->title,
            'slug' => $slug,
            'price' => $request->price,
            'address' => $request->address,
            'description'=> $request->description,
            'kosan_facility' => $request->kosan_facility,
            'public_facility' => $request->public_facility,
            'other_facility' => $request->other_facility
            ]);
        } else {

            $slug = $kosan->slug;

            if ($request->has('title') || $request->has('city_id')) {
                $slug = Str::slug($request->title .'-'. City::find($request->city_id)->title);
            }

            Kosan::where('id', $kosan->id)->update([
            'city_id' => $request->city_id,
            'title' => $request->title,
            'slug'=> $slug,
            'price' => $request->price,
            'address' => $request->address,
            'description'=> $request->description,
            'kosan_facility' => $request->kosan_facility,
            'public_facility' => $request->public_facility,
            'other_facility' => $request->other_facility
            ]);
        }

        if ($request) {
            return redirect()->route('kosan.index')->with('success', 'Data berhasil ditambahkan!');
        } else {
            return redirect()->route('kosan.index')->with('error', 'Data gagal ditambahkan!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kosan $kosan)
    {
        if(file_exists(public_path('img/kosan/' . $kosan->picture))){
            unlink(public_path('img/kosan/' . $kosan->picture));
        }
        Kosan::destroy('id', $kosan->id);

        return redirect()->route('kosan.index')->with('success', 'Data berhasil dihapus!');
    }
}
