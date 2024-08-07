<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorSchedule extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }


}
