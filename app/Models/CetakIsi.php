<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CetakIsi extends Model
{
    use HasFactory;

    protected $table = 'cetak_isi';

    protected $fillable = ['cetak_isi'];
}
