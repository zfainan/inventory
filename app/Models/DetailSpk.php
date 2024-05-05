<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailSpk extends Model
{
    use HasFactory;

    protected $table = 'detail_spk';

    protected $guarded = ['id'];

    public function spk(): BelongsTo
    {
        return $this->belongsTo(Spk::class, 'id_spk');
    }

    public function buku(): BelongsTo
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }
}