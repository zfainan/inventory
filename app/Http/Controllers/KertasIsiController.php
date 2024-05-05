<?php

namespace App\Http\Controllers;

use App\Models\KertasIsi;
use Exception;
use Illuminate\Http\Request;

class KertasIsiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = KertasIsi::latest()->paginate();

        return view('kertas-isi.index', [
            'data' => $data
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
            'kertas_isi' => 'required'
        ]);

        try {
            KertasIsi::create([
                'kertas_isi' => $request->kertas_isi
            ]);

            return redirect(route('kertas-isi.index'))->with('status', 'Berhasil simpan data!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('status', 'Gagal simpan data! ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(KertasIsi $kertasIsi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KertasIsi $kertasIsi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KertasIsi $kertasIsi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KertasIsi $kertasIsi)
    {
        try {
            if (count($kertasIsi->ukuranKertas) > 0) {
                throw new Exception("Terdapat ukuran kertas dengan kertas isi {$kertasIsi->kertas_isi}."); // NOSONAR
            }

            $kertasIsi->delete();

            return redirect(route('kertas-isi.index'))->with('status', 'Berhasil hapus data!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('status', 'Gagal hapus data! ' . $th->getMessage());
        }
    }
}
