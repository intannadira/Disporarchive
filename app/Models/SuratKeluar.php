<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    use HasFactory;

    protected $table = 'surat_keluar';

    protected $fillable = [
        'no_surat',
        'perihal',
        'tanggal_surat',
        'tujuan_surat',
        'tipe_surat',
        'lampiran',
        'deskripsi',
        'status',
    ];
}
