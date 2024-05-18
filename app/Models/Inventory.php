<?php

namespace App\Models;

use App\Constants\JenisGudang;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = ['id_gudang', 'id_buku', 'stok'];

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

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'id_inventory');
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
