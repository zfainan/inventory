<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Finishing extends Model
{
    use HasFactory;

    protected $table = 'finishing';

    protected $fillable = ['finishing'];

    public function detailMaterial(): HasMany
    {
        return $this->hasMany(DetailMaterial::class, 'id_cetak_isi');
    }
}
