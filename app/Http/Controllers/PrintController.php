<?php

namespace App\Http\Controllers;

use App\Models\DetailSpk;
use App\Models\NotaPerbaikan;
use App\Models\Retur;
use App\Models\SuratJalan;
use Barryvdh\DomPDF\Facade\Pdf;

class PrintController extends Controller
{
    public function suratJalan(SuratJalan $suratJalan)
    {
        $suratJalan->load(['petugas', 'detail.distributor', 'detail.buku']);

        $pdf = Pdf::loadView('pdf.surat-jalan', [
            'suratJalan' => $suratJalan,
        ]);

        return $pdf->download(sprintf('surat-jalan_%s.pdf', $suratJalan->tanggal));
    }

    public function finishedGoods(DetailSpk $detailSpk)
    {
        $detailSpk->load(['spk', 'buku.detailMaterial']);

        $pdf = Pdf::loadView('pdf.finished-goods', [
            'detailSpk' => $detailSpk,
        ]);

        return $pdf->download(sprintf('finished-goods_%s.pdf', $detailSpk->tanggal));
    }

    public function retur(Retur $retur)
    {
        $retur->load(['detail', 'petugas', 'distributor']);

        $pdf = Pdf::loadView('pdf.retur', [
            'retur' => $retur,
        ]);

        return $pdf->download(sprintf('retur_%s.pdf', $retur->tanggal));
    }

    public function notaPerbaikan(NotaPerbaikan $notaPerbaikan)
    {
        $notaPerbaikan->load(['detail', 'petugas']);

        $pdf = Pdf::loadView('pdf.nota-perbaikan', [
            'notaPerbaikan' => $notaPerbaikan,
        ]);

        return $pdf->download(sprintf('nota-perbaikan_%s.pdf', $notaPerbaikan->tanggal));
    }
}
