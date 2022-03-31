<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('colors')->insert([
            'name' => 'Черный цвет BP',
            'file' => 'storage/images/color/bp.jpg'
        ]);
        DB::table('colors')->insert([
            'name' => 'Тёмно-синяя эмаль BBE',
            'file' => 'storage/images/color/bbe.jpg'
        ]);
        DB::table('colors')->insert([
            'name' => 'Эмаль корричневая майолика BRM',
            'file' => 'storage/images/color/brm.jpg'
        ]);
        DB::table('colors')->insert([
            'name' => 'Эмаль слоновая кость IVE',
            'file' => 'storage/images/color/ive.jpg'
        ]);
        DB::table('colors')->insert([
            'name' => 'Белый лак WHE',
            'file' => 'storage/images/color/whe.jpg'
        ]);
        DB::table('colors')->insert([
            'name' => 'Черный лак BLE',
            'file' => 'storage/images/color/ble.jpg'
        ]);
        DB::table('colors')->insert([
            'name' => 'Белый лак GWH',
            'file' => 'storage/images/color/gwh.jpg'
        ]);
        DB::table('colors')->insert([
            'name' => 'Красный лак GLR',
            'file' => 'storage/images/color/glr.jpg'
        ]);
    }
}
