<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $table = 'images';
    protected $fillable = [
        'product_id',
        'img',
        'thumbnail'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
