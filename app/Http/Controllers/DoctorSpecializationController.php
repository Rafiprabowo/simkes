<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\DoctorSpecialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DoctorSpecializationController extends Controller
{
    //
    public function fetchSpecializationsWithDoctor(Request $request){
        $validator = Validator::make($request->all(), [
            'speciality_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()], 422);
        }
        $doctors = Doctor::with('user') // Menggunakan eager loading untuk memuat relasi user
                    ->where('speciality_id', $validator->validated()['speciality_id'])
                    ->get();

        $formattedDoctors = $doctors->map(function ($doctor) {
        return [
            'id' => $doctor->id,
            'first_name' => $doctor->user->first_name,
            'last_name' => $doctor->user->last_name,
        ];
    });

    return response()->json(['success' => true, 'data' => $formattedDoctors], 200);


    }
}
