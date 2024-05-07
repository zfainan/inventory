<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use App\Models\Petugas;
use App\Models\Retur;
use Illuminate\Http\Request;

class ReturController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Retur::with(['petugas', 'distributor'])->latest()->paginate();
        $distributor = Distributor::latest()->get();
        $petugas = Petugas::latest()->get();

        return view('retur.index', [
            'data' => $data,
            'distributor' => $distributor,
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
            'id_distributor' => 'required',
            'id_petugas' => 'required',
            'tanggal' => 'required|date',
        ]);

        try {
            Retur::create([
                'id_distributor' => $request->id_distributor,
                'id_petugas' => $request->id_petugas,
                'tanggal' => $request->tanggal,
            ]);

            return redirect(route('retur.index'))->with('status', 'Berhasil simpan data!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('status', 'Gagal simpan data! '.$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Retur $retur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Retur $retur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Retur $retur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Retur $retur)
    {
        //
    }
}
