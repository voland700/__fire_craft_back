<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasSlug;

    protected $table = 'products';
    protected $fillable = [
        'name',
        'slug',
        'active',
        'art_number',
        'hit',
        'new',
        'stock',
        'advice',
        'sort',
        'category_id',
        'h1',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'summary',
        'description',
        'img',
        'preview',
        'thumbnail',
        'currency',
        'base_price',
        'price',
        'properties',
        'accessory'
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }
    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function discount()
    {
        return $this->belongsToMany(Discount::class);
    }

    public function documents()
    {
        return $this->belongsToMany(Document::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function currency()
    {
        return $this->hasOne('App\Models\Currency', 'currency', 'currency');
    }

    //Observer
    protected static function boot() {
        parent::boot();
        static::deleting(function($product) {
            if(!$product->images->isEmpty()){
                foreach ($product->images as $image){
                    if (Storage::disk('public')->exists(str_replace('storage', '', $image->img))){
                        Storage::disk('public')->delete(str_replace('storage', '', $image->img));
                    }
                    if (Storage::disk('public')->exists(str_replace('storage', '', $image->thumbnail))){
                        Storage::disk('public')->delete(str_replace('storage', '', $image->thumbnail));
                    }
                }
            }
            if ($product->img && Storage::disk('public')->exists(str_replace('storage', '', $product->img))){
                Storage::disk('public')->delete(str_replace('storage', '', $product->img));
            }
            if ($product->thumbnail && Storage::disk('public')->exists(str_replace('storage', '', $product->thumbnail))){
                Storage::disk('public')->delete(str_replace('storage', '', $product->thumbnail));
            }
            if ($product->preview && Storage::disk('public')->exists(str_replace('storage', '', $product->preview))){
                Storage::disk('public')->delete(str_replace('storage', '', $product->preview));
            }
        });
    }

    //Accessors

    public function getKindAttribute()
    {
        return (!$this->offers()) ? 'Товар' : 'Предложания';
    }


    public function getMiniatureAttribute()
    {
        return (!$this->thumbnail==NULL) ? $this->thumbnail : '/images/src/no-photo/no-photo_thamb.jpg';
    }

    public function getPictureAttribute()
    {
        return (!$this->img==NULL) ? $this->img : '/images/src/no-photo/no-photo.jpg';
    }

    public function getSmallAttribute()
    {
        return (!$this->preview==NULL) ? $this->preview : '/images/src/no-photo/no-photo_small.jpg';
    }
    public function getThumbAttribute()
    {
        return (!$this->thumbnail==NULL) ? $this->thumbnail : '/images/src/no-photo/no-photo_thamb.jpg';
    }

    public function getTitleAttribute()
    {
        return (!$this->meta_title==NULL) ? $this->meta_title : $this->name.' купить, цена '.$this->price.' - в магазине Фаир-Крафт, официальный сайт Jotul и Morso в Москве';
    }
    public function getKeysAttribute()
    {
        return (!$this->meta_keywords==NULL) ? $this->meta_keywords : 'печь, камин, чугунная, дровяная, дровах, чугунная, со стеклом, купить, цена, официальный, сайт, jotul, morso, йотул, морсо';
    }
    public function getDescripAttribute()
    {
        return (!$this->meta_description==NULL) ? $this->meta_description : $this->name.' Продажа отопительного оборудования Везувий: отопительные и банные печи, грили и мангалы. официальный сайт представителя Везувий в Москве';
    }
    public function getNamedAttribute()
    {
        return (!$this->h1==NULL) ? $this->h1 : $this->name;
    }




}
