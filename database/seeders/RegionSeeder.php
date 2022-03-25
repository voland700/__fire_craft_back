<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('regions')->insert([ 'item' => 'da',  'name' =>  'Республика Дагестан' ]);
        DB::table('regions')->insert([ 'item' => 'cr',  'name' =>  'Республика Крым' ]);
        DB::table('regions')->insert([ 'item' => 'sa',  'name' =>  'Республика Саха (Якутия)' ]);
        DB::table('regions')->insert([ 'item' => 'so',  'name' =>  'Республика Северная Осетия' ]);
        DB::table('regions')->insert([ 'item' => 'kb',  'name' =>  'Республика Кабардино-Балкария' ]);
        DB::table('regions')->insert([ 'item' => 'kc',  'name' =>  'Карачаево-Черкесия' ]);
        DB::table('regions')->insert([ 'item' => 'st',  'name' =>  'Ставропольский край' ]);
        DB::table('regions')->insert([ 'item' => 'ks',  'name' =>  'Краснодарский край' ]);
        DB::table('regions')->insert([ 'item' => 'ro',  'name' =>  'Ростовская область' ]);
        DB::table('regions')->insert([ 'item' => 'kk',  'name' =>  'Республика Калмыкия' ]);
        DB::table('regions')->insert([ 'item' => 'as',  'name' =>  'Астраханская область' ]);
        DB::table('regions')->insert([ 'item' => 'ad',  'name' =>  'Республика Адыгея' ]);
        DB::table('regions')->insert([ 'item' => 'vl',  'name' =>  'Волгоградская область' ]);
        DB::table('regions')->insert([ 'item' => 'vn',  'name' =>  'Воронежская область' ]);
        DB::table('regions')->insert([ 'item' => 'bl',  'name' =>  'Белгородская область' ]);
        DB::table('regions')->insert([ 'item' => 'ky',  'name' =>  'Курская область' ]);
        DB::table('regions')->insert([ 'item' => 'or',  'name' =>  'Орловская область' ]);
        DB::table('regions')->insert([ 'item' => 'lp',  'name' =>  'Липецкая область' ]);
        DB::table('regions')->insert([ 'item' => 'tl',  'name' =>  'Тульская область' ]);
        DB::table('regions')->insert([ 'item' => 'bn',  'name' =>  'Брянская область' ]);
        DB::table('regions')->insert([ 'item' => 'kj',  'name' =>  'Калужская область' ]);
        DB::table('regions')->insert([ 'item' => 'sm',  'name' =>  'Смоленская область' ]);
        DB::table('regions')->insert([ 'item' => 'mc',  'name' =>  'Москва и Московская область' ]);
        DB::table('regions')->insert([ 'item' => 'rz',  'name' =>  'Рязанская область' ]);
        DB::table('regions')->insert([ 'item' => 'tb',  'name' =>  'Тамбовская область' ]);
        DB::table('regions')->insert([ 'item' => 'kn',  'name' =>  'Калининградская область' ]);
        DB::table('regions')->insert([ 'item' => 'ps',  'name' =>  'Псковская область' ]);
        DB::table('regions')->insert([ 'item' => 'no',  'name' =>  'Новгородская область' ]);
        DB::table('regions')->insert([ 'item' => 'tr',  'name' =>  'Тверская область' ]);
        DB::table('regions')->insert([ 'item' => 'vm',  'name' =>  'Владимирская область' ]);
        DB::table('regions')->insert([ 'item' => 'pz',  'name' =>  'Пензенская область' ]);
        DB::table('regions')->insert([ 'item' => 'sr',  'name' =>  'Саратовская область' ]);
        DB::table('regions')->insert([ 'item' => 'mr',  'name' =>  'Республика Мордовия' ]);
        DB::table('regions')->insert([ 'item' => 'cu',  'name' =>  'Чувашская Республика' ]);
        DB::table('regions')->insert([ 'item' => 'ul',  'name' =>  'Ульяновская область' ]);
        DB::table('regions')->insert([ 'item' => 'ss',  'name' =>  'Самарская область' ]);
        DB::table('regions')->insert([ 'item' => 'ob',  'name' =>  'Оренбургская область' ]);
        DB::table('regions')->insert([ 'item' => 'nn',  'name' =>  'Нижегородская область' ]);
        DB::table('regions')->insert([ 'item' => 'ml',  'name' =>  'Республика Марий Эл' ]);
        DB::table('regions')->insert([ 'item' => 'ta',  'name' =>  'Республика Татарстан' ]);
        DB::table('regions')->insert([ 'item' => 'iv',  'name' =>  'Ивановская область' ]);
        DB::table('regions')->insert([ 'item' => 'yr',  'name' =>  'Ярославская область' ]);
        DB::table('regions')->insert([ 'item' => 'kt',  'name' =>  'Костромская область' ]);
        DB::table('regions')->insert([ 'item' => 'le',  'name' =>  'Санкт-Петербург и Ленинградская область' ]);
        DB::table('regions')->insert([ 'item' => 'ki',  'name' =>  'Кировская область' ]);
        DB::table('regions')->insert([ 'item' => 'bs',  'name' =>  'Республика Башкортостан' ]);
        DB::table('regions')->insert([ 'item' => 'cl',  'name' =>  'Челябинская область' ]);
        DB::table('regions')->insert([ 'item' => 'ud',  'name' =>  'Удмуртская Республика' ]);
        DB::table('regions')->insert([ 'item' => 'pe',  'name' =>  'Пермская область' ]);
        DB::table('regions')->insert([ 'item' => 'sv',  'name' =>  'Свердловская область' ]);
        DB::table('regions')->insert([ 'item' => 'ku',  'name' =>  'Курганская область' ]);
        DB::table('regions')->insert([ 'item' => 'ko',  'name' =>  'Республика Коми' ]);
        DB::table('regions')->insert([ 'item' => 'mu',  'name' =>  'Мурманская область' ]);
        DB::table('regions')->insert([ 'item' => 'kl',  'name' =>  'Республика Карелия' ]);
        DB::table('regions')->insert([ 'item' => 'vo',  'name' =>  'Вологодская область' ]);
        DB::table('regions')->insert([ 'item' => 'ar',  'name' =>  'Архангельская область' ]);
        DB::table('regions')->insert([ 'item' => 'tu',  'name' =>  'Тюменская область' ]);
        DB::table('regions')->insert([ 'item' => 'ne',  'name' =>  'Ненецкий автономный округ' ]);
        DB::table('regions')->insert([ 'item' => 'om',  'name' =>  'Омская область' ]);
        DB::table('regions')->insert([ 'item' => 'ht',  'name' =>  'Ханты-Мансийский автономный округ' ]);
        DB::table('regions')->insert([ 'item' => 'ya',  'name' =>  'Ямало-Ненецкий автономный округ' ]);
        DB::table('regions')->insert([ 'item' => 'kr',  'name' =>  'Красноярский край' ]);
        DB::table('regions')->insert([ 'item' => 'tm',  'name' =>  'Томская область' ]);
        DB::table('regions')->insert([ 'item' => 'nv',  'name' =>  'Новосибирская область' ]);
        DB::table('regions')->insert([ 'item' => 'al',  'name' =>  'Алтайский край' ]);
        DB::table('regions')->insert([ 'item' => 'km',  'name' =>  'Кемеровская область' ]);
        DB::table('regions')->insert([ 'item' => 'lt',  'name' =>  'Республика Алтай' ]);
        DB::table('regions')->insert([ 'item' => 'tv',  'name' =>  'Республика Тыва' ]);
        DB::table('regions')->insert([ 'item' => 'hk',  'name' =>  'Республика Хакасия' ]);
        DB::table('regions')->insert([ 'item' => 'ir',  'name' =>  'Иркутская область' ]);
        DB::table('regions')->insert([ 'item' => 'br',  'name' =>  'Республика Бурятия' ]);
        DB::table('regions')->insert([ 'item' => 'zb',  'name' =>  'Забайкальский край' ]);
        DB::table('regions')->insert([ 'item' => 'am',  'name' =>  'Амурская область' ]);
        DB::table('regions')->insert([ 'item' => 'ch',  'name' =>  'Чукотский автономный округ' ]);
        DB::table('regions')->insert([ 'item' => 'ha',  'name' =>  'Хабаровский край' ]);
        DB::table('regions')->insert([ 'item' => 'eu',  'name' =>  'Еврейская автономная область' ]);
        DB::table('regions')->insert([ 'item' => 'pr',  'name' =>  'Приморский край' ]);
        DB::table('regions')->insert([ 'item' => 'ma',  'name' =>  'Магаданская область' ]);
        DB::table('regions')->insert([ 'item' => 'sh',  'name' =>  'Сахалинская область' ]);
        DB::table('regions')->insert([ 'item' => 'ka',  'name' =>  'Камчатский Край' ]);
        DB::table('regions')->insert([ 'item' => 'in',  'name' =>  'Республика Ингушетия' ]);
    }
}
