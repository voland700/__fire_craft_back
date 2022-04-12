<?php

namespace App\Exports;

use App\Models\Offer;
//use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromArray;


class PriceOfferExport implements FromArray, WithMapping, WithHeadings
{
    protected $offers;

    public function __construct(array $offers)
    {
        $this->offers = $offers;
    }

    public function array(): array
    {
        return $this->offers;
    }

    public function headings(): array
    {
        return [
            'id',
            'name',
            'product_id',
            'product_name',
            'active',
            'sort',
            'color_id',
            'color_name',
            'number',
            'base_price',
            'currency'
        ];
    }

    public function map($offers): array
    {
        return [
            $offers['id'],
            $offers['name'],
            $offers['product_id'],
            '['.$offers['product_id'].'] '.$offers['product']['name'],
            $offers['active'],
            $offers['sort'],
            $offers['color_id'],
            '['.$offers['color_id'].'] '.$offers['color_name'],
            $offers['number'],
            $offers['base_price'],
            $offers['currency']
        ];
    }

}
