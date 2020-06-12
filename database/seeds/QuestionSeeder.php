<?php

use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert([
        	[
	            'quests'=> 'How likely is it that you would recommend the event to a friend or colleague?',
	            'typequest'=> strtoupper('event'),
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
	        ],
	        [
	            'quests'=> 'Overall, how would you rate the event?',
	            'typequest'=> strtoupper('event'),
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
	        ],
	        [
	            'quests'=> 'Overall, how would you rate the quality of the facilitator?',
	            'typequest'=> strtoupper('facilitator'),
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
	        ],
	        [
	           	'quests'=> 'Does the facilitator focus on the main topic?',
	            'typequest'=> strtoupper('facilitator'),
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
	        ],
	        [
	            'quests'=> 'Overall, how would you rate the module?',
	            'typequest'=> strtoupper('module'),
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
	        ],
	        [
	            'quests'=> 'Does the module reflex current situation?',
	            'typequest'=> strtoupper('module'),
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
	        ],
	        [
	            'quests'=> 'What topics would you most like to learn about or discuss at this event?',
	            'typequest'=> strtoupper('event'),
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
	        ],
	        [
	            'quests'=> 'What topics would you most like to learn about or discuss at this event?',
	            'typequest'=> strtoupper('facilitator'),
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
	        ],
	        [
	            'quests'=> 'What would you dislike about this module?',
	            'typequest'=> strtoupper('module'),
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
	        ],
	        [
	            'quests'=> 'What would you like to suggest about this event?',
	            'typequest'=> strtoupper('event'),
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
	        ],
	        [
	            'quests'=> 'What would you like to suggest about this module?',
	            'typequest'=> strtoupper('module'),
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
	        ]
        ]);
    }
}
