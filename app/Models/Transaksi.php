<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'kode_transaksi',
        'tanggal',
        'id_supir',
        'id_relasi',
        'status'
    ];

    public function detail_transaksi()
    {
        return $this->HasMany(DetailTransaksi::class, 'kode_transaksi','kode_transaksi');
    }

    public function relasi()
    {
        return $this->belongsTo(Relasi::class, 'id_relasi');
    }

    public function sopir()
    {
        return $this->belongsTo(Sopir::class, 'id_supir');
    }

    function hasOne_detail_transaksi()
    {
        return $this->hasOne(DetailTransaksi::class, 'kode_transaksi','kode_transaksi');

    }
}
