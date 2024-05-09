<?php

namespace App\Models;

use App\Traits\HasTransaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory, HasTransaction;

    protected $table = 'barang_keluar';

    protected $guarded = ['id'];
}
