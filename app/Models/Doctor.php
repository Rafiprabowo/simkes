<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Doctor extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $guarded = [];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function appointments():HasMany{
        return $this->hasMany(Appointment::class);
    }
    public function schedules(): HasMany{
        return $this->hasMany(DoctorSchedule::class);
    }
    public function speciality(): BelongsTo
    {
        return $this->belongsTo(DoctorSpecialization::class);
    }
    public function medicalCheckups(): HasMany{
        return $this->hasMany(MedicalCheckup::class,'id_doctor','id');
    }
      public function diagnoses()
    {
        return $this->hasMany(Diagnoses::class);
    }


}
