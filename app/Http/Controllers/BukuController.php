<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\CetakIsi;
use App\Models\DetailMaterial;
use App\Models\Finishing;
use App\Models\Penerbit;
use App\Models\UkuranBuku;
use App\Models\UkuranKertas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LogicException;

class BukuController extends Controller
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
        $data = Buku::latest()->paginate();

        return view('buku.index', [
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $penerbit = Penerbit::all();
        $ukuranKertas = UkuranKertas::with(['grammatur', 'kertasIsi'])->get();
        $ukuranBuku = UkuranBuku::get();
        $cetakIsi = CetakIsi::get();
        $finishing = Finishing::get();

        return view('buku.create', [
            'penerbit' => $penerbit,
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
            'judul' => 'required|string',
            'isbn' => 'nullable',
            'expired' => 'nullable|date',
            'id_penerbit' => 'required|exists:penerbit,id',
            'id_ukuran_kertas' => 'required|exists:ukuran_kertas,id',
            'id_ukuran_buku' => 'required|exists:ukuran_buku,id',
            'id_cetak_isi' => 'required|exists:cetak_isi,id',
            'id_finishing' => 'required|string|max:255',
        ]);

        try {
            DB::beginTransaction();

            $buku = Buku::create([
                'judul' => $request->judul,
                'id_penerbit' => $request->id_penerbit,
                'isbn' => $request->isbn,
                'expired' => $request->expired,
            ]);

            $ukuranBuku = UkuranBuku::findOrFail($request->id_ukuran_buku);
            $cetakIsi = CetakIsi::findOrFail($request->id_cetak_isi);
            $finishing = Finishing::findOrFail($request->id_finishing);
            $ukuranKertas = UkuranKertas::findOrFail($request->id_ukuran_kertas)
                ->load(['grammatur', 'kertasIsi']);

            $detailMaterial = new DetailMaterial();
            $detailMaterial->buku()->associate($buku);
            $detailMaterial->ukuranKertas()->associate($ukuranKertas);
            $detailMaterial->ukuranBuku()->associate($ukuranBuku);
            $detailMaterial->cetakIsi()->associate($cetakIsi);
            $detailMaterial->finishing()->associate($finishing);
            $detailMaterial->save();

            DB::commit();

            return redirect(route('buku.index'))->with('status', 'Berhasil input data buku!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('status', 'Input data buku gagal! '.$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Buku $buku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Buku $buku)
    {
        $penerbit = Penerbit::all();
        $ukuranKertas = UkuranKertas::with(['grammatur', 'kertasIsi'])->get();
        $ukuranBuku = UkuranBuku::get();
        $cetakIsi = CetakIsi::get();
        $finishing = Finishing::get();

        return view('buku.edit', [
            'buku' => $buku,
            'penerbit' => $penerbit,
            'ukuranKertas' => $ukuranKertas,
            'ukuranBuku' => $ukuranBuku,
            'cetakIsi' => $cetakIsi,
            'finishing' => $finishing,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'judul' => 'required|string',
            'isbn' => 'nullable',
            'expired' => 'nullable|date',
            'id_penerbit' => 'required|exists:penerbit,id',
            'id_ukuran_kertas' => 'required|exists:ukuran_kertas,id',
            'id_ukuran_buku' => 'required|exists:ukuran_buku,id',
            'id_cetak_isi' => 'required|exists:cetak_isi,id',
            'id_finishing' => 'required|string|max:255',
        ]);

        try {
            DB::beginTransaction();

            $buku->fill([
                'judul' => $request->judul,
                'id_penerbit' => $request->id_penerbit,
                'isbn' => $request->isbn,
                'expired' => $request->expired,
            ])->save();

            $ukuranBuku = UkuranBuku::findOrFail($request->id_ukuran_buku);
            $cetakIsi = CetakIsi::findOrFail($request->id_cetak_isi);
            $finishing = Finishing::findOrFail($request->id_finishing);
            $ukuranKertas = UkuranKertas::findOrFail($request->id_ukuran_kertas)
                ->load(['grammatur', 'kertasIsi']);

            $detailMaterial = $buku->detailMaterial;
            $detailMaterial->buku()->associate($buku);
            $detailMaterial->ukuranKertas()->associate($ukuranKertas);
            $detailMaterial->ukuranBuku()->associate($ukuranBuku);
            $detailMaterial->cetakIsi()->associate($cetakIsi);
            $detailMaterial->finishing()->associate($finishing);
            $detailMaterial->save();

            DB::commit();

            return redirect(route('buku.index'))->with('status', 'Berhasil ubah data buku!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('status', 'Ubah data buku gagal! '.$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buku $buku)
    {
        try {
            if (count($buku->spk) > 0) {
                throw new LogicException('Buku telah memiliki SPK.');
            }

            DB::beginTransaction();

            $buku->detailMaterial->delete();
            $buku->delete();

            DB::commit();

            return redirect(route('buku.index'))->with('status', 'Hapus data buku berhasil!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('status', 'Hapus data buku gagal! '.$th->getMessage());
        }
    }
}
