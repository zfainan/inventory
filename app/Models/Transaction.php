<?php

namespace App\Models;

use App\Constants\JenisGudang;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Transaction extends Model
{
    use HasFactory;

    protected $with = ['transactionable'];

    protected $fillable = ['qty'];

    protected static function booted(): void
    {
        static::created(function (self $transaction) {
            $transaction->inventory->update([
                'stok' => $transaction->inventory->stok + $transaction->qty,
            ]);
        });

        static::updating(function (self $transaction) {
            if ($transaction->isDirty('qty')) {
                $currentInventoryStock = $transaction->inventory->stok;
                $beforeTransactionStock = $currentInventoryStock - ($transaction->getOriginal('qty'));

                $transaction->inventory->update([
                    'stok' => $beforeTransactionStock + $transaction->qty,
                ]);
            }
        });
    }

    public function description(): Attribute
    {
        $desc = '-';

        if ($this->transactionable instanceof DetailSpk) {
            $desc = 'Penambahan stok dari hasil cetak';
        }

        if ($this->transactionable instanceof DetailSuratJalan) {
            $desc = 'Pengurangan stok dari surat jalan';
        }

        if ($this->transactionable instanceof DetailRetur) {
            $desc = 'Penambahan stok dari retur';
        }

        if ($this->transactionable instanceof DetailNotaPerbaikan) {
            if ($this->inventory->gudang->jenis == JenisGudang::GUDANG_RETUR->value) {
                $desc = 'Pengurangan stok dari nota perbaikan';
            } else {
                $desc = 'Penambahan stok dari nota perbaikan';
            }
        }

        if ($this->transactionable instanceof BarangKeluar) {
            $desc = 'Pengurangan stok: ' . $this->transactionable->deskripsi;
        }

        return Attribute::make(get: fn () => $desc);
    }

    public function transactionable(): MorphTo
    {
        return $this->morphTo();
    }

    public function inventory(): BelongsTo
    {
        return $this->belongsTo(Inventory::class, 'id_inventory');
    }
}
