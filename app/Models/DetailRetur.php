<?php

namespace App\Models;

use App\Jobs\CreateReturTransaction;
use App\Traits\HasTransaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailRetur extends Model
{
    use HasFactory, HasTransaction;

    protected $table = 'detail_retur';

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::created(function(self $detailRetur) {
            dispatch(new CreateReturTransaction($detailRetur));
        });
    }

    public function retur(): BelongsTo
    {
        return $this->belongsTo(Retur::class, 'id_retur');
    }

    public function buku(): BelongsTo
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }
}
