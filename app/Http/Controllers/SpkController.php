<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\CetakIsi;
use App\Models\DetailMaterial;
use App\Models\Finishing;
use App\Models\Grammatur;
use App\Models\KertasIsi;
use App\Models\Spk;
use App\Models\UkuranBuku;
use App\Models\UkuranKertas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Spk::with(['detailMaterial', 'buku.penerbit'])->latest()->paginate();

        return view('spk.index', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $books = Buku::get();
        $ukuranKertas = UkuranKertas::with(['grammatur', 'kertasIsi'])->get();
        $ukuranBuku = UkuranBuku::get();
        $cetakIsi = CetakIsi::get();
        $finishing = Finishing::get();

        return view('spk.create', [
            'books' => $books,
            'ukuranKertas' => $ukuranKertas,
            'ukuranBuku' => $ukuranBuku,
            'cetakIsi' => $cetakIsi,
            'finishing' => $finishing,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_buku' => 'required|exists:buku,id',
            'id_ukuran_kertas' => 'required|exists:ukuran_kertas,id',
            'id_ukuran_buku' => 'required|exists:ukuran_buku,id',
            'id_cetak_isi' => 'required|exists:cetak_isi,id',
            'id_finishing' => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'tanggal_keluar' => 'required|date|after:tanggal_masuk',
            'oplah_dasar' => 'required|numeric|min:1',
            'oplah_insheet' => 'required|numeric|min:1',
        ]);

        try {
            DB::beginTransaction();

            $spk = new Spk();
            $spk->fill([
                'id_buku' => $request->id_buku,
                'tanggal_masuk' => $request->tanggal_masuk,
                'tanggal_keluar' => $request->tanggal_keluar,
                'oplah_dasar' => $request->oplah_dasar,
                'oplah_insheet' => $request->oplah_insheet,
                'nomor_spk' => sprintf('SPK-%d', (Spk::latest()->first()?->id ?? 0) + 1),
            ]);
            $spk->save();
            $spk->refresh();

            $ukuranBuku = UkuranBuku::findOrFail($request->id_ukuran_buku);
            $cetakIsi = CetakIsi::findOrFail($request->id_cetak_isi);
            $finishing = Finishing::findOrFail($request->id_finishing);
            $ukuranKertas = UkuranKertas::findOrFail($request->id_ukuran_kertas)
                ?->load(['grammatur', 'kertasIsi']);

            $detailMaterial = new DetailMaterial();
            $detailMaterial->spk()->associate($spk);
            $detailMaterial->ukuranKertas()->associate($ukuranKertas);
            $detailMaterial->ukuranBuku()->associate($ukuranBuku);
            $detailMaterial->cetakIsi()->associate($cetakIsi);
            $detailMaterial->finishing()->associate($finishing);
            $detailMaterial->save();

            DB::commit();

            return redirect(route('spk.index'))->with('status', 'Input data SPK berhasil!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('status', 'Input data SPK gagal! ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Spk $spk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Spk $spk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Spk $spk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Spk $spk)
    {
        //
    }
}
