<?php

namespace App\Models;

use App\Jobs\CreateFinishedGoodTransaction;
use App\Jobs\UpdateFinishedGoodTransaction;
use App\Traits\HasTransaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use LogicException;

class DetailSpk extends Model
{
    use HasFactory, HasTransaction;

    protected $table = 'detail_spk';

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::created(function (self $detailSpk) {
            dispatch(new CreateFinishedGoodTransaction($detailSpk));
        });

        static::updated(function (self $detailSpk) {
            $inventory = $detailSpk->transaction->inventory;

            $newQty = $detailSpk->qty;
            $oldQty = $detailSpk->transaction->qty;

            $inventory->refresh();

            $newStock = $inventory->stok + ($newQty - $oldQty);

            info([
                'inventory' => $inventory->stok,
                'new' => $newQty,
                'old' => $oldQty,
                'new inventory' => $newStock,
            ]);

            if ($newStock < 0) {
                throw new LogicException(
                    sprintf(
                        'Gagal mengurangi jumlah hasil cetak karena stok buku %s tersisa %s!',
                        $inventory->buku->judul,
                        $inventory->stok
                    )
                );
            }

            dispatch(new UpdateFinishedGoodTransaction($detailSpk));
        });
    }

    public function spk(): BelongsTo
    {
        return $this->belongsTo(Spk::class, 'id_spk');
    }

    public function buku(): BelongsTo
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }
}
