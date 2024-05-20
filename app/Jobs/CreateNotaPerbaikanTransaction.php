<?php

namespace App\Jobs;

use App\Constants\JenisGudang;
use App\Models\DetailNotaPerbaikan;
use App\Models\Gudang;
use App\Models\Inventory;
use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateNotaPerbaikanTransaction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public DetailNotaPerbaikan $detailNp,
        public Inventory $inventory
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $transaction = new Transaction();
        $transaction->inventory()->associate($this->inventory);
        $transaction->transactionable()->associate($this->detailNp);
        $transaction->qty = (0 - $this->detailNp->qty);
        $transaction->save();

        $inventoryGudangHasil = Inventory::firstOrCreate([
            'id_buku' => $this->inventory->id_buku,
            'id_gudang' => Gudang::firstWhere('jenis', JenisGudang::GUDANG_HASIL->value)->id,
        ], [
            'stok' => 0,
        ]);

        $transaction = new Transaction();
        $transaction->inventory()->associate($inventoryGudangHasil);
        $transaction->transactionable()->associate($this->detailNp);
        $transaction->qty = $this->detailNp->qty;
        $transaction->save();
    }
}
