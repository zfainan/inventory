<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use App\Models\Petugas;
use App\Models\SuratJalan;
use Illuminate\Http\Request;

class SuratJalanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = SuratJalan::latest()->paginate();

        return view('surat-jalan.index', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Petugas::all();

        return view('surat-jalan.create', [
            'employees' => $employees
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'id_petugas' => 'required|exists:petugas,id',
        ]);

        try {
            SuratJalan::create([
                'tanggal' => $request->tanggal,
                'id_petugas' => $request->id_petugas,
            ]);

            return redirect(route('surat-jalan.index'))->with('status', 'Surat jalan berhasil dibuat!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('status', 'Surat jalan gagal dibuat! ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SuratJalan $suratJalan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuratJalan $suratJalan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SuratJalan $suratJalan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuratJalan $suratJalan)
    {
        //
    }
}
