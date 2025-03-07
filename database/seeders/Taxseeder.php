<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Taxseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('taxes')->insert([
            'tax_value' => 14, //user char 10
            'tax_desc' => 'This is for Tax', //user char 10
            'status' => 1,
        ]);
    }
}
