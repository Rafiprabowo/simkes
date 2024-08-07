<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Appointment extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $attributes = [
        'status' => 'pending'
    ];


    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function doctor() : BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }
   public function diagnoses()
    {
        return $this->hasMany(Diagnoses::class);
    }


}
