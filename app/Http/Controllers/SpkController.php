<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Spk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LogicException;

class SpkController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Petugas Gudang Hasil')->except(['index']);
        $this->middleware('role:Petugas Gudang Hasil|Manager')->only(['index']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            'since' => 'required_with:until|date',
            'until' => 'required_with:since|date',
            'keyword' => 'nullable',
        ]);

        $query = Spk::with(['buku.penerbit']);

        if ($request->filled('since') && $request->filled('until')) {
            $query->whereBetween('tanggal_masuk', [
                $request->since, $request->until,
            ]);
        }

        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');

            $query->whereHas('buku', function ($queryBuku) use ($keyword) {
                $queryBuku->where('judul', 'like', "%$keyword%");
            })
                ->orWhere('nomor_spk', 'like', "%$keyword%");
        }

        $data = $query->latest()->paginate();

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

            return redirect()->back()->with('status', 'Input data SPK gagal! ' . $th->getMessage());
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
        $books = Buku::get();

        return view('spk.edit', [
            'spk' => $spk,
            'books' => $books,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Spk $spk)
    {
        $request->validate([
            'id_buku' => 'required|numeric|exists:buku,id',
            'tanggal_masuk' => 'required|date',
            'tanggal_keluar' => 'required|date|after:tanggal_masuk',
            'oplah_dasar' => 'required|numeric|min:1',
            'oplah_insheet' => 'required|numeric|min:1',
        ]);

        try {
            DB::beginTransaction();

            if ($request->get('id_buku') != $spk->id_buku && count($spk->detailSpk) > 0) {
                throw new LogicException('Tidak bisa mengubah buku pada SPK yang sudah memiliki hasil cetak.');
            }

            $spk->fill([
                'id_buku' => $request->id_buku,
                'tanggal_masuk' => $request->tanggal_masuk,
                'tanggal_keluar' => $request->tanggal_keluar,
                'oplah_dasar' => $request->oplah_dasar,
                'oplah_insheet' => $request->oplah_insheet,
            ]);

            $spk->save();

            DB::commit();

            return redirect(route('spk.index'))->with('status', 'Ubah data SPK berhasil!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('status', 'Ubah data SPK gagal! ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Spk $spk)
    {
        //
    }
}
