<?php

namespace App\Models;

use App\Constants\JabatanEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'id_petugas',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $with = ['petugas'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function petugas(): BelongsTo
    {
        return $this->belongsTo(Petugas::class, 'id_petugas');
    }

    public function isPetugasGudangHasil(): Attribute
    {
        return Attribute::make(
            fn () => $this->petugas->jabatan === JabatanEnum::PETUGAS_GUDANG_HASIL->value
        );
    }

    public function isPetugasGudangRetur(): Attribute
    {
        return Attribute::make(
            fn () => $this->petugas->jabatan === JabatanEnum::PETUGAS_GUDANG_RETUR->value
        );
    }

    public function isManager(): Attribute
    {
        return Attribute::make(
            fn () => $this->petugas->jabatan === JabatanEnum::MANAGER->value
        );
    }
}
