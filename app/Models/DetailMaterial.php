<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailMaterial extends Model
{
    use HasFactory;

    protected $table = 'detail_material';

    protected $guarded = ['id'];

    public function buku(): BelongsTo
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }

    public function ukuranKertas(): BelongsTo
    {
        return $this->belongsTo(UkuranKertas::class, 'id_ukuran_kertas');
    }

    public function cetakIsi(): BelongsTo
    {
        return $this->belongsTo(CetakIsi::class, 'id_cetak_isi');
    }

    public function finishing(): BelongsTo
    {
        return $this->belongsTo(Finishing::class, 'id_finishing');
    }

    public function ukuranBuku(): BelongsTo
    {
        return $this->belongsTo(UkuranBuku::class, 'id_ukuran_buku');
    }
}
