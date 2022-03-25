<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'photos';
    protected $fillable = [
        'offer_id',
        'img',
        'thumbnail'
    ];

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
}
