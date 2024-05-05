<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\DetailSuratJalan;
use App\Models\Distributor;
use App\Models\SuratJalan;
use Illuminate\Http\Request;

class DetailSuratJalanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SuratJalan $suratJalan)
    {
        $data = DetailSuratJalan::with(['buku', 'distributor'])->latest()->paginate();
        $buku = Buku::with(['penerbit'])->get();
        $distributor = Distributor::get();

        return view('detail-surat-jalan.index', [
            'data' => $data,
            'suratJalan' => $suratJalan,
            'buku' => $buku,
            'distributor' => $distributor,
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
    public function store(Request $request, SuratJalan $suratJalan)
    {
        $request->validate([
            'id_buku' => 'required|exists:buku,id',
            'id_distributor' => 'required|exists:distributor,id',
            'qty' => 'required|numeric|min:1',
        ]);

        try {
            DetailSuratJalan::create([
                'id_surat_jalan' => $suratJalan->id,
                'id_buku' => $request->id_buku,
                'id_distributor' => $request->id_distributor,
                'qty' => $request->qty,
            ]);

            return redirect(route('surat-jalan.detail.index', $suratJalan))->with('status', 'Tambah data berhasil!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('status', 'Tambah data gagal! ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DetailSuratJalan $detailSuratJalan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetailSuratJalan $detailSuratJalan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DetailSuratJalan $detailSuratJalan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetailSuratJalan $detailSuratJalan)
    {
        //
    }
}
