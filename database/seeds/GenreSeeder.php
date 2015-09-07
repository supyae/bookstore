<?php

use App\Genre;
use Faker\Factory as faker;
use Illuminate\Database\Seeder;

    /**
 * Created by PhpStorm.
 * User: hvc_aps_01
 * Date: 8/3/15
 * Time: 3:44 PM
 */

class GenreSeeder extends Seeder{

    public function run(){

        $faker= Faker::create();

        foreach(range(1,10) as $index){
            Genre::create([
                'type' => $faker->locale
            ]);

        }
    }


} 