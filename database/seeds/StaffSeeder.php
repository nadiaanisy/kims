<?php

use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('staff')->insert([
        	[
	            'id' => '1314', //Str::random(10)
	            'name'=> 'Kim Tae Hyung',
	            'email' => 'admin@staff.com', //Str::random(10).'@gmail.com',
	            'password' => Hash::make('123456'),
	            'contact'=> '012-345-6789',
	            'isAdmin'=> 1,
	            'role' => 'Admin',
	            'faculty'=> 'FSKM',
	            'picture'=> '1540038011.jpg',
				'remember_token'=> 'NRzELkFwcYvr4AqcYkVb9nWuKCyGqDYOjRhJcrTW0z3PZ6XYi7JRO0t6V7ui',
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
	        ],
	    	[
	    		'id' => '1001', //Str::random(10)
	            'name'=> 'Mohd Ali Bin Rosli',
	            'email' => 'alirosli@staff.com', //Str::random(10).'@gmail.com',
	            'password' => Hash::make('123456'),
	            'contact'=> '011-3654-4231',
	            'isAdmin'=> 0,
	            'role' => 'Facilitator',
	            'faculty'=> 'FSR',
	            'picture'=> '',
				'remember_token'=> 'wmFH2BzZVwM9iKze9GEBgGKs1qFetwwgl5fgvnbdJv9t3WaHC0cD8rmrBFfe',
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
			],
			[
	    		'id' => '1002', //Str::random(10)
	            'name'=> 'Siti Aisyah Binti Kamal',
	            'email' => 'sitiaisykamal@staff.com', //Str::random(10).'@gmail.com',
	            'password' => Hash::make('123456'),
	            'contact'=> '011-2344-5412',
	            'isAdmin'=> 0,
	            'role' => 'Facilitator',
	            'faculty'=> 'FSKM',
	            'picture'=> '',
				'remember_token'=> NULL,
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
			],
			[
	    		'id' => '1003', //Str::random(10)
	            'name'=> 'Khairol Anwar Bin Khairol Shahri',
	            'email' => 'kaks@staff.com', //Str::random(10).'@gmail.com',
	            'password' => Hash::make('123456'),
	            'contact'=> '012-2344-4312',
	            'isAdmin'=> 0,
	            'role' => 'Facilitator',
	            'faculty'=> 'FSG',
	            'picture'=> '',
				'remember_token'=> NULL,
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
			]
		]);
    }
}