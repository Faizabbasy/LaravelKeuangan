<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Riwayat extends Model
{
    use softDeletes;

    protected $fillable = ['target_id', 'stor', 'Target_Uang', 'Tanggal'];

    public function target() {
        return $this->belongsTo(Target::class);
    }
}
