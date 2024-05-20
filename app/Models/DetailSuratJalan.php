<?php

namespace App\Models;

use App\Constants\JenisGudang;
use App\Jobs\CreateSuratJalanTransaction;
use App\Traits\HasTransaction;
use Exception;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailSuratJalan extends Model
{
    use HasFactory, HasTransaction;

    protected $table = 'detail_surat_jalan';

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::created(function (self $detailSuratJalan) {
            $inventory = Inventory::where('id_buku', $detailSuratJalan->id_buku)
                ->where('id_gudang', Gudang::firstWhere('jenis', JenisGudang::GUDANG_HASIL->value)->id)
                ->firstOrFail();

            if ($inventory->stok < $detailSuratJalan->qty) {
                throw new Exception("Stok buku kurang dari {$detailSuratJalan->qty}"); // NOSONAR
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
