<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'regions';
    protected $fillable = [
        'name',
        'item',
        'description',
        'h1',
        'meta_title',
        'meta_keywords',
        'meta_description'
    ];

    public function dealers()
    {
        return $this->hasMany(Dealer::class);
    }
}
