<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailNotaPerbaikan extends Model
{
    use HasFactory;

    protected $table = 'detail_nota_perbaikan';

    protected $guarded = ['id'];

    public function detaiRetur(): BelongsTo
    {
        return $this->belongsTo(DetailRetur::class, 'id_detail_retur');
    }

    public function petugas(): BelongsTo
    {
        return $this->belongsTo(Petugas::class, 'id_petugas');
    }
}
