<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailRetur extends Model
{
    use HasFactory;

    protected $table = 'detail_retur';

    protected $guarded = ['id'];

    public function retur(): BelongsTo
    {
        return $this->belongsTo(Retur::class, 'id_retur');
    }

    public function buku(): BelongsTo
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }
}
