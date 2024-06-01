<?php

namespace App\Http\Controllers;

use App\Constants\JenisGudang;
use App\Models\Inventory;
use App\Models\Transaction;
use Illuminate\Http\Request;

class InventoryGudangReturController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Petugas Gudang Retur')->except(['index', 'show']);
        $this->middleware('role:Petugas Gudang Retur|Manager')->only(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Inventory::gudangRetur()->with('buku')->latest()->paginate();

        return view('inventory.retur.index', [
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
    public function show(Inventory $inventoryRetur)
    {
        if ($inventoryRetur->gudang->jenis == JenisGudang::GUDANG_HASIL->value) {
            abort(404);
        }

        $data = Transaction::with('transactionable')
            ->where('id_inventory', $inventoryRetur->id)
            ->latest()
            ->paginate();

        return view('inventory.retur.show', [
            'data' => $data,
            'inventory' => $inventoryRetur,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventoryRetur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventory $inventoryRetur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventoryRetur)
    {
        //
    }
}
