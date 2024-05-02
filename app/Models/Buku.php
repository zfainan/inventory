<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';

    protected $fillable = ['judul', 'id_penerbit', 'isbn', 'expired'];

    public function penerbit(): BelongsTo
    {
        return $this->belongsTo(Penerbit::class, 'id_penerbit', 'id');
    }
}
