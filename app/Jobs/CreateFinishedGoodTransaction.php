<?php

namespace App\Jobs;

use App\Constants\JenisGudang;
use App\Models\DetailSpk;
use App\Models\Gudang;
use App\Models\Inventory;
use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateFinishedGoodTransaction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public DetailSpk $detailSpk
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $inventory = Inventory::firstOrCreate([
            'id_buku' => $this->detailSpk->id_buku,
            'id_gudang' => Gudang::firstWhere('jenis', JenisGudang::GUDANG_HASIL->value)->id,
        ], [
            'stok' => 0,
        ]);

        $transaction = new Transaction();
        $transaction->inventory()->associate($inventory);
        $transaction->transactionable()->associate($this->detailSpk);
        $transaction->qty = $this->detailSpk->qty;
        $transaction->save();
    }
}
