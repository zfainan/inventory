<?php

namespace App\Http\Controllers;

use App\Models\DetailSpk;
use App\Models\Spk;
use Illuminate\Http\Request;

class FinishedGoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DetailSpk::latest()->paginate();

        return view('finished-good.index', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $spk = Spk::with(['buku.penerbit'])->latest()->paginate();

        return view('finished-good.create', [
            'spk' => $spk,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_spk' => 'exists:spk,id',
            'tanggal' => 'required|date',
            'qty' => 'required|numeric|min:0',
        ]);

        try {
            $spk = Spk::findOrFail($request->id_spk);
            $stok = $spk->detailSpk?->sum('stok');

            $detailSpk = new DetailSpk();
            $detailSpk->fill([
                'id_spk' => $request->id_spk,
                'id_buku' => $spk->id_buku,
                'qty' => $request->qty,
                'tanggal' => $request->tanggal,
                'stok' => $stok + $request->qty,
            ]);
            $detailSpk->save();

            return redirect(route('finished-goods.index'))->with('status', 'Input data berhasil!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('status', 'Input data gagal! ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DetailSpk $detailSpk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetailSpk $detailSpk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DetailSpk $detailSpk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetailSpk $detailSpk)
    {
        //
    }
}