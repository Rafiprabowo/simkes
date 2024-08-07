<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $dates = ['date_of_birth']; // Pastikan date_of_birth dianggap sebagai tanggal

    // Accessor untuk menghitung usia
   public function getAgeAttribute()
    {
        if ($this->date_of_birth) {
            return Carbon::parse($this->date_of_birth)->age;
        }
        return null;
    }

    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    public function medicalCheckups(): HasMany{
        return $this->hasMany(MedicalCheckup::class, 'id_employee','id');
    }
     public function diagnoses()
    {
        return $this->hasMany(Diagnoses::class);
    }



}
