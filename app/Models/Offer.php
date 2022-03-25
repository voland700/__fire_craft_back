<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table = 'offers';
    protected $fillable = [
        'name',
        'product_id',
        'active',
        'sort',
        'diameter',
        'steel',
        'number',
        'img',
        'preview',
        'thumbnail',
        'base_price',
        'price',
        'currency'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function discount()
    {
        return $this->belongsToMany(Discount::class);
    }

    public function currency()
    {
        return $this->hasOne('App\Models\Currency', 'currency', 'currency');
    }

    //Accessors
    public function getMiniatureAttribute()
    {
        return (!$this->thumbnail==NULL) ? $this->thumbnail : '/images/src/no-photo/no-photo_thamb.jpg';
    }

    public function getPhotoAttribute()
    {
        return (!$this->img==NULL) ? $this->img : '/images/src/no-photo/no-photo.jpg';
    }

    public function getPreviewAttribute()
    {
        return (!$this->preview==NULL) ? $this->img : '/images/src/no-photo/no-photo.jpg';
    }











}
