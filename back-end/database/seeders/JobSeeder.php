<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csv = fopen(base_path('database/seeding_data/jobs.csv'), 'r');

        $first_line = true;

        while (($line = fgetcsv($csv)) !== false) {
            if ($first_line) {
                $first_line = false;
                continue;
            }

            $job = new Job();

            $job->id = $line[0];
            $job->employer_id = $line[1];
            $job->title = $line[2];
            $job->description = $line[3];
            $job->min_salary = $line[4];
            $job->max_salary = $line[5];
            $job->recruit_num = $line[6];
            $job->position = $line[7];
            $job->experience = $line[10];
            $job->deadline = date('Y-m-d', strtotime($line[11]));
            $job->created_at = now();
            $job->updated_at = now();

            $job->save();
        }

        fclose($csv);
    }
}
