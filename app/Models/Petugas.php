<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Petugas extends Model
{
    use HasFactory;

    protected $table = 'petugas';

    protected $guarded = ['id'];

    protected function user(): HasOne
    {
        return $this->hasOne(User::class, 'id_petugas');
    }
}
