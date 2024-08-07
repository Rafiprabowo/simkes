<?php

namespace App\Http\Controllers;

use App\Events\newAppointment;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\DoctorSchedule;
use App\Models\DoctorSpecialization;
use App\Models\Employee;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AppointmentsControllers extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

                  $user = Auth::user()->load('doctor');

                    $appointments = $user->doctor->appointments()->with('employee.user')->paginate(5);

                    return view('content.appointment.dokter.index', compact('user', 'appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
public function createSessions($startTime, $endTime, $date, $interval = 20)
{
    $sessions = [];
    $start = new \DateTime($startTime);
    $end = new \DateTime($endTime);
    $breakStart = new \DateTime('12:00');
    $breakEnd = new \DateTime('14:00');
    $now = new \DateTime(); // Get current date and time

    while ($start < $end) {
        $sessionStart = $start->format('H:i');
        $start->modify("+{$interval} minutes");
        $sessionEnd = $start->format('H:i');

        // Check if the session is during the break time
        $sessionStartDT = new \DateTime($sessionStart);
        $sessionEndDT = new \DateTime($sessionEnd);

        if (($sessionStartDT >= $breakStart && $sessionStartDT < $breakEnd) ||
            ($sessionEndDT > $breakStart && $sessionEndDT <= $breakEnd)) {
            continue;
        }

        // Check if the session time has already passed
        $sessionDateTime = new \DateTime("{$date} {$sessionStart}");
        if ($sessionDateTime < $now) {
            continue;
        }

        if ($start > $end) {
            break;
        }

        // Check if the session times exist in the appointments table
        $appointmentExists = Appointment::where('appointment_date', $date)
            ->where(function ($query) use ($sessionStart, $sessionEnd) {
                $query->where(function ($query) use ($sessionStart) {
                    $query->where('appointment_start_time', '<=', $sessionStart)
                          ->where('appointment_end_time', '>', $sessionStart);
                })->orWhere(function ($query) use ($sessionEnd) {
                    $query->where('appointment_start_time', '<', $sessionEnd)
                          ->where('appointment_end_time', '>=', $sessionEnd);
                });
            })->exists();

        if (!$appointmentExists) {
            $sessions[] = ['start' => $sessionStart, 'end' => $sessionEnd];
        }
    }

    return $sessions;
}



    public function generateTodaySchedule()
    {
        $currentDate = Carbon::now();

//        if ($currentDate->isWeekday()) {
            return [
                'date' => $currentDate->format('Y-m-d'),
                'start_time' => '08:00:00',
                'end_time' => '16:00:00',
            ];

    }

    public function create()
    {
        $user = Auth::user()->load('employee');
        $appointments = Appointment::where('employee_id', $user->employee->id)->get();
        $alergi_obats = $appointments->pluck('alergi_obat')->toArray();
        $alergi_obat_string = implode(',', $alergi_obats);
        $specializations = DoctorSpecialization::all();
        $doctors = Doctor::with('user')->get();

        $schedule = $this->generateTodaySchedule();
        $scheduleWithSessions = [];
        if ($schedule) {
            $sessions = $this->createSessions($schedule['start_time'], $schedule['end_time'], $schedule['date']);
            $scheduleWithSessions[$schedule['date']] = $sessions;
        } else {
            $scheduleWithSessions = ['message' => 'Dokter Libur'];
        }

        return view('content.appointment.pegawai.create_appointment', compact('doctors', 'user', 'specializations', 'alergi_obat_string', 'scheduleWithSessions'));
    }

    /**
     * Store a newly created resource in storage.
     */

 public function store(Request $request)
    {
        $messages = [
            'doctor_id.required' => 'Dokter tidak boleh kosong',
            'schedule_id.required' => 'Tanggal & waktu tidak boleh kosong',
        ];
        // Validasi data yang diterima dari request
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|exists:employees,id',
            'doctor_id' => 'required|exists:doctors,id',
            'schedule_id' => 'required',
            'note' => 'required',
            'alergi_obat' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()], 422);
        }

        $validated = $validator->validated();
        $schedule = $validated['schedule_id'];
        list($date, $start_time, $end_time) = explode('|', $schedule);

        try {
            DB::transaction(function () use ($validated, $date, $start_time, $end_time) {
                // Menyimpan data janji temu ke dalam tabel appointments
                $appointment = Appointment::create([
                    'employee_id' => $validated['employee_id'],
                    'doctor_id' => $validated['doctor_id'],
                    'appointment_date' => $date,
                    'appointment_start_time' => $start_time,
                    'appointment_end_time' => $end_time,
                    'note' => $validated['note'],
                    'alergi_obat' => $validated['alergi_obat'],
                    'status' => 'pending'  // status awal sebelum diubah
                ]);

                // Mengirimkan event jika diperlukan
                event(new newAppointment($appointment));
            });

            return response()->json(['status' => 'success', 'message' => 'Janji temu berhasil dibuat']);
        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()]);
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
