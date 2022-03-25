<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->insert([
            'currency' => 'BYN',
            'CharCode' => 'BYN',
            'Name' => 'Белорусский рубль',
            'Nominal' => 1,
            'value' => 28.7654,
            'updated_at'=>'2020-12-09 16:26:08'
        ]);
        DB::table('currencies')->insert([
            'currency' => 'EUR',
            'CharCode' => 'EUR',
            'Name' => 'Евро',
            'Nominal' => 1,
            'value' => 88.9418,
            'updated_at'=>'2020-12-09 16:26:08'
        ]);
        DB::table('currencies')->insert([
            'currency' => 'UAH',
            'CharCode' => 'UAH',
            'Name' => 'Украинских гривен',
            'Nominal' => 10,
            'value' => 26.1479,
            'updated_at'=>'2020-12-09 16:26:08'
        ]);
        DB::table('currencies')->insert([
            'currency' => 'USD',
            'CharCode' => 'USD',
            'Name' => 'Доллар США',
            'Nominal' => 1,
            'value' => 73.3057,
            'updated_at'=>'2020-12-09 16:26:08'
        ]);
    }
}
