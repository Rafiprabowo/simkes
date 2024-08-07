@extends('template')
@section('aside')
    @include('partials.aside.dokter')
@endsection
@section('content')
    <h2>Add Doctor Schedule</h2>
 <form class="card" id="createScheduleForm" action="{{ route('doctor-schedules.update', $schedule->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="card-body">
        <input type="hidden" name="doctor_id" value="{{ $user->doctor->id }}">
        <div class="mb-3">
            <label class="form-label">Tanggal</label>
            <div>
                <input type="date" class="form-control" id="date" name="date" value="{{ \Carbon\Carbon::parse($schedule->date)->format('Y-m-d') }}">
                <small class="form-hint">Required date</small>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Status</label>
            <div>
                <select class="form-select" name="status">
                    <option value="available" {{$schedule->status == 'available' ? 'selected' : ''}}>available</option>
                    <option value="reserved" {{$schedule->status == 'reserved' ? 'selected' : ''}}>reserved</option>
                    <option value="cancelled" {{$schedule->status == 'cancelled' ? 'selected' : ''}}>cancelled</option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Waktu Mulai</label>
            <div>
                <input type="time" class="form-control" id="start_time" name="start_time" value="{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}">
                <small class="form-hint">Required start time</small>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Waktu Selesai</label>
            <div>
                <input type="time" class="form-control" id="end_time" name="end_time" value="{{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}">
                <small class="form-hint">Required end time</small>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

@endsection
@section('script')
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const dateInput = document.querySelector('#date');
        const displayDate = dateInput.getAttribute('data-display-date');

        // Display the date in MM-DD-YYYY format in the input box for the user
        if (displayDate) {
            const [day, month, year] = displayDate.split('-');
            dateInput.value = `${year}-${month}-${day}`; // YYYY-MM-DD for the input type="date"
        }
    });
</script>

@endsection
