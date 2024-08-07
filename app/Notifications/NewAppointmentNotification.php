<?php

namespace App\Notifications;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\App;

class NewAppointmentNotification extends Notification
{
    use Queueable;
    private $appointment;

    /**
     * Create a new notification instance.
     */
    public function __construct(Appointment $appointment)
    {
        //
        $this->appointment = $appointment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable)
    {
        $employee = $this->appointment->employee;
        $user = $employee ? $employee->user : null;

        return [
            'appointment_id' => $this->appointment->id,
            'employee_name' => $user ? $user->first_name . ' ' . $user->last_name : 'N/A',
            'appointment_date' => $this->appointment->appointment_date,
            'appointment_start_time' => $this->appointment->appointment_start_time,
            'appointment_end_time' => $this->appointment->appointment_end_time,
            'appointment_note' => $this->appointment->note,
        ];
    }
}
