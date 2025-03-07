<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'category_name' => 'Mobiles and Tablets ', //user char 10
            'category_desc' => 'This is for Mobiles and Tablets', //user char 10
            'status' => 1,
        ]);
    }
}
