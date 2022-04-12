<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Offer extends Model
{
    protected $table = 'offers';
    protected $fillable = [
        'name',
        'product_id',
        'color_id',
        'active',
        'hit',
        'new',
        'stock',
        'advice',
        'sort',
        'number',
        'img',
        'preview',
        'thumbnail',
        'base_price',
        'price',
        'currency'
    ];
    protected $appends = ['color_name'];

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

    public function getSmallAttribute()
    {
        return (!$this->preview==NULL) ? $this->preview : '/images/src/no-photo/no-photo_small.jpg';
    }


    public function getProductNameAttribute()
    {
        return $this->product->name;
    }

    public function getColorNameAttribute()
    {
        return $this->color->name;
    }






    //Observer
    protected static function boot() {
        parent::boot();
        static::deleting(function($offer) {
            if(!$offer->photos->isEmpty()){
                foreach ($offer->photos as $image){
                    if (Storage::disk('public')->exists(str_replace('storage', '', $image->img))){
                        Storage::disk('public')->delete(str_replace('storage', '', $image->img));
                    }
                    if (Storage::disk('public')->exists(str_replace('storage', '', $image->thumbnail))){
                        Storage::disk('public')->delete(str_replace('storage', '', $image->thumbnail));
                    }
                }
            }
            if ($offer->img && Storage::disk('public')->exists(str_replace('storage', '', $offer->img))){
                Storage::disk('public')->delete(str_replace('storage', '', $offer->img));
            }
            if ($offer->thumbnail && Storage::disk('public')->exists(str_replace('storage', '', $offer->thumbnail))){
                Storage::disk('public')->delete(str_replace('storage', '', $offer->thumbnail));
            }
            if ($offer->preview && Storage::disk('public')->exists(str_replace('storage', '', $offer->preview))){
                Storage::disk('public')->delete(str_replace('storage', '', $offer->preview));
            }
        });
    }






}
