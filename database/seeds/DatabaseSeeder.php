<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
        	StaffSeeder::class,
        	StudentSeeder::class,
        	TempatSeeder::class,
            SurveySeeder::class,
            ModulesSeeder::class,
            QuestionSeeder::class,
            GallerySeeder::class,
            StudentModuleSeeder::class,
            ModuleStaffSeeder::class,
            SurveyQuestionSeeder::class,
            ResponseSeeder::class,
        ]);
    }
}
