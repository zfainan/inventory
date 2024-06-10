<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Distributor extends Model
{
    use HasFactory;

    protected $table = 'distributor';

    protected $fillable = ['nama'];

    public function detailSuratJalan(): HasMany
    {
        return $this->hasMany(DetailSuratJalan::class, 'id_distributor');
    }
}
