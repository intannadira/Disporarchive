<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gas extends Model
{
    use HasFactory;

    protected $table = 'gas';

    protected $fillable = [
        'barcode_id',
        'id_tipe_gas',
        'posisi_gas',
    ];

    public function tipegas()
    {
        return $this->BelongsTo(TipeGas::class, 'id_tipe_gas');
    }

    public function tipenama()
    {
        return $this->HasMany(TipeGas::class, 'id','id_tipe_gas');
    }

    public function relasi()
    {
        return $this->BelongsTo(Relasi::class, 'posisi_gas');
    }
}
