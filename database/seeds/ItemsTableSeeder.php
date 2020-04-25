<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Item;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    

    public function run()
    {
        $faker = Faker::create();

        $users = User::all()->pluck('id')->toArray();

        foreach (range(1,10) as $index) {
            DB::table('items')->insert([
            'user_found' =>$faker->randomElement($users),
            'color'=>$faker->"red",
            'category'=>$faker->randomElement($array=array
           ('pet','phone','jewellery')),
            'balance'=>$faker->randomFloat(2,0,999999),
            'interest'=>$faker->randomFloat(2,0,0.1)
            ]);
    }
}
}