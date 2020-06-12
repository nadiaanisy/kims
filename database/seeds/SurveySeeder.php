<?php

use Illuminate\Database\Seeder;

class SurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('surveys')->insert([
        	[
	            'surveyname'=> strtoupper('survey 1'),
	            'surveystatus'=> strtoupper('open'),
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
	        ],
	        [
	            'surveyname'=> strtoupper('survey 2'),
	            'surveystatus'=> strtoupper('close'),
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
	        ],
	        [
	            'surveyname'=> strtoupper('survey 3'),
	            'surveystatus'=> strtoupper('close'),
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
	        ],
	        [
	            'surveyname'=> strtoupper('survey 4'),
	            'surveystatus'=> strtoupper('close'),
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
	        ],
	        [
	            'surveyname'=> strtoupper('survey 5'),
	            'surveystatus'=> strtoupper('open'),
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
	        ]
        ]);
    }
}
