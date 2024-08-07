<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user();
        $schedules = Schedule::where('doctor_id',$user->doctor->id)->get();
        return view('content.jadwal-dokter.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('content.jadwal-dokter.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
            $user = Auth::user();
            $request->validate([
                'available_time' => 'required|date|after:now',
            ]);


         DB::transaction(function () use ($request, $user){
             Schedule::updateOrCreate(
                [
                'doctor_id' => $user->doctor->id,
                'available_time' => $request->input('available_time')
                ],
                ['is_available' => 1]);
         });

        return back()->with(['success' => 'Jadwal dokter berhasil dibuat!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
