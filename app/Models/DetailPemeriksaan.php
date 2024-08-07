<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPemeriksaan extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = ['id_medical_check_up', 'id_pemeriksaan_minor'];
    public $incrementing = false; // Jelaskan bahwa primary key ini tidak menginkremen


}
