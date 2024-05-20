<?php

namespace App\Models;

use App\Constants\JenisGudang;
use App\Traits\HasTransaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BarangKeluar extends Model
{
    use HasFactory, HasTransaction;

    protected $table = 'barang_keluar';

    protected $guarded = ['id'];

    public function scopeGudangHasil(Builder $query): void
    {
        $query->whereHas('gudang', function (Builder $q) {
            $q->where('jenis', JenisGudang::GUDANG_HASIL->value);
        });
    }

    public function scopeGudangRetur(Builder $query): void
    {
        $query->whereHas('gudang', function (Builder $q) {
            $q->where('jenis', JenisGudang::GUDANG_RETUR->value);
        });
    }

    public function tanggal(): Attribute
    {
        return Attribute::make(fn () => $this->created_at->format('Y-m-d H:i'));
    }

    public function gudang(): BelongsTo
    {
        return $this->belongsTo(Gudang::class, 'id_gudang');
    }

    public function buku(): BelongsTo
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }
}
