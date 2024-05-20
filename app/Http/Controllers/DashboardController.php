<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\DetailNotaPerbaikan;
use App\Models\DetailRetur;
use App\Models\DetailSpk;
use App\Models\DetailSuratJalan;
use App\Models\Inventory;
use App\Models\Retur;
use App\Models\Spk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // Hasil
        $since = $request->input('since', Carbon::now()->subDays(30));
        $until = $request->input('until', Carbon::now());

        $stokGudangHasil = Inventory::gudangHasil()->sum('stok');

        $jumlahSpk = Spk::whereBetween('tanggal_masuk', [$since, $until])->count();

        $targetSpk = Spk::whereBetween('tanggal_masuk', [$since, $until])->sum('oplah_insheet');

        $capaian = DetailSpk::whereHas('spk', function ($querySpk) use ($since, $until) {
            $querySpk->whereBetween('tanggal_masuk', [$since, $until]);
        })
            ->whereBetween('tanggal', [$since, $until])
            ->sum('qty');

        $jumlahPengiriman = DetailSuratJalan::whereHas('suratJalan', function ($querySj) use ($since, $until) {
            $querySj->whereBetween('tanggal', [$since, $until]);
        })
            ->sum('qty');

        $hasilCetak = DetailSpk::whereBetween('tanggal', [$since, $until])
            ->orderBy('tanggal')
            ->groupBy('tanggal')
            ->select('tanggal', DB::raw('sum(qty) as hasil'))
            ->get();

        $pengiriman = DetailSuratJalan::whereBetween('created_at', [$since, $until])
            ->orderBy('created_at')
            ->groupBy('created_at')
            ->select('created_at', DB::raw('sum(qty) as hasil'))
            ->get();

        $penguranganGudangHasil = BarangKeluar::gudangHasil()
            ->whereBetween('created_at', [$since, $until])
            ->get();

        // Retur
        $stokGudangRetur = Inventory::gudangRetur()->sum('stok');

        $jumlahRetur = DetailRetur::whereHas(
            'retur',
            fn ($queryRetur) => $queryRetur->whereBetween('tanggal', [$since, $until])
        )
            ->sum('qty');

        $jumlahNp = DetailNotaPerbaikan::whereHas(
            'notaPerbaikan',
            fn ($queryRetur) => $queryRetur->whereBetween('tanggal', [$since, $until])
        )
            ->sum('qty');

        $jmlPenguranganGudangRetur = BarangKeluar::gudangRetur()
            ->whereBetween('created_at', [$since, $until])
            ->sum('qty');

        $retur = DetailRetur::with('buku')
            ->whereHas(
                'retur',
                fn ($queryRetur) => $queryRetur->whereBetween('tanggal', [$since, $until])
            )
            ->orderByDesc('jml')
            ->groupBy('id_buku')
            ->select('id_buku', DB::raw('sum(qty) as jml'))
            ->get();

        $penguranganGudangRetur = BarangKeluar::gudangRetur()
            ->whereBetween('created_at', [$since, $until])
            ->get();

        return view('dashboard', [
            'stokGudangHasil' => $stokGudangHasil,
            'jumlahSpk' => $jumlahSpk,
            'targetSpk' => $targetSpk,
            'capaian' => $capaian,
            'jumlahPengiriman' => $jumlahPengiriman,
            'hasilCetak' => $hasilCetak,
            'pengiriman' => $pengiriman,
            'penguranganGudangHasil' => $penguranganGudangHasil,
            'stokGudangRetur' => $stokGudangRetur,
            'jumlahRetur' => $jumlahRetur,
            'jumlahNp' => $jumlahNp,
            'jmlPenguranganGudangRetur' => $jmlPenguranganGudangRetur,
            'retur' => $retur,
            'penguranganGudangRetur' => $penguranganGudangRetur,
            'since' => $since instanceof Carbon ? $since->format('Y-m-d') : $since,
            'until' => $until instanceof Carbon ? $until->format('Y-m-d') : $until,
        ]);
    }
}
