<?php

use Illuminate\Database\Seeder;

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
        //eapi    factory of product model
        factory(App\eapi_model\Product::class, 50)->create();
        factory(App\eapi_model\Review::class, 300)->create();
    }
}
