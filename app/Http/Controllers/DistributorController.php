<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use Illuminate\Http\Request;
use LogicException;

class DistributorController extends Controller
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
        $data = Distributor::latest()->paginate();

        return view('distributor.index', [
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
            'nama' => 'required|string|max:255',
        ]);

        Distributor::create([
            'nama' => $request->nama,
        ]);

        return redirect(route('distributor.index'))->with('status', 'Berhasil simpan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Distributor $distributor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Distributor $distributor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Distributor $distributor)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $distributor->fill([
            'nama' => $request->nama,
        ])->save();

        return redirect(route('distributor.index'))->with('status', 'Berhasil ubah data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Distributor $distributor)
    {
        try {
            if (count($distributor->detailSuratJalan) > 0) {
                throw new LogicException(
                    sprintf('Terdapat detail surat jalan dengan distributor %s.', $distributor->nama)
                );
            }

            $distributor->delete();

            return redirect(route('distributor.index'))->with('status', 'Hapus data distributor berhasil!');
        } catch (\Throwable $th) {

            return redirect()->back()->with('status', 'Hapus data distributor gagal! ' . $th->getMessage());
        }
    }
}
