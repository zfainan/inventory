<?php

namespace App\Http\Controllers;

use App\Models\Grammatur;
use App\Models\KertasIsi;
use App\Models\UkuranKertas;
use Illuminate\Http\Request;
use LogicException;

class UkuranKertasController extends Controller
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
        $data = UkuranKertas::with(['grammatur', 'kertasIsi'])->latest()->paginate();
        $grammatur = Grammatur::all();
        $kertasIsi = KertasIsi::all();

        return view('ukuran-kertas.index', [
            'data' => $data,
            'grammatur' => $grammatur,
            'kertasIsi' => $kertasIsi,
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
            'id_grammatur' => 'required',
            'id_kertas_isi' => 'required',
            'ukuran' => 'required',
        ]);

        try {
            UkuranKertas::create([
                'id_grammatur' => $request->id_grammatur,
                'id_kertas_isi' => $request->id_kertas_isi,
                'ukuran' => $request->ukuran,
            ]);

            return redirect(route('ukuran-kertas.index'))->with('status', 'Berhasil simpan data!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('status', 'Gagal simpan data! '.$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(UkuranKertas $ukuranKertas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UkuranKertas $ukuranKertas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UkuranKertas $ukuranKertas)
    {
        $request->validate([
            'id_grammatur' => 'required|exists:grammatur,id',
            'id_kertas_isi' => 'required|exists:kertas_isi,id',
            'ukuran' => 'required',
        ]);

        try {
            $ukuranKertas->fill([
                'id_grammatur' => $request->id_grammatur,
                'id_kertas_isi' => $request->id_kertas_isi,
                'ukuran' => $request->ukuran,
            ])->save();

            return redirect(route('ukuran-kertas.index'))->with('status', 'Berhasil ubah data!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('status', 'Gagal ubah data! '.$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UkuranKertas $ukuranKertas)
    {
        try {
            if (count($ukuranKertas->detailMaterial) > 0) {
                throw new LogicException("Terdapat detail material dengan ukuran kertas {$ukuranKertas->ukuran}.");
            }

            $ukuranKertas->delete();

            return redirect(route('ukuran-kertas.index'))->with('status', 'Berhasil hapus data!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('status', 'Gagal hapus data! '.$th->getMessage());
        }
    }
}
