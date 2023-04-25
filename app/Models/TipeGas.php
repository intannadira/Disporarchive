<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeGas extends Model
{
    use HasFactory;
    protected $table = 'tipe_gase';

    protected $fillable = [
        'nama_tipe',
    ];

    public function gas()
    {
        return $this->hasMany(Gas::class, 'id_tipe_gas');
    }

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
