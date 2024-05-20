<?php

namespace App\Models;

use App\Constants\JenisGudang;
use App\Jobs\CreateNotaPerbaikanTransaction;
use App\Traits\HasTransaction;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailNotaPerbaikan extends Model
{
    use HasFactory, HasTransaction;

    protected $table = 'detail_nota_perbaikan';

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::created(function (self $detailNp) {
            $inventory = Inventory::where('id_buku', $detailNp->detaiRetur->id_buku)
                ->where('id_gudang', Gudang::firstWhere('jenis', JenisGudang::GUDANG_RETUR->value)->id)
                ->firstOrFail();

            if ($inventory->stok < $detailNp->qty) {
                throw new Exception("Stok buku kurang dari {$detailNp->qty}."); // NOSONAR
            }

            dispatch(new CreateNotaPerbaikanTransaction($detailNp, $inventory));
        });
    }

    public function notaPerbaikan(): BelongsTo
    {
        return $this->belongsTo(NotaPerbaikan::class, 'id_nota_perbaikan');
    }

    public function detaiRetur(): BelongsTo
    {
        return $this->belongsTo(DetailRetur::class, 'id_detail_retur');
    }

    public function petugas(): BelongsTo
    {
        return $this->belongsTo(Petugas::class, 'id_petugas');
    }
}
