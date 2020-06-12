<?php

use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gallery')->insert([
        	[
	            'filename'=> 'Scenery',
	            'image'=> '1544545230.JPG',
	            'staffid' => 1314,
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
	        ]
	    ]);
    }
}
