<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Color extends Model
{
    protected $table = 'colors';
    protected $fillable = [
        'file',
        'name'
    ];
    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
}
