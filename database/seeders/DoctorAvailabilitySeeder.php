<?php

namespace Database\Seeders;

use App\Models\DoctorAvailability;
use App\Models\DoctorProfile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DoctorAvailabilitySeeder extends Seeder
{
    public function run(): void
    {
        $doctors = [
            [
                'name'  => 'Dr. Priya Sharma',
                'email' => 'priya.sharma@pelvicare.test',
                'profile' => [
                    'slug'                => 'dr-priya-sharma',
                    'years_of_experience' => 8,
                    'specializations'     => ['Pelvic Floor Therapy', 'Postpartum Recovery'],
                    'clinic_name'         => 'Pelvicare Delhi Centre',
                    'clinic_address'      => 'B-12, South Extension Part II, New Delhi - 110049',
                    'city'                => 'Delhi NCR',
                    'rating'              => 4.8,
                    'bio'                 => 'Dr. Priya Sharma is a certified pelvic floor physiotherapist with over 8 years of clinical experience specializing in women\'s health conditions, postpartum recovery, and chronic pelvic pain.',
                    'clinic_visit_fee'    => 800,
                    'video_session_fee'   => 600,
                    'home_visit_fee'      => 1200,
                    'slot_duration'       => 30,
                    'buffer_time'         => 10,
                    'verification_status' => 'approved',
                    'profile_completed'   => true,
                    'is_featured'         => true,
                ],
                'availability' => [
                    'monday'    => ['09:00:00', '17:00:00'],
                    'tuesday'   => ['09:00:00', '17:00:00'],
                    'wednesday' => ['09:00:00', '17:00:00'],
                    'thursday'  => ['09:00:00', '17:00:00'],
                    'friday'    => ['09:00:00', '14:00:00'],
                ],
            ],
            [
                'name'  => 'Dr. Anika Gupta',
                'email' => 'anika.gupta@pelvicare.test',
                'profile' => [
                    'slug'                => 'dr-anika-gupta',
                    'years_of_experience' => 5,
                    'specializations'     => ['Urinary Incontinence', 'Pelvic Pain', 'Pregnancy Care'],
                    'clinic_name'         => 'Pelvicare Mumbai Clinic',
                    'clinic_address'      => '204, Linking Road, Bandra West, Mumbai - 400050',
                    'city'                => 'Mumbai',
                    'rating'              => 4.6,
                    'bio'                 => 'Dr. Anika Gupta brings a compassionate, evidence-based approach to women\'s health physiotherapy. She specialises in urinary incontinence and pregnancy-related pelvic conditions.',
                    'clinic_visit_fee'    => 700,
                    'video_session_fee'   => 550,
                    'home_visit_fee'      => null,
                    'slot_duration'       => 45,
                    'buffer_time'         => 15,
                    'verification_status' => 'approved',
                    'profile_completed'   => true,
                    'is_featured'         => true,
                ],
                'availability' => [
                    'monday'    => ['10:00:00', '18:00:00'],
                    'wednesday' => ['10:00:00', '18:00:00'],
                    'friday'    => ['10:00:00', '18:00:00'],
                    'saturday'  => ['09:00:00', '13:00:00'],
                ],
            ],
            [
                'name'  => 'Dr. Meera Joshi',
                'email' => 'meera.joshi@pelvicare.test',
                'profile' => [
                    'slug'                => 'dr-meera-joshi',
                    'years_of_experience' => 12,
                    'specializations'     => ['Pelvic Organ Prolapse', 'Sexual Health', 'Postpartum Recovery'],
                    'clinic_name'         => 'Pelvicare Bangalore Centre',
                    'clinic_address'      => '47/2, Residency Road, Richmond Town, Bangalore - 560025',
                    'city'                => 'Bangalore',
                    'rating'              => 4.9,
                    'bio'                 => 'With 12 years of dedicated experience in women\'s pelvic health, Dr. Meera Joshi is one of Bangalore\'s leading physiotherapists for conditions like prolapse, sexual pain, and postpartum concerns.',
                    'clinic_visit_fee'    => 900,
                    'video_session_fee'   => 650,
                    'home_visit_fee'      => 1500,
                    'slot_duration'       => 30,
                    'buffer_time'         => 5,
                    'verification_status' => 'approved',
                    'profile_completed'   => true,
                    'is_featured'         => true,
                ],
                'availability' => [
                    'tuesday'   => ['09:00:00', '17:00:00'],
                    'thursday'  => ['09:00:00', '17:00:00'],
                    'saturday'  => ['10:00:00', '16:00:00'],
                ],
            ],
        ];

        foreach ($doctors as $data) {
            // Skip if already exists
            if (User::where('email', $data['email'])->exists()) {
                $this->command->info("Skipping existing user: {$data['email']}");
                continue;
            }

            $user = User::create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => Hash::make('password'),
                'role'     => 'admin',
                'phone'    => '9' . rand(100000000, 999999999),
            ]);

            // Ensure slug is unique
            $slug = $data['profile']['slug'];
            if (DoctorProfile::where('slug', $slug)->exists()) {
                $slug .= '-' . rand(100, 999);
            }
            $data['profile']['slug'] = $slug;

            DoctorProfile::create(array_merge($data['profile'], [
                'user_id' => $user->id,
            ]));

            foreach ($data['availability'] as $day => $times) {
                DoctorAvailability::create([
                    'doctor_id'   => $user->id,
                    'day_of_week' => $day,
                    'start_time'  => $times[0],
                    'end_time'    => $times[1],
                    'is_available'=> true,
                ]);
            }

            $this->command->info("Created doctor: {$data['name']}");
        }

        $this->command->info('✅ DoctorAvailabilitySeeder completed.');
    }
}
