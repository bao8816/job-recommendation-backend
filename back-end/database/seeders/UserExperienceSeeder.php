<?php

namespace Database\Seeders;

use App\Models\UserExperience;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csv = fopen(base_path('database/seeding_data/user_experiences.csv'), 'r');

        $first_line = true;

        while (($line = fgetcsv($csv)) !== false) {
            if ($first_line) {
                $first_line = false;
                continue;
            }

            $user_experience = new UserExperience();

            $user_experience->id = $line[0];
            $user_experience->user_id = $line[1];
            $user_experience->content = $line[5];
            $user_experience->start = date('Y-m-d', strtotime($line[3]));
            $user_experience->end = date('Y-m-d', strtotime($line[4]));
            $user_experience->created_at = now();
            $user_experience->updated_at = now();

            $user_experience->save();
        }

        fclose($csv);
    }
}
