<?php

namespace Database\Seeders;

use App\Models\CompanyProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanyProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csv = fopen(base_path('database/seeding_data/company_profiles.csv'), 'r');

        $firstline = true;

        while (($line = fgetcsv($csv)) !== false) {
            if ($firstline) {
                $firstline = false;
                continue;
            }

            $company_profile = new CompanyProfile();
            $company_profile->id = $line[0];
            $company_profile->name = $line[1];
            $company_profile->description = $line[3];
            $company_profile->site = $line[4];
            $company_profile->address = $line[5];
            $company_profile->created_at = now();
            $company_profile->updated_at = now();
            $company_profile->save();
        }

        fclose($csv);
    }
}
