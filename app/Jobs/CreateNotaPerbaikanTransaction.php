<?php

namespace App\Jobs;

use App\Models\DetailNotaPerbaikan;
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
        public DetailNotaPerbaikan $detailSj,
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
        $transaction->transactionable()->associate($this->detailSj);
        $transaction->qty = (0 - $this->detailSj->qty);
        $transaction->save();
    }
}
