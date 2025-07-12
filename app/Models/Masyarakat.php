<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Masyarakat extends Model
{
    protected $fillable = [
        'nik',
        'nama',
        'jenis_kelamin',
        'alamat',
        'pekerjaan',
        'penghasilan',
        'jumlah_tanggungan',
        'status_rumah',
        'kondisi_rumah',
        'no_hp',
    ];
}
