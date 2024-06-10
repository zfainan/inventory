<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\DetailRetur;
use App\Models\Retur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailReturController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Petugas Gudang Retur')->except(['index']);
        $this->middleware('role:Petugas Gudang Retur|Manager')->only(['index']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Retur $retur)
    {
        $retur->load(['distributor', 'petugas']);

        $data = DetailRetur::with(['buku'])
            ->where('id_retur', $retur->id)
            ->latest()
            ->paginate();
        $buku = Buku::latest()->get();

        return view('detail-retur.index', [
            'data' => $data,
            'buku' => $buku,
            'retur' => $retur,
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
    public function store(Request $request, Retur $retur)
    {
        $request->validate([
            'id_buku' => 'required',
            'qty' => 'required',
        ]);

        try {
            DB::beginTransaction();

            DetailRetur::create([
                'id_retur' => $retur->id,
                'id_buku' => $request->id_buku,
                'qty' => $request->qty,
            ]);

            DB::commit();

            return redirect(route('retur.detail.index', $retur))->with('status', 'Berhasil tambah data!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('status', 'Gagal tambah data! '.$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DetailRetur $detailRetur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetailRetur $detailRetur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DetailRetur $detailRetur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetailRetur $detailRetur)
    {
        //
    }
}
