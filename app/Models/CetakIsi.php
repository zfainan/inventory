<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CetakIsi extends Model
{
    use HasFactory;

    protected $table = 'cetak_isi';

    protected $fillable = ['cetak_isi'];

    public function detailMaterial(): HasMany
    {
        return $this->hasMany(DetailMaterial::class, 'id_cetak_isi');
    }
}
