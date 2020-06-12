<?php

use Illuminate\Database\Seeder;

class SurveyQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('surveyxquest')->insert([
        	[
        		'qid'=> 1,
	            'surveyid'=> 1,
	            'view_status' => 'enable',
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
        	],
        	[
        		'qid'=> 2,
	            'surveyid'=> 1,
	            'view_status' => 'enable',
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
        	],
        	[
        		'qid'=> 3,
	            'surveyid'=> 1,
	            'view_status' => 'enable',
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
        	],
        	[
        		'qid'=> 4,
	            'surveyid'=> 1,
	            'view_status' => 'enable',
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
        	],
        	[
        		'qid'=>5,
	            'surveyid'=> 1,
	            'view_status' => 'enable',
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
        	],
        	[
        		'qid'=> 6,
	            'surveyid'=> 1,
	            'view_status' => 'enable',
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
        	]
        ]);
    }
}
