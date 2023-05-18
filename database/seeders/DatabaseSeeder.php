<?php

namespace Database\Seeders;

 use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
            [
                AdminSeeder::class,
                UserAccountSeeder::class,
                UserProfileSeeder::class,
                UserAchievementSeeder::class,
                UserEducationSeeder::class,
                UserExperienceSeeder::class,
                UserSkillSeeder::class,
                CompanyAccountSeeder::class,
                CompanyProfileSeeder::class,
                EmployerAccountSeeder::class,
                EmployerProfileSeeder::class,
                CVSeeder::class,
                JobSeeder::class,
                JobTypeSeeder::class,
                JobLocationSeeder::class,
                JobSkillSeeder::class,
                ApplicationSeeder::class,
                PostSeeder::class,
                PostReportSeeder::class,
//                PostCommentSeeder::class,
                JobReportSeeder::class,
                CompanyReportSeeder::class,
            ]
        );
    }
}
