<?php

namespace App\Http\Controllers;

use App\Models\DetailSuratJalan;
use App\Models\SuratJalan;
use Illuminate\Http\Request;

class DetailSuratJalanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SuratJalan $suratJalan)
    {
        $data = DetailSuratJalan::with(['buku', 'distributor'])->latest()->paginate();

        return view('detail-surat-jalan.index', [
            'suratJalan' => $suratJalan,
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
    public function show(DetailSuratJalan $detailSuratJalan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetailSuratJalan $detailSuratJalan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DetailSuratJalan $detailSuratJalan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetailSuratJalan $detailSuratJalan)
    {
        //
    }
}
