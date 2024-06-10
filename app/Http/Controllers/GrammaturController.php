<?php

namespace App\Http\Controllers;

use App\Models\Grammatur;
use LogicException;
use Illuminate\Http\Request;

class GrammaturController extends Controller
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
        $data = Grammatur::latest()->paginate();

        return view('grammatur.index', [
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
            'grammatur' => 'required',
        ]);

        try {
            Grammatur::create([
                'grammatur' => $request->grammatur,
            ]);

            return redirect(route('grammatur.index'))->with('status', 'Berhasil simpan data!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('status', 'Gagal simpan data! ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Grammatur $grammatur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grammatur $grammatur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Grammatur $grammatur)
    {
        $request->validate([
            'grammatur' => 'required',
        ]);

        try {
            $grammatur->fill([
                'grammatur' => $request->grammatur,
            ])->save();

            return redirect(route('grammatur.index'))->with('status', 'Berhasil ubah data!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('status', 'Gagal ubah data! ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grammatur $grammatur)
    {
        try {
            if (count($grammatur->ukuranKertas) > 0) {
                throw new LogicException("Terdapat ukuran kertas dengan grammatur {$grammatur->grammatur} gram.");
            }

            $grammatur->delete();

            return redirect(route('grammatur.index'))->with('status', 'Berhasil hapus data!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('status', 'Gagal hapus data! ' . $th->getMessage());
        }
    }
}
