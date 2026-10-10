<?php

namespace Database\Seeders;

use App\Models\DoctorAvailability;
use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Seeds a realistic weekly availability schedule for Dr. Adwita Joshi (PT).
 *
 * Schedule:
 *  Mon/Wed/Fri  10:00 – 17:00  (clinic + video)
 *  Tue/Thu      09:00 – 13:00  (morning batch)
 *  Saturday     10:00 – 14:00  (half day)
 *  Sunday       OFF
 *
 * Slot duration & buffer come from the doctor's own profile so the
 * booking engine generates the exact right time-slots.
 */
class AdwitaAvailabilitySeeder extends Seeder
{
    public function run(): void
    {
        // 1. Locate the doctor
        $user = User::where('name', 'like', '%Adwita%')
                    ->where('role', 'admin')
                    ->first();

        if (! $user) {
            $this->command->error('Doctor "Adwita" not found. Aborting.');
            return;
        }

        $this->command->info("Found doctor: {$user->name} (user_id={$user->id})");

        // 2. Weekly schedule definition
        $schedule = [
            'monday'    => ['start' => '10:00:00', 'end' => '17:00:00', 'available' => true],
            'tuesday'   => ['start' => '09:00:00', 'end' => '13:00:00', 'available' => true],
            'wednesday' => ['start' => '10:00:00', 'end' => '17:00:00', 'available' => true],
            'thursday'  => ['start' => '09:00:00', 'end' => '13:00:00', 'available' => true],
            'friday'    => ['start' => '10:00:00', 'end' => '17:00:00', 'available' => true],
            'saturday'  => ['start' => '10:00:00', 'end' => '14:00:00', 'available' => true],
            'sunday'    => ['start' => '00:00:00', 'end' => '00:00:00', 'available' => false],
        ];

        // 3. Upsert – safe to re-run without duplicating rows
        foreach ($schedule as $day => $slot) {
            DoctorAvailability::updateOrCreate(
                [
                    'doctor_id'  => $user->id,
                    'day_of_week' => $day,
                ],
                [
                    'start_time'   => $slot['start'],
                    'end_time'     => $slot['end'],
                    'is_available' => $slot['available'],
                ]
            );

            $label = $slot['available']
                ? "{$slot['start']} – {$slot['end']}"
                : 'OFF';

            $this->command->line("  {$day}: {$label}");
        }

        $this->command->newLine();

        // 4. Log profile settings that drive slot generation
        $profile = $user->doctorProfile;
        if ($profile) {
            $this->command->info('Profile slot settings:');
            $this->command->line("  slot_duration      : " . ($profile->slot_duration ?? 30) . " min");
            $this->command->line("  buffer_time        : " . ($profile->buffer_time   ?? 0)  . " min");
            $this->command->line("  max_patients/day   : " . ($profile->max_patients_per_day ?? 10));
            $this->command->line("  same_day_bookings  : " . ($profile->same_day_bookings ? 'yes' : 'no'));
        }

        $this->command->newLine();
        $this->command->info('✅  Availability seeded successfully for Dr. ' . $user->name);
    }
}
