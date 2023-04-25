<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksi';

    protected $fillable = [
        'kode_transaksi',
        'id_barcode'
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'kode_transaksi','kode_transaksi');
    }

    public function namagas()
    {
        return $this->HasMany(Gas::class, 'barcode_id', 'id_barcode');
    }
}
