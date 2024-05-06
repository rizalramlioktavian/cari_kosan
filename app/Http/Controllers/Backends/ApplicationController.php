<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $pagination = $request->has('pagination') ? $request->pagination : 5;


        $applications = Application::when($search, function ($applications) use ($search) {
            $applications->where('title', 'like', '%' . $search . '%');
        })->orderBy('id', 'desc')->paginate($pagination);

        $applications->appends(['search' => $search]);

        return view('backends.application.index', compact('applications', 'search', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backends.application.create');
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
        $picture->move(public_path('/img/application'), $filename);

        $status = $request->has('status') ? 'show' : 'hide';

        Application::create([
            'title' => $request->title,
            'description' => $request->description,
            'picture' => $filename,
            'status' => $status,
        ]);

        if ($request) {
            return redirect()->route('application.index')->with('success', 'Data berhasil ditambakan!');
        } else {
            return redirect()->route('application.index')->with('error', 'Data gagal ditambakan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Application $application)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application)
    {
        Return view('backends.application.edit', compact('application'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application)
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
            $oldPicture = public_path('/img/application/' . $application->picture);

            if (file_exists($oldPicture)) {
                unlink($oldPicture);
            }

            $picture = $request->file('picture');
            $filename = time() . '-' . rand() . '-' . $picture->getClientOriginalName();
            $picture->move(public_path('/img/application'), $filename);

            Application::where('id', $application->id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'picture' => $filename,
                'status' => $status,
            ]);
        } else {
            Application::where('id', $application->id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'status' => $status,
            ]);
        }

        if ($request) {
            return redirect()->route('application.index')->with('success', 'Data berhasil ditambahkan!');
        } else {
            return redirect()->route('application.index')->with('error', 'Data gagal ditambahkan!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        if(file_exists(public_path('img/application/' . $application->picture))){
            unlink(public_path('img/application/' . $application->picture));
        }
        Application::destroy('id', $application->id);

        return redirect()->route('application.index')->with('success', 'Data berhasil dihapus!');
    }
}
