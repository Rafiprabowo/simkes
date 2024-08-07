<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanMinor extends Model
{
    use HasFactory;
    protected $guarded = [];
     public function medicalCheckUps()
    {
        return $this->belongsToMany(MedicalCheckUp::class, 'detail_pemeriksaans', 'id_pemeriksaan_minor', 'id_medical_check_up')
                    ->withPivot('result')
                    ->withTimestamps();
    }
    public function nilaiRujukan(){
        return $this->hasMany(NilaiRujukan::class, 'id_pemeriksaan_minor', 'id' );
    }
    public function pemeriksaanMajor(){
         return $this->belongsTo(PemeriksaanMajor::class, 'id_pemeriksaan_major', 'id');
    }
}
