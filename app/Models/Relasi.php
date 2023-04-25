<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relasi extends Model
{
    use HasFactory;
    protected $table = 'relasi';

    protected $fillable = [
        'nama_relasi',
        'alamat',
    ];

    public function gas()
    {
        return $this->hasMany(Gas::class, 'posisi_gas');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_relasi');
    }

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
