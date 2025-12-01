<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Target extends Model
{

    use SoftDeletes;

    protected $fillable = ['Target', 'Berapa_Bulan', 'Target_Uang', 'foto'];

    public function Riwayats() {
        //panggil jenis relasi
        return $this->hasMany(Riwayat::class);
    }

    public function getPerbulanAttribute($value)
    {
        return $value ?? ($this->Berapa_Bulan > 0 ? ceil($this->Target_Uang / $this->Berapa_Bulan) : 0);
    }

}
