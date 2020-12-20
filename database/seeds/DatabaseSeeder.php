<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB; //responsible for DB

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        
    	DB::table('permalink')->insert(
 		 	[
 		 		'pk_permalink' => '1555', 'description' => 'Rename Reports', 'url' => '/rename-reports',
 		 		'type' => 'B', 'family' => 'Settings', 'indexno' => 6, 'stat' => 1
 		 	]
  		);

        DB::table('permalink')->insert(
            [
                'pk_permalink' => '1708', 'description' => 'Audit Trail History', 'url' => 'reports/show',
                'target' => '_blank', 'type' => 'B', 'family' => 'Reports', 'indexno' => 8, 'stat' => 1
            ]
        );

    }
}
