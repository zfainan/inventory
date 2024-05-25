<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\DetailSuratJalan;
use App\Models\Distributor;
use App\Models\Petugas;
use App\Models\SuratJalan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuratJalanController extends Controller
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
        $data = SuratJalan::with('detail.distributor', 'detail.buku')->latest()->paginate();

        return view('surat-jalan.index', [
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Petugas::all();
        $buku = Buku::gudangHasil()->with(['penerbit'])->get();
        $distributor = Distributor::get();

        return view('surat-jalan.create', [
            'employees' => $employees,
            'buku' => $buku,
            'distributor' => $distributor,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'id_petugas' => 'required|exists:petugas,id',
            'detail' => 'required|array',
            'detail.*.id_distributor' => 'required|exists:distributor,id',
            'detail.*.id_buku' => 'required|exists:buku,id',
            'detail.*.qty' => 'required|numeric|min:1',
        ]);

        try {
            DB::beginTransaction();

            $suratJalan = SuratJalan::create([
                'tanggal' => $request->tanggal,
                'id_petugas' => $request->id_petugas,
            ]);

            collect($request->detail)->each(function ($item) use ($suratJalan) {
                DetailSuratJalan::create([
                    'id_surat_jalan' => $suratJalan->id,
                    'id_distributor' => $item['id_distributor'],
                    'id_buku' => $item['id_buku'],
                    'qty' => $item['qty'],
                ]);
            });

            DB::commit();

            return redirect(route('surat-jalan.index'))->with('status', 'Surat jalan berhasil dibuat!');
        } catch (\Throwable $th) {
            DB::rollback();

            return redirect()->back()->with('status', 'Surat jalan gagal dibuat! '.$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SuratJalan $suratJalan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuratJalan $suratJalan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SuratJalan $suratJalan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuratJalan $suratJalan)
    {
        //
    }
}
