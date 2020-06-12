<?php

use Illuminate\Database\Seeder;

class TempatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tempat')->insert(
        	[
	        	[
		            'nama_tempat'=> strtoupper('bilik tutorial 1'),
					'created_at'=> date("Y-m-d H:i:s"),
					'updated_at'=> NULL,
		        ],
		    	[
		            'nama_tempat'=> strtoupper('bilik tutorial 2'),
					'created_at'=> date("Y-m-d H:i:s"),
					'updated_at'=> NULL,
				],
				[
		            'nama_tempat'=> strtoupper('bilik tutorial 3'),
					'created_at'=> date("Y-m-d H:i:s"),
					'updated_at'=> NULL,
		        ],
		    	[
		            'nama_tempat'=> strtoupper('bilik tutorial 4'),
					'created_at'=> date("Y-m-d H:i:s"),
					'updated_at'=> NULL,
				],
				[
		            'nama_tempat'=> strtoupper('bilik tutorial 5'),
					'created_at'=> date("Y-m-d H:i:s"),
					'updated_at'=> NULL,
		        ],
		    	[
		    		'nama_tempat'=> strtoupper('bilik tutorial 6'),
					'created_at'=> date("Y-m-d H:i:s"),
					'updated_at'=> NULL,
				],
				[
		            'nama_tempat'=> strtoupper('bilik tutorial 7'),
					'created_at'=> date("Y-m-d H:i:s"),
					'updated_at'=> NULL,
		        ],
		    	[
		    		'nama_tempat'=> strtoupper('bilik tutorial 8'),
					'created_at'=> date("Y-m-d H:i:s"),
					'updated_at'=> NULL,
				],
				[
		            'nama_tempat'=> strtoupper('bilik kuliah 1'),
					'created_at'=> date("Y-m-d H:i:s"),
					'updated_at'=> NULL,
		        ],
		    	[
		    		'nama_tempat'=> strtoupper('bilik kuliah 2'),
					'created_at'=> date("Y-m-d H:i:s"),
					'updated_at'=> NULL,
				],
				[
		            'nama_tempat'=> strtoupper('bilik kuliah 3'),
					'created_at'=> date("Y-m-d H:i:s"),
					'updated_at'=> NULL,
		        ],
		    	[
		    		'nama_tempat'=> strtoupper('bilik kuliah 4'),
					'created_at'=> date("Y-m-d H:i:s"),
					'updated_at'=> NULL,
				],
				[
		            'nama_tempat'=> strtoupper('bilik kuliah 5'),
					'created_at'=> date("Y-m-d H:i:s"),
					'updated_at'=> NULL,
		        ],
		    	[
		    		'nama_tempat'=> strtoupper('bilik kuliah 6'),
					'created_at'=> date("Y-m-d H:i:s"),
					'updated_at'=> NULL,
				],
				[
		            'nama_tempat'=> strtoupper('bilik kuliah 7'),
					'created_at'=> date("Y-m-d H:i:s"),
					'updated_at'=> NULL,
		        ],
		    	[
		    		'nama_tempat'=> strtoupper('bilik kuliah 8'),
					'created_at'=> date("Y-m-d H:i:s"),
					'updated_at'=> NULL,
				],
				[
		            'nama_tempat'=> strtoupper('bilik kuliah 9'),
					'created_at'=> date("Y-m-d H:i:s"),
					'updated_at'=> NULL,
		        ],
		    	[
		    		'nama_tempat'=> strtoupper('bilik kuliah 10'),
					'created_at'=> date("Y-m-d H:i:s"),
					'updated_at'=> NULL,
				],
				[
		            'nama_tempat'=> strtoupper('bilik kuliah 11'),
					'created_at'=> date("Y-m-d H:i:s"),
					'updated_at'=> NULL,
		        ],
		    	[
		    		'nama_tempat'=> strtoupper('bilik kuliah 12'),
					'created_at'=> date("Y-m-d H:i:s"),
					'updated_at'=> NULL,
				],
				[
		            'nama_tempat'=> strtoupper('bilik kuliah 13'),
					'created_at'=> date("Y-m-d H:i:s"),
					'updated_at'=> NULL,
		        ],
		    	[
		    		'nama_tempat'=> strtoupper('bilik kuliah 14'),
					'created_at'=> date("Y-m-d H:i:s"),
					'updated_at'=> NULL,
				],
				[
		            'nama_tempat'=> strtoupper('bilik kuliah 15'),
					'created_at'=> date("Y-m-d H:i:s"),
					'updated_at'=> NULL,
				],
		    	[
		    		'nama_tempat'=> strtoupper('bilik kuliah 16'),
					'created_at'=> date("Y-m-d H:i:s"),
					'updated_at'=> NULL,
				],
				[
		    		'nama_tempat'=> strtoupper('bilik kuliah 17'),
					'created_at'=> date("Y-m-d H:i:s"),
					'updated_at'=> NULL,
				]
			]
		);
    }
}
