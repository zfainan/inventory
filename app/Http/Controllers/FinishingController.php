<?php

namespace App\Http\Controllers;

use App\Models\Finishing;
use Illuminate\Http\Request;
use LogicException;

class FinishingController extends Controller
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
        $data = Finishing::latest()->paginate();

        return view('finishing.index', [
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
        $request->validate([
            'finishing' => 'required',
        ]);

        try {
            Finishing::create([
                'finishing' => $request->finishing,
            ]);

            return redirect(route('finishing.index'))->with('status', 'Berhasil simpan data!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('status', 'Gagal simpan data! '.$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Finishing $finishing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Finishing $finishing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Finishing $finishing)
    {
        $request->validate([
            'finishing' => 'required',
        ]);

        try {
            $finishing->fill([
                'finishing' => $request->finishing,
            ])->save();

            return redirect(route('finishing.index'))->with('status', 'Berhasil simpan data!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('status', 'Gagal simpan data! '.$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Finishing $finishing)
    {
        try {
            if (count($finishing->detailMaterial) > 0) {
                throw new LogicException("Terdapat detail material dengan finishing {$finishing->cetak_isi}.");
            }

            $finishing->delete();

            return redirect(route('finishing.index'))->with('status', 'Berhasil hapus data!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('status', 'Gagal hapus data! '.$th->getMessage());
        }
    }
}
