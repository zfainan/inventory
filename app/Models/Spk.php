<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Spk extends Model
{
    use HasFactory;

    protected $table = 'spk';

    protected $guarded = ['id'];

    public function buku(): BelongsTo
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }

    public function detailSpk(): HasMany
    {
        return $this->hasMany(DetailSpk::class, 'id_spk');
    }
}
