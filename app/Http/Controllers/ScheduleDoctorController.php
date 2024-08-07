<?php
// app/Http/Controllers/DoctorScheduleController.php
namespace App\Http\Controllers;

use App\Models\ScheduleDoctor;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ScheduleDoctorController extends Controller
{
    public function index(){

    }
    public function create()
    {
        return view('content.dokter.jadwal.create');
    }
    public function store(Request $request){
        $request->validate([
            'day' => 'required|unique:schedule_doctors,day',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        ScheduleDoctor::create([
            'doctor_id' => Auth::user()->doctor->id,
            'day' => $request->day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time
        ]);
        return redirect()->back()->with('success', 'Schedule Doctor created successfully');
    }
    public function createSessions($startTime, $endTime, $interval = 20)
    {
        $sessions = [];
        $start = new DateTime($startTime);
        $end = new DateTime($endTime);

        while ($start < $end) {
            $sessionStart = $start->format('H:i');
            $start->modify("+{$interval} minutes");
            $sessionEnd = $start->format('H:i');

            if ($start > $end) {
                break;
            }

            $sessions[] = ['start' => $sessionStart, 'end' => $sessionEnd];
        }

        return $sessions;
    }

    public function generateWeekdaySchedule($startDate, $endDate)
    {
        $schedules = [];
        $currentDate = Carbon::parse($startDate);

        while ($currentDate->lte(Carbon::parse($endDate))) {
            if ($currentDate->isWeekday()) {
                $schedules[] = [
                    'date' => $currentDate->format('Y-m-d'),
                    'start_time' => '08:00:00',
                    'end_time' => '16:00:00',
                ];
            }
            $currentDate->addDay();
        }

        return $schedules;
    }

    public function showDoctorSchedule()
    {
        $startDate = Carbon::now();
        $endDate = $startDate->copy()->addWeeks(3); // Misalnya untuk dua minggu ke depan

        $doctorSchedules = $this->generateWeekdaySchedule($startDate, $endDate);
        $scheduleWithSessions = [];

        foreach ($doctorSchedules as $schedule) {
            $sessions = $this->createSessions($schedule['start_time'], $schedule['end_time']);
            $scheduleWithSessions[$schedule['date']] = $sessions;
        }

        return view('doctor_schedules', compact('scheduleWithSessions'));
    }
}
