<?php

use Illuminate\Database\Seeder;

class PersonsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('persons')->delete();
        
        \DB::table('persons')->insert(array (
            0 => 
            array (
                'id' => 1,
                'prefix' => '',
                'firstname' => 'James',
                'middlename' => '',
                'lastname' => 'Smith',
                'suffix' => '',
                'email' => '',
                'nickname' => '',
                'pronounced' => '',
                'gender' => 'Male',
                'birth_date' => '1935-12-19',
                'street1' => '',
                'street2' => '123 NE Wasco',
                'city' => 'Portland',
                'state' => 'OR',
                'county' => '',
                'zip' => '12345',
                'zip_ext' => '',
                'phone1' => '9876543210',
                'phone1_ext' => '',
                'phone1_type' => 'Home',
                'phone2' => '',
                'phone2_ext' => '',
                'phone2_type' => '',
                'phone3' => '',
                'phone3_ext' => '',
                'phone3_type' => '',
                'image' => '',
                'is_active' => 1,
                'created_userid' => 0,
                'updated_userid' => 0,
                'deleted_userid' => 0,
                'created_at' => '2005-03-22 08:57:51',
                'updated_at' => '2009-02-17 14:54:43',
                'deleted_at' => '0000-00-00 00:00:00',
            ),
            1 => 
            array (
                'id' => 2,
                'prefix' => '',
                'firstname' => 'Mary',
                'middlename' => '',
                'lastname' => 'Williams',
                'suffix' => '',
                'email' => '',
                'nickname' => '',
                'pronounced' => '',
                'gender' => 'Female',
                'birth_date' => '1950-11-14',
                'street1' => '',
                'street2' => '123 S Bradley Rd',
                'city' => 'Oregon City',
                'state' => 'OR',
                'county' => '',
                'zip' => '12345',
                'zip_ext' => '',
                'phone1' => '9876543210',
                'phone1_ext' => '',
                'phone1_type' => 'Home',
                'phone2' => '1234567890',
                'phone2_ext' => '',
                'phone2_type' => 'Work',
                'phone3' => '',
                'phone3_ext' => '',
                'phone3_type' => '',
                'image' => '',
                'is_active' => 1,
                'created_userid' => 0,
                'updated_userid' => 0,
                'deleted_userid' => 0,
                'created_at' => '2005-03-22 08:57:51',
                'updated_at' => '2009-02-17 14:54:43',
                'deleted_at' => '0000-00-00 00:00:00',
            )
        ));
    }
}
