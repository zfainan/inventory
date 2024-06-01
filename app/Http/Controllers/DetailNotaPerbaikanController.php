<?php

namespace App\Http\Controllers;

use App\Models\DetailNotaPerbaikan;
use App\Models\DetailRetur;
use App\Models\NotaPerbaikan;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailNotaPerbaikanController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Petugas Gudang Retur')->except(['index']);
        $this->middleware('role:Petugas Gudang Retur|Manager')->only(['index']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(NotaPerbaikan $notaPerbaikan)
    {
        $notaPerbaikan->load(['petugas']);

        $data = DetailNotaPerbaikan::where('id_nota_perbaikan', $notaPerbaikan->id)
            ->latest()
            ->paginate();
        $petugas = Petugas::all();
        $detailRetur = DetailRetur::with(['buku'])->latest()->get();

        return view('detail-nota-perbaikan.index', [
            'data' => $data,
            'notaPerbaikan' => $notaPerbaikan,
            'petugas' => $petugas,
            'detailRetur' => $detailRetur,
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
    public function store(Request $request, NotaPerbaikan $notaPerbaikan)
    {
        $request->validate([
            'id_petugas' => 'required|exists:petugas,id',
            'id_detail_retur' => 'required|exists:detail_retur,id',
            'status' => 'required|string|max:255',
            'qty' => 'required|numeric|min:1',
        ]);

        try {
            DB::beginTransaction();

            DetailNotaPerbaikan::create([
                'id_nota_perbaikan' => $notaPerbaikan->id,
                'id_petugas' => $request->id_petugas,
                'id_detail_retur' => $request->id_detail_retur,
                'status' => $request->status,
                'qty' => $request->qty,
            ]);

            DB::commit();

            return redirect(route('nota-perbaikan.detail.index', $notaPerbaikan))->with('status', 'Berhasil tambah data!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('status', 'Gagal tambah data! '.$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DetailNotaPerbaikan $detailNotaPerbaikan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetailNotaPerbaikan $detailNotaPerbaikan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DetailNotaPerbaikan $detailNotaPerbaikan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetailNotaPerbaikan $detailNotaPerbaikan)
    {
        //
    }
}
