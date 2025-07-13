<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Masyarakat extends Model
{
    protected $fillable = [
        'nama',
        'pekerjaan',
        'penghasilan',
        'jumlah_tanggungan',
        'status_rumah',
        'pendidikan'
    ];
}
