<?php

namespace App\Jobs;

use App\Constants\JenisGudang;
use App\Models\DetailSuratJalan;
use App\Models\Gudang;
use App\Models\Inventory;
use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateSuratJalanTransaction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public DetailSuratJalan $detailSj,
        public Inventory $inventory,
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $transaction = new Transaction();
        $transaction->inventory()->associate($this->inventory);
        $transaction->transactionable()->associate($this->detailSj);
        $transaction->qty = (0 - $this->detailSj->qty);
        $transaction->save();
    }
}
