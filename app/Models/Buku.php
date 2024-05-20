<?php

namespace App\Models;

use App\Constants\JenisGudang;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';

    protected $fillable = ['judul', 'id_penerbit', 'isbn', 'expired'];

    public function scopeGudangHasil(Builder $query): void
    {
        $query->whereHas('inventories', function (Builder $qInventory) {
            $qInventory->whereHas('gudang', function (Builder $qGudang) {
                $qGudang->where('jenis', JenisGudang::GUDANG_HASIL->value);
            });
        });
    }

    public function penerbit(): BelongsTo
    {
        return $this->belongsTo(Penerbit::class, 'id_penerbit', 'id');
    }

    public function hasilCetak(): HasMany
    {
        return $this->HasMany(DetailSpk::class, 'id_buku', 'id');
    }

    public function inventories(): HasMany
    {
        return $this->HasMany(Inventory::class, 'id_buku', 'id');
    }

    public function detailMaterial(): HasOne
    {
        return $this->hasOne(DetailMaterial::class, 'id_buku');
    }
}
