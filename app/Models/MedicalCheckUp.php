<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalCheckUp extends Model
{
    use HasFactory;
    protected $guarded = [];


    // Relasi ke DetailPemeriksaan
    public function pemeriksaanMinors()
    {
        return $this->belongsToMany(PemeriksaanMinor::class, 'detail_pemeriksaans', 'id_medical_check_up', 'id_pemeriksaan_minor')
                    ->withPivot('result')
                    ->withTimestamps();
    }
    public function employee(){
        return $this->belongsTo(Employee::class, 'id_employee');
    }
    public function doctor(){
        return $this->belongsTo(Doctor::class, 'id_doctor');
    }
}
