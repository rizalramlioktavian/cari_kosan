<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $pagination = $request->has('pagination') ? $request->pagination : 5;


        $banks = Bank::when($search, function ($banks) use ($search) {
            $banks->where('title', 'like', '%' . $search . '%');
        })->orderBy('id', 'desc')->paginate($pagination);

        $banks->appends(['search' => $search]);

        return view('backends.bank.index', compact('banks', 'search', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backends.bank.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'bank_name' => 'required|min:1|max:255',
                'bank_account_number' => 'required|numeric',
                'account_name'=> 'required|min:5|max:255',
                'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'bank_name.required' => 'nama bank wajib diisi!',
                'bank_name.min' => 'Nama bank minimal 1 karakter!',
                'bank_name.max' => 'Nama bank maksimal 255 karakter!',
                'bank_account_number.required' => 'Nomor rekening Tidak Boleh Kosong!',
                'bank_account_number.numeric' => 'Nomor Rekening Harus Angka!',
                'account_name.required' => 'nama tidak boleh kosong',
                'account_name.min' => 'nama minimal 1 huruf',
                'account_name.max' => 'nama maksimal 255 huruf',
                'picture.required' => 'Picture wajib diisi!',
                'picture.image' => 'Pictue harus berupa gambar!',
                'picture.mimes' => 'Pictue harus berupa gambar dengan format jpeg,png,jpg,gif,svg!',
                'picture.max' => 'Pictue maksimal 2 Mb',
            ]
        );

        $picture = $request->file('picture');
        $filename = time() . '-' . rand() . '-' . $picture->getClientOriginalName();
        $picture->move(public_path('/img/bank'), $filename);

        $status = $request->has('status') ? 'show' : 'hide';

        Bank::create([
            'bank_name' => $request->bank_name,
            'bank_account_number' => $request->bank_account_number,
            'account_name'=> $request->account_name,
            'picture' => $filename,
            'status' => $status,
        ]);

        if ($request) {
            return redirect()->route('bank.index')->with('success', 'Data berhasil ditambakan!');
        } else {
            return redirect()->route('bank.index')->with('error', 'Data gagal ditambakan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Bank $bank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bank $bank)
    {
        return view('backends.bank.edit', compact('bank'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bank $bank)
    {
        $request->validate(
            [
                'bank_name' => 'required|min:1|max:255',
                'bank_account_number' => 'required|numeric',
                'account_name'=> 'required|min:5|max:255',
            ],
            [
                'bank_name.required' => 'nama bank wajib diisi!',
                'bank_name.min' => 'Nama bank minimal 1 karakter!',
                'bank_name.max' => 'Nama bank maksimal 255 karakter!',
                'bank_account_number.required' => 'Nomor rekening Tidak Boleh Kosong!',
                'bank_account_number.numeric' => 'Nomor Rekening Harus Angka!',
                'account_name.required' => 'nama tidak boleh kosong',
                'account_name.min' => 'nama minimal 1 huruf',
                'account_name.max' => 'nama maksimal 255 huruf',
            ]
        );
        $status = $request->has('status') ? 'show' : 'hide';

        if ($request->has('picture')) {
            $oldPicture = public_path('/img/bank/' . $bank->picture);

            if (file_exists($oldPicture)) {
                unlink($oldPicture);
            }

        $picture = $request->file('picture');
        $filename = time() . '-' . rand() . '-' . $picture->getClientOriginalName();
        $picture->move(public_path('/img/bank'), $filename);


        Bank::where('id', $bank->id)->update([
            'bank_name' => $request->bank_name,
            'bank_account_number' => $request->bank_account_number,
            'account_name'=> $request->account_name,
            'picture' => $filename,
            'status' => $status,
        ]);
    } else {
        Bank::where('id', $bank->id)->update([
            'bank_name' => $request->bank_name,
            'bank_account_number' => $request->bank_account_number,
            'account_name'=> $request->account_name,
            'status' => $status,
        ]);
    }


        if ($request) {
            return redirect()->route('bank.index')->with('success', 'Data berhasil ditambakan!');
        } else {
            return redirect()->route('bank.index')->with('error', 'Data gagal ditambakan!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bank $bank)
    {
        if (file_exists(public_path('/img/bank/' . $bank->picture))) {
            unlink(public_path('/img/bank/' . $bank->picture));
        }
        $bank->destroy('id', $bank->id);

        return redirect()->route('bank.index')->with('success', 'Data Berhasil Dihapus');
    }
}
