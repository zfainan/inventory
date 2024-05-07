<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = ['id_gudang', 'id_buku', 'stok'];

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'id_inventory');
    }
}
