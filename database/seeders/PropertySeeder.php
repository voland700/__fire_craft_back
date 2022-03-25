<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('properties')->insert([
            'name' => 'Производитель:',
            'sort' => '1'
        ]);
        DB::table('properties')->insert([
            'name' => 'Высота:',
            'sort' => '5'
        ]);
        DB::table('properties')->insert([
            'name' => 'Ширина:',
            'sort' => '10'
        ]);
        DB::table('properties')->insert([
            'name' => 'Длина:',
            'sort' => '15'
        ]);
        DB::table('properties')->insert([
            'name' => 'Глубина:',
            'sort' => '20'
        ]);
        DB::table('properties')->insert([
            'name' => 'Диаметр:',
            'sort' => '25'
        ]);
        DB::table('properties')->insert([
            'name' => 'Толщина:',
            'sort' => '30'
        ]);
        DB::table('properties')->insert([
            'name' => 'Размер:',
            'sort' => '35'
        ]);
        DB::table('properties')->insert([
            'name' => 'Длинна дров:',
            'sort' => '40'
        ]);
        DB::table('properties')->insert([
            'name' => 'Диаметр дымохода:',
            'sort' => '45'
        ]);
        DB::table('properties')->insert([
            'name' => 'Подключение дымохода:',
            'sort' => '50'
        ]);
        DB::table('properties')->insert([
            'name' => 'Материал:',
            'sort' => '55'
        ]);
        DB::table('properties')->insert([
            'name' => 'Варочная плита:',
            'sort' => '60'
        ]);
        DB::table('properties')->insert([
            'name' => 'Теплообменник:',
            'sort' => '65'
        ]);
        DB::table('properties')->insert([
            'name' => 'Топливо:',
            'sort' => '70'
        ]);
        DB::table('properties')->insert([
            'name' => 'Мощность:',
            'sort' => '75'
        ]);
        DB::table('properties')->insert([
            'name' => 'Цвет:',
            'sort' => '80'
        ]);
        DB::table('properties')->insert([
            'name' => 'Объем отапливаемого помещения:',
            'sort' => '85'
        ]);
        DB::table('properties')->insert([
            'name' => 'Облицовка:',
            'sort' => '90'
        ]);
        DB::table('properties')->insert([
            'name' => 'Вес:',
            'sort' => '95'
        ]);
        DB::table('properties')->insert([
            'name' => 'Длительность горения:',
            'sort' => '100'
        ]);
        DB::table('properties')->insert([
            'name' => 'Вторичный дожиг газов:',
            'sort' => '105'
        ]);
        DB::table('properties')->insert([
            'name' => 'Футеровка:',
            'sort' => '110'
        ]);
        DB::table('properties')->insert([
            'name' => 'КПД (%):',
            'sort' => '115'
        ]);
        DB::table('properties')->insert([
            'name' => 'Доступ наружного воздуха:',
            'sort' => '120'
        ]);
        DB::table('properties')->insert([
            'name' => 'Зольник:',
            'sort' => '125'
        ]);

    }
}
