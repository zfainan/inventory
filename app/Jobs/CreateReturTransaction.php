<?php

namespace App\Jobs;

use App\Constants\JenisGudang;
use App\Models\DetailRetur;
use App\Models\Gudang;
use App\Models\Inventory;
use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateReturTransaction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public DetailRetur $detailRetur
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $inventory = Inventory::firstOrCreate([
            'id_buku' => $this->detailRetur->id_buku,
            'id_gudang' => Gudang::firstWhere('jenis', JenisGudang::GUDANG_RETUR->value)->id,
        ], [
            'stok' => 0
        ]);

        $transaction = new Transaction();
        $transaction->inventory()->associate($inventory);
        $transaction->transactionable()->associate($this->detailRetur);
        $transaction->qty = $this->detailRetur->qty;
        $transaction->save();
    }
}
