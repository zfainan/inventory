<?php

namespace App\Http\Controllers;

use App\Constants\JenisGudang;
use App\Models\DetailSpk;
use App\Models\Inventory;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryGudangHasilController extends Controller
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
        $data = Inventory::gudangHasil()->with('buku')->latest()->paginate();

        return view('inventory.hasil.index', [
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventoryHasil)
    {
        if ($inventoryHasil->gudang->jenis == JenisGudang::GUDANG_RETUR->value) {
            abort(404);
        }

        $data = Transaction::with('transactionable')
            ->where('id_inventory', $inventoryHasil->id)
            ->latest()
            ->paginate();

        $spk = DetailSpk::with('spk')
            ->whereHas('spk', function ($querySpk) use ($inventoryHasil) {
                $querySpk->where('id_buku', $inventoryHasil->id_buku);
            })
            ->groupBy('id_spk')
            ->select('id_spk', DB::raw('SUM(qty) as jumlah_hasil'))
            ->get();

        return view('inventory.hasil.show', [
            'spk' => $spk,
            'data' => $data,
            'inventory' => $inventoryHasil,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventoryHasil)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventory $inventoryHasil)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventoryHasil)
    {
        //
    }
}
