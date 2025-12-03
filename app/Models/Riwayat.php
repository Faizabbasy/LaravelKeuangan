<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Riwayat extends Model
{
    use softDeletes;

    protected $fillable = ['target_id', 'Target','stor', 'Target_Uang', 'Tanggal'];
//     protected $casts = [
//     'Target' => 'array',
// ];

    public function Target() {
        return $this->belongsTo(Target::class, 'target_id');
    }

    public function RiwayatUser() {
        //panggil jenis relasi
        return $this->hasMany(RiwayatUser::class);
    }
}
