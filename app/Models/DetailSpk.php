<?php

namespace App\Models;

use App\Jobs\CreateFinishedGoodTransaction;
use App\Traits\HasTransaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailSpk extends Model
{
    use HasFactory, HasTransaction;

    protected static function boot()
    {
        parent::boot();

        static::created(function(self $detailSpk) {
            dispatch(new CreateFinishedGoodTransaction($detailSpk));
        });
    }

    protected $table = 'detail_spk';

    protected $guarded = ['id'];

    public function spk(): BelongsTo
    {
        return $this->belongsTo(Spk::class, 'id_spk');
    }

    public function buku(): BelongsTo
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }
}
