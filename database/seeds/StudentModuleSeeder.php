<?php

use Illuminate\Database\Seeder;

class StudentModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       	DB::table('studentxmodules')->insert([
        	[
	            'studentid'=> '2013396375',
	            'modid'=> 1,
	            'smgroup' => '1',
	            'smsession' => '1',
	            'smyear' => '2020',
	            'time' => '2020-02-01 08:15:00', //masa dia attended
	            'remark' => '-',
	            'status' => 'ATTENDED',
				'created_at'=> '2020-01-01 08:00:00',
				'updated_at'=> '2020-02-01 08:15:00', //ikut masa dia attended
	        ],
	        [
	            'studentid'=> '2013396375',
	            'modid'=> 1,
	            'smgroup' => '1',
	            'smsession' => '2',
	            'smyear' => '2020',
	            'time' => '2020-02-01 14:15:00', //masa dia attended
	            'remark' => '-',
	            'status' => 'ATTENDED',
				'created_at'=> '2020-01-01 08:00:00',
				'updated_at'=> '2020-02-01 14:15:00', //ikut masa dia attended
	        ],
	        [
	            'studentid'=> '2014484206',
	            'modid'=> 1,
	            'smgroup' => '1',
	            'smsession' => '1',
	            'smyear' => '2020',
	            'time' => '2020-02-01 08:16:00', //masa dia attended
	            'remark' => '-',
	            'status' => 'ATTENDED',
				'created_at'=> '2020-01-01 08:00:00',
				'updated_at'=> '2020-02-01 08:16:00', //ikut masa dia attended
	        ],
	        [
	            'studentid'=> '2014484206',
	            'modid'=> 1,
	            'smgroup' => '1',
	            'smsession' => '2',
	            'smyear' => '2020',
	            'time' => '2020-02-01 14:16:00', //masa dia attended
	            'remark' => '-',
	            'status' => 'ATTENDED',
				'created_at'=> '2020-01-01 08:00:00',
				'updated_at'=> '2020-02-01 14:16:00', //ikut masa dia attended
	        ]
	    ]);
    }
}
