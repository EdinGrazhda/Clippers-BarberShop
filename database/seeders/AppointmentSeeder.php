<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Barber;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $barbers = Barber::all();
        
        if ($barbers->isEmpty()) {
            $this->command->warn('No barbers found. Please seed barbers first.');
            return;
        }

        $appointments = [
            [
                'barber_id' => $barbers->random()->id,
                'customer_name' => 'John Smith',
                'customer_phone' => '555-0123',
                'appointment_time' => now()->addDays(1)->setTime(10, 0),
                'status' => 'confirmed',
                'notes' => 'Regular haircut and beard trim'
            ],
            [
                'barber_id' => $barbers->random()->id,
                'customer_name' => 'Mike Johnson',
                'customer_phone' => '555-0456',
                'appointment_time' => now()->addDays(2)->setTime(14, 30),
                'status' => 'pending',
                'notes' => 'First time customer'
            ],
            [
                'barber_id' => $barbers->random()->id,
                'customer_name' => 'David Wilson',
                'customer_phone' => '555-0789',
                'appointment_time' => now()->addDays(3)->setTime(16, 0),
                'status' => 'confirmed',
                'notes' => 'Wedding preparation - special styling'
            ],
            [
                'barber_id' => $barbers->random()->id,
                'customer_name' => 'Robert Brown',
                'customer_phone' => null,
                'appointment_time' => now()->subDays(1)->setTime(9, 0),
                'status' => 'completed',
                'notes' => null
            ],
            [
                'barber_id' => $barbers->random()->id,
                'customer_name' => 'James Davis',
                'customer_phone' => '555-0321',
                'appointment_time' => now()->addDays(5)->setTime(11, 30),
                'status' => 'pending',
                'notes' => 'Consultation for new hairstyle'
            ],
            [
                'barber_id' => $barbers->random()->id,
                'customer_name' => 'William Miller',
                'customer_phone' => '555-0654',
                'appointment_time' => now()->subDays(2)->setTime(15, 0),
                'status' => 'cancelled',
                'notes' => 'Customer cancelled due to emergency'
            ]
        ];

        foreach ($appointments as $appointment) {
            Appointment::create($appointment);
        }
    }
}
