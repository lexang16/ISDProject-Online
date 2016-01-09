<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // Create Elivs entry
         $this->call(UserTableSeeder::class);
		 
		 //Create needed sensor types
		 $this->call(GenericSensorTableSeeder::class);
		 
		 //Create 50 entries for testing with help function and ModelFactory 
		 factory(App\User::class, 50)->create()->each(function($u) {
        $u->posts()->save(factory(App\Post::class)->make());
        });
    
        Model::reguard();
    }
}
