<?php

use Illuminate\Database\Seeder;

class ModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->insert([
        	[
	            'modname'=> strtoupper('1. ice breaking'),
	            'modstatus'=> strtoupper('open'),
	            'moddesc' => 'Desc ki1',
	            'modtime' => '08:00-17:00',
	            'surveyid' => 1,
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
	        ],
	        [
	            'modname'=> strtoupper('2. critical thinking'),
	            'modstatus'=> strtoupper('close'),
	            'moddesc' => 'Desc ki2',
	            'modtime' => '08:00-17:00',
	            'surveyid' => 2,
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
	        ],
	        [
	           	'modname'=> strtoupper('3. teamwork'),
	            'modstatus'=> strtoupper('close'),
	            'moddesc' => 'Desc ki3',
	            'modtime' => '08:00-17:00',
	            'surveyid' => NULL,
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
	        ],
	        [
	            'modname'=> strtoupper('4. entrepreneurship'),
	            'modstatus'=> strtoupper('open'),
	            'moddesc' => 'Desc ki4',
	            'modtime' => '08:00-17:00',
	            'surveyid' => NULL,
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
	        ],
	        [
	            'modname'=> strtoupper('5. finishing school'),
	            'modstatus'=> strtoupper('close'),
	            'moddesc' => 'Desc ki5',
	            'modtime' => '08:00-17:00',
	            'surveyid' => NULL,
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
	        ]
        ]);
    }
}
