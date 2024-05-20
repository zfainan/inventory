<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Spk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpkController extends Controller
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
        $data = Spk::with(['buku.penerbit'])->latest()->paginate();

        return view('spk.index', [
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $books = Buku::get();

        return view('spk.create', [
            'books' => $books,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_buku' => 'required|exists:buku,id',
            'tanggal_masuk' => 'required|date',
            'tanggal_keluar' => 'required|date|after:tanggal_masuk',
            'oplah_dasar' => 'required|numeric|min:1',
            'oplah_insheet' => 'required|numeric|min:1',
        ]);

        try {
            DB::beginTransaction();

            Spk::create([
                'id_buku' => $request->id_buku,
                'tanggal_masuk' => $request->tanggal_masuk,
                'tanggal_keluar' => $request->tanggal_keluar,
                'oplah_dasar' => $request->oplah_dasar,
                'oplah_insheet' => $request->oplah_insheet,
                'nomor_spk' => sprintf('SPK-%d', (Spk::latest()->first()?->id ?? 0) + 1),
            ]);

            DB::commit();

            return redirect(route('spk.index'))->with('status', 'Input data SPK berhasil!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('status', 'Input data SPK gagal! '.$th->getMessage());
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
