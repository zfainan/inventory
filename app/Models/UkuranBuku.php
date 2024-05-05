<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UkuranBuku extends Model
{
    use HasFactory;

    protected $table = 'ukuran_buku';

    protected $fillable = ['ukuran_buku'];

    public function detailMaterial(): HasMany
    {
        return $this->hasMany(DetailMaterial::class, 'id_ukuran_buku');
    }
}
