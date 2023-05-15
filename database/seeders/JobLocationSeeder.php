<?php

namespace Database\Seeders;

use App\Models\JobLocation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csv = fopen(base_path('database/seeding_data/job_locations.csv'), 'r');

        $first_line = true;

        while (($line = fgetcsv($csv)) !== false) {
            if ($first_line) {
                $first_line = false;
                continue;
            }

            $job_location = new JobLocation();

            $job_location->id = $line[0];
            $job_location->job_id = $line[1];
            $job_location->location = $line[2];
            $job_location->created_at = now();
            $job_location->updated_at = now();

            $job_location->save();
        }

        fclose($csv);
    }
}
