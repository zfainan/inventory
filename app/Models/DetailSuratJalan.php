<?php

namespace App\Models;

use App\Traits\HasTransaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailSuratJalan extends Model
{
    use HasFactory, HasTransaction;

    protected $table = 'detail_surat_jalan';

    protected $guarded = ['id'];

    public function suratJalan(): BelongsTo
    {
        return $this->belongsTo(SuratJalan::class, 'id_surat_jalan');
    }

    public function buku(): BelongsTo
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }

    public function distributor(): BelongsTo
    {
        return $this->belongsTo(Distributor::class, 'id_distributor');
    }
}
