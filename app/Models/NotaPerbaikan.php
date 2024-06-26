<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NotaPerbaikan extends Model
{
    use HasFactory;

    protected $table = 'nota_perbaikan';

    protected $fillable = ['id_petugas', 'tanggal'];

    public function petugas(): BelongsTo
    {
        return $this->belongsTo(Petugas::class, 'id_petugas');
    }

    public function detail(): HasMany
    {
        return $this->hasMany(DetailNotaPerbaikan::class, 'id_nota_perbaikan');
    }
}
