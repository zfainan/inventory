<?php

namespace App\Models;

use App\Jobs\CreateSuratJalanTransaction;
use App\Traits\HasTransaction;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use LogicException;

class DetailSuratJalan extends Model
{
    use HasFactory, HasTransaction;

    protected $table = 'detail_surat_jalan';

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::created(function (self $detailSuratJalan) {
            $detailSuratJalan->load('buku');

            $inventory = Inventory::gudangHasil()
                ->where('id_buku', $detailSuratJalan->id_buku)
                ->first();

            if (! $inventory?->id) {
                throw new LogicException("Buku {$detailSuratJalan->buku->judul} tidak ada dalam inventory gudang hasil.");
            }

            if ($inventory->stok < $detailSuratJalan->qty) {
                throw new LogicException("Stok buku {$detailSuratJalan->buku->judul} kurang dari {$detailSuratJalan->qty}");
            }

            dispatch(new CreateSuratJalanTransaction($detailSuratJalan, $inventory));
        });
    }

    public function tanggal(): Attribute
    {
        return Attribute::make(fn () => $this->created_at->format('Y-m-d H:i'));
    }

    public function suratJalan(): BelongsTo
    {
        return $this->belongsTo(SuratJalan::class, 'id_surat_jalan');
    }

    public function buku(): BelongsTo
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }

    public function distributor(): BelongsTo
    {
        return $this->belongsTo(Distributor::class, 'id_distributor');
    }
}
