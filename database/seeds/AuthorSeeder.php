<?php
    use Illuminate\Database\Seeder;

    use Faker\Factory as faker;
    use App\Author;
    /**
 * Created by PhpStorm.
 * User: hvc_aps_01
 * Date: 8/3/15
 * Time: 3:10 PM
 */

class AuthorSeeder extends Seeder{

    public function run(){

        $faker = Faker::create();
        foreach(range(1,10) as $index){
            Author::create([
                'name'=>$faker->name


            ]);
        }
    }


} 