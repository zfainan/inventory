<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Transaction;
use Illuminate\Http\Request;

class InventoryGudangHasilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Inventory::gudangHasil()->with('buku')->latest()->paginate();

        return view('inventory.hasil.index', [
            'data' => $data
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
        $data = Transaction::with('transactionable')
            ->where('id_inventory', $inventoryHasil->id)
            ->latest()
            ->paginate();

        return view('inventory.hasil.show', [
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
