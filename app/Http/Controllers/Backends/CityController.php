<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $pagination = $request->has('pagination') ? $request->pagination : 5;


        $cities = City::when($search, function ($cities) use ($search) {
            $cities->where('title', 'like', '%' . $search . '%');
        })->paginate($pagination);

        $cities->appends(['search' => $search]);

        return view('backends.city.index', compact('cities', 'search', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backends.city.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|min:5|max:15',
                'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'title.required' => 'Title wajib diisi!',
                'title.min' => 'Title minimal 1 karakter!',
                'title.max' => 'Title maksimal 15 karakter!',
                'picture.required' => 'Picture wajib diisi!',
                'picture.image' => 'Pictue harus berupa gambar!',
                'picture.mimes' => 'Pictue harus berupa gambar dengan format jpeg,png,jpg,gif,svg!',
                'picture.max' => 'Pictue maksimal 2 Mb',
            ]
        );

        $picture = $request->file('picture');
        $filename = time() . '-' . rand() . '-' . $picture->getClientOriginalName();
        $picture->move(public_path('/img/city'), $filename);

        $status = $request->has('status') ? 'show' : 'hide';

        City::create([
            'title' => $request->title,
            'picture' => $filename,
            'status' => $status,
        ]);

        if($request){
            return redirect()->route('city.index')->with('success', 'Data berhasil ditambakan!');
        } else {
            return redirect()->route('city.index')->with('error', 'Data gagal ditambakan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
        return view('backends.city.edit', compact('city'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, City $city)
    {
        $request->validate(
            [
                'title' => 'required|min:5|max:15',
            ],
            [
                'title.required' => 'Title wajib diisi!',
                'title.min' => 'Title minimal 1 karakter!',
                'title.max' => 'Title maksimal 15 karakter!',
            ]);

        $status = $request->has('status') ? 'show' : 'hide';

        if($request->has('picture'))
        {
            $oldPicture = public_path('/img/city/' . $city->picture);

            if(file_exists($oldPicture)) {
                unlink($oldPicture);
            }

            $picture = $request->file('picture');
            $filename = time() . '-' . rand() . '-' . $picture->getClientOriginalName();
            $picture->move(public_path('/img/city'), $filename);

            City::where('id', $city->id)->update([
                'title' => $request->title,
                'picture' => $filename,
                'status' => $status,
            ]);
        } else {
            City::where('id', $city->id)->update([
                'title' => $request->title,
                'status' => $status,
            ]);
        }

        if($request){
            return redirect()->route('city.index')->with('success', 'Data berhasil ditambahkan!');
        } else {
            return redirect()->route('city.index')->with('error', 'Data gagal ditambahkan!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        if(file_exists(public_path('img/city/' . $city->picture))){
            unlink(public_path('img/city/' . $city->picture));
        }
        City::destroy('id', $city->id);

        return redirect()->route('city.index')->with('success', 'Data berhasil dihapus!');
    }
}
