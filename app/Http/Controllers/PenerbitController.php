<?php

namespace App\Http\Controllers;

use App\Models\Penerbit;
use Illuminate\Http\Request;

class PenerbitController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Petugas Gudang Hasil');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Penerbit::latest()->paginate();

        return view('penerbit.index', [
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'penerbit' => 'required',
        ]);

        Penerbit::create([
            'penerbit' => $request->penerbit,
        ]);

        return redirect(route('penerbit.index'))->with('status', 'Berhasil simpan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penerbit $penerbit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penerbit $penerbit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penerbit $penerbit)
    {
        $request->validate([
            'penerbit' => 'required',
        ]);

        $penerbit->fill([
            'penerbit' => $request->penerbit,
        ])->save();

        return redirect(route('penerbit.index'))->with('status', 'Berhasil ubah data penerbit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penerbit $penerbit)
    {
        try {
            $penerbit->delete();

            return redirect(route('penerbit.index'))->with('status', 'Hapus data penerbit berhasil!');
        } catch (\Throwable $th) {

            return redirect()->back()->with('status', 'Hapus data penerbit gagal! ' . $th->getMessage());
        }
    }
}
