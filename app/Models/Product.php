<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

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
        'properties'
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
