<?php

namespace App\Jobs;

use App\Models\DetailSpk;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateFinishedGoodTransaction implements ShouldQueue
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
        $this->detailSpk->transaction->update([
            'qty' => $this->detailSpk->qty
        ]);
    }
}
