<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ReminderService;

class SendAppointmentReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appointments:send-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder emails to customers 1 hour before their appointments';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking for appointments that need reminders...');
        
        $reminderService = new ReminderService();
        $count = $reminderService->sendAppointmentReminders();
        
        if ($count > 0) {
            $this->info("✅ Successfully sent {$count} reminder email(s).");
        } else {
            $this->info("ℹ️  No appointments found that need reminders at this time.");
        }
        
        return Command::SUCCESS;
    }
}
