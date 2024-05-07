<?php

namespace App\Http\Controllers;

use App\Models\UkuranBuku;
use Exception;
use Illuminate\Http\Request;

class UkuranBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = UkuranBuku::latest()->paginate();

        return view('ukuran-buku.index', [
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
            'ukuran_buku' => 'required',
        ]);

        try {
            UkuranBuku::create([
                'ukuran_buku' => $request->ukuran_buku,
            ]);

            return redirect(route('ukuran-buku.index'))->with('status', 'Berhasil simpan data!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('status', 'Gagal simpan data! '.$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(UkuranBuku $ukuranBuku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UkuranBuku $ukuranBuku)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UkuranBuku $ukuranBuku)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UkuranBuku $ukuranBuku)
    {
        try {
            if (count($ukuranBuku->detailMaterial) > 0) {
                throw new Exception("Terdapat detail material dengan ukuran buku {$ukuranBuku->ukuran_buku}."); // NOSONAR
            }

            $ukuranBuku->delete();

            return redirect(route('ukuran-buku.index'))->with('status', 'Berhasil hapus data!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('status', 'Gagal hapus data! '.$th->getMessage());
        }
    }
}
