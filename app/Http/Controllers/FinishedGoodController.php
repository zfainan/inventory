<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\DetailSpk;
use App\Models\Spk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinishedGoodController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Petugas Gudang Hasil');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Buku::with('penerbit')->whereHas('hasilCetak')->latest();

        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where('judul', 'like', "%{$keyword}%");
        }

        $data = $query->paginate();

        return view('finished-good.index', [
            'data' => $data,
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
            DB::beginTransaction();

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

            DB::commit();

            return redirect(route('finished-goods.index'))->with('status', 'Input data berhasil!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('status', 'Input data gagal! ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Buku $buku)
    {
        $query = DetailSpk::with('spk')->where('id_buku', $buku->id)->latest();

        if ($request->filled('since') && $request->filled('until')) {
            $query->whereBetween('tanggal', [
                $request->since, $request->until,
            ]);
        }

        $data = $query->paginate();

        return view('finished-good.show', [
            'data' => $data,
            'buku' => $buku,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetailSpk $finishedGood)
    {
        $spk = Spk::with(['buku.penerbit'])->latest()->paginate();

        return view('finished-good.edit', [
            'spk' => $spk,
            'detailSpk' => $finishedGood,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DetailSpk $finishedGood)
    {
        $request->validate([
            'id_spk' => 'exists:spk,id',
            'tanggal' => 'required|date',
            'qty' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            $spk = Spk::findOrFail($request->id_spk);
            $stok = $spk->detailSpk?->sum('stok');

            $finishedGood->fill([
                'id_spk' => $request->id_spk,
                'id_buku' => $spk->id_buku,
                'qty' => $request->qty,
                'tanggal' => $request->tanggal,
                'stok' => $stok + $request->qty,
            ]);
            $finishedGood->save();

            DB::commit();

            return redirect(route('finished-goods.show', $finishedGood->id_buku))
                ->with('status', 'Ubah data berhasil!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('status', 'Ubah data gagal! ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetailSpk $finishedGood)
    {
        //
    }
}
