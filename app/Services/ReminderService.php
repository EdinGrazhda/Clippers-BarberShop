<?php

namespace App\Services;

use App\Models\Appointment;
use App\Enums\Status;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ReminderService
{
    /**
     * Send reminder emails for appointments starting in 1 hour
     */
    public function sendAppointmentReminders(): int
    {
        $count = 0;
        
        // Get appointments that are:
        // 1. Confirmed status
        // 2. Starting in the next hour (between 55-65 minutes from now)
        // 3. Haven't had reminder sent yet
        $oneHourFromNow = Carbon::now()->addHour();
        $reminderWindowStart = $oneHourFromNow->copy()->subMinutes(5); // 55 minutes from now
        $reminderWindowEnd = $oneHourFromNow->copy()->addMinutes(5);   // 65 minutes from now
        
        $appointments = Appointment::with('barber')
            ->where('status', Status::CONFIRMED)
            ->where('reminder_sent', false)
            ->whereBetween('appointment_time', [$reminderWindowStart, $reminderWindowEnd])
            ->get();
            
        Log::info('Checking for appointment reminders', [
            'window_start' => $reminderWindowStart->format('Y-m-d H:i:s'),
            'window_end' => $reminderWindowEnd->format('Y-m-d H:i:s'),
            'found_appointments' => $appointments->count()
        ]);

        foreach ($appointments as $appointment) {
            try {
                $this->sendReminderEmail($appointment);
                
                // Mark reminder as sent
                $appointment->update(['reminder_sent' => true]);
                $count++;
                
                Log::info('Reminder sent successfully', [
                    'appointment_id' => $appointment->id,
                    'customer_email' => $appointment->customer_email,
                    'appointment_time' => $appointment->appointment_time->format('Y-m-d H:i:s')
                ]);
                
            } catch (\Exception $e) {
                Log::error('Failed to send reminder email', [
                    'appointment_id' => $appointment->id,
                    'customer_email' => $appointment->customer_email,
                    'error' => $e->getMessage()
                ]);
            }
        }
        
        Log::info('Appointment reminders completed', ['sent_count' => $count]);
        
        return $count;
    }
    
    /**
     * Send reminder email for a specific appointment
     */
    private function sendReminderEmail(Appointment $appointment): void
    {
        $appointmentTime = $appointment->appointment_time;
        $barberName = $appointment->barber->name;
        $customerName = $appointment->customer_name;
        $service = $appointment->service;
        
        $subject = 'Clippers Barbershop - Appointment Reminder (1 Hour)';
        $message = $this->buildReminderEmailContent($appointment);
        
        Mail::send([], [], function ($mail) use ($appointment, $subject, $message) {
            $mail->to($appointment->customer_email, $appointment->customer_name)
                 ->from('edingrazhda17@gmail.com', 'Clippers Barbershop')
                 ->subject($subject)
                 ->html($message);
        });
    }
    
    /**
     * Build the HTML content for reminder email
     */
    private function buildReminderEmailContent(Appointment $appointment): string
    {
        $appointmentTime = $appointment->appointment_time;
        $barberName = $appointment->barber->name;
        $customerName = $appointment->customer_name;
        $service = $appointment->service;
        $customerPhone = $appointment->customer_phone;
        
        // Format the appointment time nicely
        $dateFormatted = $appointmentTime->format('l, F j, Y'); // e.g., "Monday, August 15, 2025"
        $timeFormatted = $appointmentTime->format('g:i A'); // e.g., "2:30 PM"
        
        return "
        <html>
        <head>
            <style>
                body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f8f9fa; }
                .header { background: linear-gradient(135deg, #f59e0b, #eab308); color: white; padding: 30px 20px; text-align: center; border-radius: 12px 12px 0 0; }
                .content { background: white; padding: 40px 30px; border-radius: 0 0 12px 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
                .reminder-badge { background: #dc2626; color: white; padding: 8px 16px; border-radius: 20px; font-size: 14px; font-weight: bold; display: inline-block; margin-bottom: 20px; }
                .appointment-details { background: #f8fafc; border-left: 4px solid #f59e0b; padding: 20px; margin: 20px 0; border-radius: 0 8px 8px 0; }
                .detail-row { margin: 10px 0; }
                .detail-label { font-weight: bold; color: #374151; display: inline-block; width: 120px; }
                .detail-value { color: #1f2937; }
                .highlight { color: #f59e0b; font-weight: bold; }
                .footer { text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #e5e7eb; color: #6b7280; font-size: 14px; }
                .button { display: inline-block; background: #f59e0b; color: white; padding: 12px 24px; text-decoration: none; border-radius: 6px; font-weight: bold; margin: 20px 0; }
                .contact-info { background: #fef3c7; border: 1px solid #fbbf24; padding: 15px; border-radius: 6px; margin: 20px 0; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h1>✂️ Clippers Barbershop</h1>
                    <p style='margin: 0; font-size: 18px;'>Appointment Reminder</p>
                </div>
                <div class='content'>
                    <div class='reminder-badge'>🔔 REMINDER: 1 Hour Until Your Appointment</div>
                    
                    <h2>Hello {$customerName}!</h2>
                    <p>This is a friendly reminder that you have an appointment with us in approximately <strong class='highlight'>1 hour</strong>.</p>
                    
                    <div class='appointment-details'>
                        <h3 style='margin-top: 0; color: #f59e0b;'>📅 Appointment Details</h3>
                        <div class='detail-row'>
                            <span class='detail-label'>Date:</span>
                            <span class='detail-value'>{$dateFormatted}</span>
                        </div>
                        <div class='detail-row'>
                            <span class='detail-label'>Time:</span>
                            <span class='detail-value highlight'>{$timeFormatted}</span>
                        </div>
                        <div class='detail-row'>
                            <span class='detail-label'>Barber:</span>
                            <span class='detail-value'>{$barberName}</span>
                        </div>
                        <div class='detail-row'>
                            <span class='detail-label'>Service:</span>
                            <span class='detail-value'>{$service}</span>
                        </div>
                    </div>
                    
                    <div class='contact-info'>
                        <h4 style='margin-top: 0; color: #92400e;'>📍 Location & Contact</h4>
                        <p style='margin: 5px 0;'><strong>Address:</strong> 123 Main Street, Your City</p>
                        <p style='margin: 5px 0;'><strong>Phone:</strong> (555) 123-4567</p>
                        <p style='margin: 5px 0;'><strong>Email:</strong> edingrazhda17@gmail.com</p>
                    </div>
                    
                    <h3>⏰ What to Expect:</h3>
                    <ul>
                        <li>Please arrive <strong>5-10 minutes early</strong> for check-in</li>
                        <li>Bring a valid ID if this is your first visit</li>
                        <li>We'll have everything ready for your service</li>
                    </ul>
                    
                    <h3>📱 Need to Reschedule?</h3>
                    <p>If you need to cancel or reschedule, please contact us as soon as possible at <strong>(555) 123-4567</strong> or reply to this email.</p>
                    
                    <p style='margin-top: 30px;'>We're looking forward to seeing you soon!</p>
                    
                    <div class='footer'>
                        <p><strong>Clippers Barbershop</strong></p>
                        <p>Your Style, Our Craft</p>
                        <p>© 2025 Clippers Barbershop. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </body>
        </html>
        ";
    }
}
