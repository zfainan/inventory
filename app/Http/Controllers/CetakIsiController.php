<?php

namespace App\Http\Controllers;

use App\Models\CetakIsi;
use Illuminate\Http\Request;
use LogicException;

class CetakIsiController extends Controller
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
        $data = CetakIsi::latest()->paginate();

        return view('cetak-isi.index', [
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
            'cetak_isi' => 'required',
        ]);

        try {
            CetakIsi::create([
                'cetak_isi' => $request->cetak_isi,
            ]);

            return redirect(route('cetak-isi.index'))->with('status', 'Berhasil simpan data!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('status', 'Gagal simpan data! '.$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CetakIsi $cetakIsi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CetakIsi $cetakIsi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CetakIsi $cetakIsi)
    {
        $request->validate([
            'cetak_isi' => 'required',
        ]);

        try {
            $cetakIsi->fill([
                'cetak_isi' => $request->cetak_isi,
            ])->save();

            return redirect(route('cetak-isi.index'))->with('status', 'Berhasil simpan data!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('status', 'Gagal simpan data! '.$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CetakIsi $cetakIsi)
    {
        try {
            if (count($cetakIsi->detailMaterial) > 0) {
                throw new LogicException("Terdapat detail material dengan cetak isi {$cetakIsi->cetak_isi}."); // NOSONAR
            }

            $cetakIsi->delete();

            return redirect(route('cetak-isi.index'))->with('status', 'Berhasil hapus data!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('status', 'Gagal hapus data! '.$th->getMessage());
        }
    }
}
