<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Grammatur extends Model
{
    use HasFactory;

    protected $table = 'grammatur';

    protected $fillable = ['grammatur'];

    public function ukuranKertas(): HasMany
    {
        return $this->hasMany(UkuranKertas::class, 'id_grammatur');
    }
}
