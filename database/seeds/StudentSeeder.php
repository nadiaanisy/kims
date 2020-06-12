<?php

use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert([
        	[
	            'id' => '2013387745', //Str::random(10)
	            'name'=> strtoupper('hayqal bin hazeem'),
	            'email' => 'hayqalhazeem@student.com', //Str::random(10).'@gmail.com',
	            'password' => Hash::make('123456'),
	            'prog' => strtoupper('computer science'),
	            'cprog' => strtoupper('CS110'),
	            'part' => '1',
	            'contact'=> '0151120123',
	            'picture'=> '',
				'remember_token'=> NULL,
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
	        ],
	    	[
	    		'id' => '2014484206', //Str::random(10)
	            'name'=> strtoupper('mohs shahril bin saifullah'),
	            'email' => 'sahril96@student.com', //Str::random(10).'@gmail.com',
	            'password' => Hash::make('123456'),
	            'prog' => strtoupper('applied sciences'),
	            'cprog' => strtoupper('ap123'),
	            'part' => '1',
	            'contact'=> '01123455643',
	            'picture'=> '',
				'remember_token'=> NULL,
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
			],
			[
	    		'id' => '2013396375', //Str::random(10)
	            'name'=> strtoupper('nur farhana binti borhan'),
	            'email' => 'fb@student.com', //Str::random(10).'@gmail.com',
	            'password' => Hash::make('123456'),
	            'prog' => strtoupper('sport science studies'),
	            'cprog' => strtoupper('sr113'),
	            'part' => '1',
	            'contact'=> '0134779714',
	            'picture'=> '',
				'remember_token'=> NULL,
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
			],
			[
				'id' => '2016716981', //Str::random(10)
	            'name'=> strtoupper('jarron aaron yong'),
	            'email' => 'jay@student.com', //Str::random(10).'@gmail.com',
	            'password' => Hash::make('123456'),
	            'prog' => strtoupper('mathematical science'),
	            'cprog' => strtoupper('cs101'),
	            'part' => '1',
	            'contact'=> '0145887414',
	            'picture'=> '',
				'remember_token'=> NULL,
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
			],
			[
	    		'id' => '2015332212', //Str::random(10)
	            'name'=> strtoupper('aamir abdul qayyum bin aamir affef'),
	            'email' => 'aaq@student.com', //Str::random(10).'@gmail.com',
	            'password' => Hash::make('123456'),
	            'prog' => strtoupper('geomatical science'),
	            'cprog' => strtoupper('ap220'),
	            'part' => '1',
	            'contact'=> '01123455431',
	            'picture'=> '',
				'remember_token'=> NULL,
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
			],
			[
	    		'id' => '2016326585', //Str::random(10)
	            'name'=> strtoupper('nur ain binti anuar'),
	            'email' => 'ainanuar@student.com', //Str::random(10).'@gmail.com',
	            'password' => Hash::make('123456'),
	            'prog' => strtoupper('netcentric computing'),
	            'cprog' => strtoupper('cs251'),
	            'part' => '1',
	            'contact'=> '012-929-0269',
	            'picture'=> '',
				'remember_token'=> NULL,
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
			],
			[
	    		'id' => '2016342561', //Str::random(10)
	            'name'=> strtoupper('mohamad luqman-nul hakim bin zamri'),
	            'email' => 'luqhak24@student.com', //Str::random(10).'@gmail.com',
	            'password' => Hash::make('123456'),
	            'prog' => strtoupper('database'),
	            'cprog' => strtoupper('bitd'),
	            'part' => '1',
	            'contact'=> '0182344434
',
	            'picture'=> '',
				'remember_token'=> NULL,
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
			],
			[
	    		'id' => '2016698871', //Str::random(10)
	            'name'=> strtoupper('mohd aqil bin mohd jamal'),
	            'email' => 'aqil@student.com', //Str::random(10).'@gmail.com',
	            'password' => Hash::make('123456'),
	            'prog' => strtoupper('netcentric computing'),
	            'cprog' => strtoupper('c251'),
	            'part' => '1',
	            'contact'=> '0122544484',
	            'picture'=> '',
				'remember_token'=> NULL,
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
			],
			[
	    		'id' => '2016765565', //Str::random(10)
	            'name'=> strtoupper('kamalia binti azhar'),
	            'email' => 'kamaliaazhar_@student.com', //Str::random(10).'@gmail.com',
	            'password' => Hash::make('123456'),
	            'prog' => strtoupper('netcentric computing'),
	            'cprog' => strtoupper('cs251'),
	            'part' => '1',
	            'contact'=> '01123455512',
	            'picture'=> '',
				'remember_token'=> NULL,
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
			],
			[
	    		'id' => '2016774885', //Str::random(10)
	            'name'=> strtoupper('raja saqeef bin ahmad tailib'),
	            'email' => 'rs@student.com', //Str::random(10).'@gmail.com',
	            'password' => Hash::make('123456'),
	            'prog' => strtoupper('sains fizik'),
	            'cprog' => strtoupper('as203'),
	            'part' => '1',
	            'contact'=> '0122233456',
	            'picture'=> '',
				'remember_token'=> NULL,
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
			],
			[
	    		'id' => '2016987654', //Str::random(10)
	            'name'=> strtoupper('maisarah binti azahar'),
	            'email' => 'mai21@student.com', //Str::random(10).'@gmail.com',
	            'password' => Hash::make('123456'),
	            'prog' => strtoupper('sport science studies'),
	            'cprog' => strtoupper('sr113'),
	            'part' => '1',
	            'contact'=> '0119987765',
	            'picture'=> '',
				'remember_token'=> NULL,
				'created_at'=> date("Y-m-d H:i:s"),
				'updated_at'=> NULL,
			]
		]);
    }
}
