<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Retur extends Model
{
    use HasFactory;

    protected $table = 'retur';

    protected $guarded = ['id'];

    public function distributor(): BelongsTo
    {
        return $this->belongsTo(Distributor::class, 'id_distributor');
    }

    public function petugas(): BelongsTo
    {
        return $this->belongsTo(Petugas::class, 'id_petugas');
    }
}
