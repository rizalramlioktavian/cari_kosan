<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $pagination = $request->has('pagination') ? $request->pagination : 5;


        $heroes = Hero::when($search, function ($heroes) use ($search) {
            $heroes->where('title', 'like', '%' . $search . '%');
        })->orderBy('id', 'desc')->paginate($pagination);

        $heroes->appends(['search' => $search]);

        return view('backends.hero.index', compact('heroes', 'search', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backends.hero.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|min:5|max:255',
                'description' => 'required',
                'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'title.required' => 'Title wajib diisi!',
                'title.min' => 'Title minimal 1 karakter!',
                'title.max' => 'Title maksimal 255 karakter!',
                'description.required' => 'Description wajib diisi!',
                'picture.required' => 'Picture wajib diisi!',
                'picture.image' => 'Pictue harus berupa gambar!',
                'picture.mimes' => 'Pictue harus berupa gambar dengan format jpeg,png,jpg,gif,svg!',
                'picture.max' => 'Pictue maksimal 2 Mb',
            ]
        );

        $picture = $request->file('picture');
        $filename = time() . '-' . rand() . '-' . $picture->getClientOriginalName();
        $picture->move(public_path('/img/hero'), $filename);

        $status = $request->has('status') ? 'show' : 'hide';

        Hero::create([
            'title' => $request->title,
            'description' => $request->description,
            'picture' => $filename,
            'status' => $status,
        ]);

        if ($request) {
            return redirect()->route('hero.index')->with('success', 'Data berhasil ditambakan!');
        } else {
            return redirect()->route('hero.index')->with('error', 'Data gagal ditambakan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Hero $hero)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hero $hero)
    {
        Return view('backends.hero.edit', compact('hero'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hero $hero)
    {
        $request->validate(
            [
                'title' => 'required|min:5|max:255',
                'description' => 'required',
            ],
            [
                'title.required' => 'Title wajib diisi!',
                'title.min' => 'Title minimal 1 karakter!',
                'title.max' => 'Title maksimal 255 karakter!',
                'description.required' => 'Description wajib diisi!',
            ]
        );

        $status = $request->has('status') ? 'show' : 'hide';

        if ($request->has('picture')) {
            $oldPicture = public_path('/img/hero/' . $hero->picture);

            if (file_exists($oldPicture)) {
                unlink($oldPicture);
            }

            $picture = $request->file('picture');
            $filename = time() . '-' . rand() . '-' . $picture->getClientOriginalName();
            $picture->move(public_path('/img/hero'), $filename);

            Hero::where('id', $hero->id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'picture' => $filename,
                'status' => $status,
            ]);
        } else {
            Hero::where('id', $hero->id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'status' => $status,
            ]);
        }

        if ($request) {
            return redirect()->route('hero.index')->with('success', 'Data berhasil ditambahkan!');
        } else {
            return redirect()->route('hero.index')->with('error', 'Data gagal ditambahkan!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hero $hero)
    {
        {
            if(file_exists(public_path('img/hero/' . $hero->picture))){
                unlink(public_path('img/hero/' . $hero->picture));
            }
            Hero::destroy('id', $hero->id);

            return redirect()->route('hero.index')->with('success', 'Data berhasil dihapus!');
        }
    }
}
