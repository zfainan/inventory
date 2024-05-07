<?php

namespace App\Traits;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasTransaction
{
    public function transaction(): MorphOne
    {
        return $this->morphOne(
            Transaction::class,
            'transactionable',
        );
    }
}
