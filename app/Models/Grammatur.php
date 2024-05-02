<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grammatur extends Model
{
    use HasFactory;

    protected $table = 'grammatur';

    protected $fillable = ['grammatur'];
}
