<?php

	use Carbon\Carbon;
	use Illuminate\Database\Seeder;

	class UsersTableSeeder extends Seeder
	{
	    /**
	     * Run the database seeds.
	     *
	     * @return void
	     */
	    public function run()
	    {
	        DB::table('users')->delete();


	        $users = array(
	            array(
	                'id' => 1,
	                'username'=>'admin',
	                'email'=>'admin@admin.com',
	                'password'=> Hash::make( 'admin#123' ),
	                'firstname' => 'Admin',
	                'lastname' => '',
	                'is_active'=>1,
	                'created_userid'=>1,
	                "created_at"=>Carbon::now()
				)
	        );


	        DB::table('users')->insert($users);
	    }
	}
