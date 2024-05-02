<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KertasIsi extends Model
{
    use HasFactory;

    protected $table = 'kertas_isi';

    protected $fillable = ['kertas_isi'];
}
