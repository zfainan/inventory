<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UkuranBuku extends Model
{
    use HasFactory;

    protected $table = 'ukuran_buku';

    protected $fillable = ['ukuran_buku'];
}
