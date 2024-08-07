<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\DoctorSchedule;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DoctorScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    // Assuming the authenticated user is a doctor and has a 'doctor' relationship
    $doctorId = Auth::user()->doctor->id;

       $schedules = DoctorSchedule::where('doctor_id', $doctorId)
            ->orderBy('date', 'asc')
            ->paginate(5);
        return view('content.doctor-schedules.index', compact('schedules'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $user = Auth::user()->load('doctor');
        return view('content.doctor-schedules.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $request->validate([
        'doctor_id' => 'required|exists:doctors,id',
        'start_time' => 'required|date|after_or_equal:now',
    ]);

    $startTime = Carbon::parse($request->start_time);
    $endTime = $startTime->clone()->addMinutes(20);
    $date = $startTime->toDateString();

    try {
        // Check for schedule conflicts
        $conflict = DoctorSchedule::where(function ($query) use ($startTime, $endTime, $request) {
                $query->where('doctor_id', $request->doctor_id)
                    ->where(function ($query) use ($startTime, $endTime) {
                        $query->where(function ($query) use ($startTime, $endTime) {
                            $query->whereBetween('start_time', [$startTime, $endTime])
                                ->orWhereBetween('end_time', [$startTime, $endTime]);
                        })
                        ->orWhere(function ($query) use ($startTime, $endTime) {
                            $query->where('start_time', '<=', $startTime)
                                ->where('end_time', '>=', $endTime);
                        });
                    });
            })
            ->orWhere(function ($query) use ($startTime, $endTime, $request) {
                $query->where('doctor_id', '!=', $request->doctor_id)
                    ->where(function ($query) use ($startTime, $endTime) {
                        $query->where(function ($query) use ($startTime, $endTime) {
                            $query->whereBetween('start_time', [$startTime, $endTime])
                                ->orWhereBetween('end_time', [$startTime, $endTime]);
                        })
                        ->orWhere(function ($query) use ($startTime, $endTime) {
                            $query->where('start_time', '<=', $startTime)
                                ->where('end_time', '>=', $endTime);
                        });
                    });
            })
            ->exists();

        if ($conflict) {
            return back()->withErrors(['conflict' => 'Schedule conflicts with another doctor’s appointment.']);
        }

        // Save the schedule
        DoctorSchedule::create([
            'doctor_id' => $request->doctor_id,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'date' => $date,
            'status' => 'available',
        ]);

        return redirect()->route('doctor-schedules.index')->with('success', 'Schedule added successfully.');

    } catch (QueryException $e) {
        if ($e->getCode() == 23000) { // SQLSTATE[23000]: Integrity constraint violation
            return back()->withErrors(['conflict' => 'This schedule conflicts with an existing appointment.']);
        }

        // Handle other possible exceptions
        return back()->withErrors(['error' => 'An unexpected error occurred. Please try again later.']);
    }
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
        $schedule = DoctorSchedule::find($id);
        $user = Auth::user()->load('doctor');
        return view('content.doctor-schedules.edit', compact('user' , 'schedule'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, string $id)
{
    $validator = Validator::make($request->all(), [
        'doctor_id' => 'required|exists:doctors,id',
        'status' => 'required',
        'date' => 'required',
        'start_time' => 'required|date_format:H:i',
        'end_time' => 'required|date_format:H:i|after:start_time',
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    $schedule = DoctorSchedule::findOrFail($id);
    $schedule->update($request->all());

    return redirect()->route('doctor-schedules.index')
        ->with('success', 'Schedule updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $schedule = DoctorSchedule::findOrFail($id);
        $schedule->delete();

        return redirect()->route('doctor-schedules.index')
            ->with('success', 'Schedule deleted successfully.');
    }
    public function fetchDoctorSchedule(Request $request)
{
    $validator = Validator::make($request->all(), [
        'doctor_id' => 'required|exists:doctors,id',
    ]);

    if ($validator->fails()) {
        return response()->json(['success' => false, 'message' => $validator->errors()], 422);
    }

    $schedules = DoctorSchedule::where('doctor_id', $validator->validated()['doctor_id'])
        ->where('status', 'available')
        ->orderBy('date', 'asc')
        ->get();

    // Format schedules sesuai dengan kebutuhan
    $formattedSchedules = $schedules->map(function ($schedule) {
        return [
            'id' => $schedule->id,
            'date' => $schedule->date,
            'start_time' => $schedule->start_time,
            'end_time' => $schedule->end_time,
        ];
    });

    return response()->json(['success' => true, 'data' => $formattedSchedules], 200);
}

}
