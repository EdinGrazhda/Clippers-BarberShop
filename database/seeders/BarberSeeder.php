<?php

namespace Database\Seeders;

use App\Models\Barber;
use Illuminate\Database\Seeder;

class BarberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barbers = [
            [
                'name' => 'Marcus Thompson',
                'email' => 'marcus@clippers.com',
                'phone' => '(555) 123-4567',
                'description' => 'Master barber with over 15 years of experience specializing in classic cuts and modern fades. Known for attention to detail and creating the perfect look for each client.',
                'experience_years' => 15,
                'specialties' => ['Classic Cuts', 'Skin Fades', 'Beard Sculpting', 'Hot Towel Shaves'],
                'is_active' => true,
            ],
            [
                'name' => 'David Rodriguez',
                'email' => 'david@clippers.com',
                'phone' => '(555) 234-5678',
                'description' => 'Precision stylist who excels at modern trends and creative cuts. Passionate about helping clients express their unique style.',
                'experience_years' => 8,
                'specialties' => ['Modern Styles', 'Creative Cuts', 'Hair Styling', 'Pompadours'],
                'is_active' => true,
            ],
            [
                'name' => 'Anthony Miller',
                'email' => 'anthony@clippers.com',
                'phone' => '(555) 345-6789',
                'description' => 'Traditional barber who brings old-school techniques to modern barbering. Expert in straight razor work and classic gentleman\'s cuts.',
                'experience_years' => 12,
                'specialties' => ['Straight Razor', 'Traditional Cuts', 'Mustache Grooming', 'Classic Styles'],
                'is_active' => true,
            ],
            [
                'name' => 'James Wilson',
                'email' => 'james@clippers.com',
                'phone' => '(555) 456-7890',
                'description' => 'Young and talented barber with a fresh perspective on contemporary styles. Specializes in trendy cuts and beard designs.',
                'experience_years' => 5,
                'specialties' => ['Trendy Cuts', 'Beard Designs', 'Line-ups', 'Texture Work'],
                'is_active' => false,
            ]
        ];

        foreach ($barbers as $barber) {
            Barber::create($barber);
        }
    }
}
