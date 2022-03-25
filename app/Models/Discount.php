<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'discounts';
    protected $fillable = [
        'name',
        'active',
        'sort',
        'type',
        'kind',
        'value',
        'categories'
    ];

    protected $casts = [
        'categories' => 'array'
    ];

    public function product()
    {
        return $this->belongsToMany(Product::class);
    }

    public function offer()
    {
        return $this->belongsToMany(Offer::class);
    }


}
