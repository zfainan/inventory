<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\Inventory;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenguranganStokGudangHasilController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'id_inventory' => 'required|exists:inventories,id',
            'deskripsi' => 'required',
            'qty' => 'numeric|required|min:1',
        ]);

        try {
            DB::beginTransaction();

            $inventory = Inventory::gudangHasil()->findOrFail($request->id_inventory);

            if ($inventory->stok < $request->qty) {
                throw new Exception("Stok buku kurang dari {$request->qty}."); // NOSONAR
            }

            $barangKeluar = BarangKeluar::create([
                'id_buku' => $inventory->id_buku,
                'id_gudang' => $inventory->id_gudang,
                'deskripsi' => $request->deskripsi,
                'qty' => $request->qty,
            ]);

            $transaction = new Transaction();
            $transaction->inventory()->associate($inventory);
            $transaction->transactionable()->associate($barangKeluar);
            $transaction->qty = (0 - $barangKeluar->qty);
            $transaction->save();

            DB::commit();

            return redirect()->back()->with('status', 'Berhasil mengurangi stok!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('status', 'Gagal mengurangi stok! '.$th->getMessage());
        }
    }
}
