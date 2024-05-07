<?php

namespace App\Http\Controllers;

use App\Models\NotaPerbaikan;
use App\Models\Petugas;
use Illuminate\Http\Request;

class NotaPerbaikanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = NotaPerbaikan::with('petugas')->latest()->paginate();
        $petugas = Petugas::latest()->get();

        return view('nota-perbaikan.index', [
            'data' => $data,
            'petugas' => $petugas,
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
            'id_petugas' => 'required',
            'tanggal' => 'required|date',
        ]);

        try {
            NotaPerbaikan::create([
                'id_petugas' => $request->id_petugas,
                'tanggal' => $request->tanggal,
            ]);

            return redirect(route('nota-perbaikan.index'))->with('status', 'Berhasil tambah data!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('status', 'Gagal tambah data! ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(NotaPerbaikan $notaPerbaikan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NotaPerbaikan $notaPerbaikan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NotaPerbaikan $notaPerbaikan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NotaPerbaikan $notaPerbaikan)
    {
        //
    }
}
