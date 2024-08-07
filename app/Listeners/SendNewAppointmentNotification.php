<?php

namespace App\Listeners;

use App\Events\NewAppointment;
use App\Notifications\NewAppointmentNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNewAppointmentNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewAppointment $event): void
    {
        $appointment = $event->appointment;
        $doctorUser = $appointment->doctor->user;
        $doctorUser->notify(new NewAppointmentNotification($appointment));
    }
}
