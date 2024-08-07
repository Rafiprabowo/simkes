<!-- resources/views/doctor_schedule.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Doctor Schedule</title>
</head>
<body>
    <h1>Doctor Schedule</h1>
    @foreach($scheduleWithSessions as $date => $sessions)
        <h2>{{ $date }}</h2>
        <ul>
            @foreach($sessions as $session)
                <li>{{ $session['start'] }} - {{ $session['end'] }}</li>
            @endforeach
        </ul>
    @endforeach
</body>
</html>
