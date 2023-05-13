<?php

namespace Database\Seeders;

use App\Models\UserProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csv = fopen(base_path('database/seeding_data/user_profiles.csv'), 'r');

        $first_line = true;

        while (($line = fgetcsv($csv)) !== false) {
            if ($first_line) {
                $first_line = false;
                continue;
            }

            $user_profile = new UserProfile();

            $user_profile->id = $line[0];
            $user_profile->full_name = $line[1];
            $user_profile->date_of_birth = $line[3] . '-01-01';
            $user_profile->gender = $line[4];
            $user_profile->address = $line[5];
            $user_profile->email = $line[6];
            $user_profile->phone = $line[7];
            $user_profile->created_at = now();
            $user_profile->updated_at = now();

            $user_profile->save();
        }

        fclose($csv);
    }
}
