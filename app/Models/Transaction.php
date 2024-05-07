<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Transaction extends Model
{
    use HasFactory;

    protected static function booted(): void
    {
        static::created(function (self $transaction) {
            $transaction->inventory->update([
                'stok' => $transaction->inventory->stok + $transaction->qty,
            ]);
        });
    }

    public function transactionable(): MorphTo
    {
        return $this->morphTo();
    }

    public function inventory(): BelongsTo
    {
        return $this->belongsTo(Inventory::class, 'id_inventory');
    }
}
