<?php

namespace Database\Seeders;

use App\Models\JobType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csv = fopen(base_path('database/seeding_data/job_types.csv'), 'r');

        $first_line = true;

        while (($line = fgetcsv($csv)) !== false) {
            if ($first_line) {
                $first_line = false;
                continue;
            }

            $job_type = new JobType();
            $job_type->id = $line[0];
            $job_type->job_id = $line[1];
            $job_type->type = $line[2];
            $job_type->created_at = now();
            $job_type->updated_at = now();
            $job_type->save();
        }

        fclose($csv);
    }
}
