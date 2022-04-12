<?php

namespace App\Exports;

use App\Models\Product;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class PriceProductExport implements FromArray, WithMapping, WithHeadings
{
    protected $products;

    public function __construct(array $products)
    {
        $this->products = $products;
    }

    public function array(): array
    {
        return $this->products;
    }

    public function headings(): array
    {
        return [
            'id',
            'Активность',
            'Категория',
            'Наименование',
            'Артикул',
            'Цена',
            'Валюта',
            'Тип'
        ];
    }

    public function map($products): array
    {
        return [
            $products['id'],
            $products['active'],
            '['.$products['category_id'].'] '.$products['category']['name'],
            $products['name'],
            $products['art_number'],
            $products['base_price'],
            $products['currency'],
            $products['kind']
        ];
    }
}
