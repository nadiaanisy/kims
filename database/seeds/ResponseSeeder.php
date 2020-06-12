<?php

use Illuminate\Database\Seeder;

class ResponseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('responses')-> insert([
        	[
        		'ranswer'=> '2',
	            'studentid'=> '2013396375',
	            'modid' => 1,
	            'sqid' => 1,
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
        	],
        	[
        		'ranswer'=> '2',
	            'studentid'=> '2013396375',
	            'modid' => 1,
	            'sqid' => 2,
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
        	],
        	[
        		'ranswer'=> '2',
	            'studentid'=> '2013396375',
	            'modid' => 1,
	            'sqid' => 3,
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
        	],
        	[
        		'ranswer'=> '2',
	            'studentid'=> '2013396375',
	            'modid' => 1,
	            'sqid' => 4,
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
        	],
        	[
        		'ranswer'=> '2',
	            'studentid'=> '2013396375',
	            'modid' => 1,
	            'sqid' => 5,
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
        	],
        	[
        		'ranswer'=> '2',
	            'studentid'=> '2013396375',
	            'modid' => 1,
	            'sqid' => 6,
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
        	],
        	[
        		'ranswer'=> '2',
	            'studentid'=> '2014484206',
	            'modid' => 1,
	            'sqid' => 1,
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
        	],
        	[
        		'ranswer'=> '2',
	            'studentid'=> '2014484206',
	            'modid' => 1,
	            'sqid' => 2,
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
        	],
        	[
        		'ranswer'=> '2',
	            'studentid'=> '2014484206',
	            'modid' => 1,
	            'sqid' => 3,
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
        	],
        	[
        		'ranswer'=> '2',
	            'studentid'=> '2014484206',
	            'modid' => 1,
	            'sqid' => 4,
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
        	],
        	[
        		'ranswer'=> '2',
	            'studentid'=> '2014484206',
	            'modid' => 1,
	            'sqid' => 5,
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
        	],
        	[
        		'ranswer'=> '2',
	            'studentid'=> '2014484206',
	            'modid' => 1,
	            'sqid' => 6,
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
        	]
        ]);
    }
}
