<?php

use Illuminate\Database\Seeder;

class ModuleStaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modulexstaff')->insert([
        	[
	            'staffid' => '1314',
	            'modid' => 1,
	            'msgroup' => 1,
	            'msyear' => '2020',
	            'msdate' => '2020-02-01',
	            'msplace' => 1,
				'created_at'=> '2020-01-01 08:30:05',
				'updated_at'=> '2020-01-01 08:40:05',
	        ]
	    ]);
    }
}
