<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
      $faker = Faker::create();
          	
    	foreach (range(1,50) as $index) {

            // DB::table('posts')->insert([
            //       'posts_titulo' => $faker ->sentence($nbWords = 6, $variableNbWords = true),
            //       'posts_texto' => $faker ->realText($maxNbChars = 200, $indexSize = 2),
            //       'created_at' => '2017-09-13 17:28:44',
            //       'updated_at' => '2017-09-13 17:28:44',
            // ]);

            // DB::table('pessoas')->insert([
            //     'pessoas_nome' => $faker ->name($gender = null|'male'|'female'),
            //     'created_at' => '2017-09-13 17:28:44',
            //     'updated_at' => '2017-09-13 17:28:44',
            // ]);

     //        DB::table('comments') -> insert([
     //            'posts_id' => $faker -> numberBetween($min = 1, $max = 10),
     //            'comments_nome' => $faker -> name($gender = null|'male'|'female'),
     //            'comments_texto' => $faker -> realText($maxNbChars = 200, $indexSize = 2),
     //            'created_at' => '2017-09-13 17:28:44',
     //            'updated_at' => '2017-09-13 17:28:44',

     //        ]);
    	// }
        
    }
}
