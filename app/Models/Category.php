<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;


class Category extends Model
{
    use NodeTrait, HasSlug;

    protected $table = 'categories';
    protected $fillable = [
        'parent_id',
        '_lft ',
        '_rgt ',
        'name',
        'slug',
        'active',
        'sort',
        'main',
        'img',
        'thumbnail',
        'description',
        'h1',
        'meta_title',
        'meta_keywords',
        'meta_description'
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    //Accessors
    public function getPhotoAttribute()
    {
        return (!$this->img==NULL) ? $this->img : '/images/src/no-photo/no-photo_300.jpg';
    }

    public function getTitleAttribute()
    {
        return (!$this->meta_title==NULL) ? $this->meta_title : $this->name.' от представителя в России - официальный сайт в Москве';
    }
    public function getKeysAttribute()
    {
        return (!$this->meta_keywords==NULL) ? $this->meta_keywords : 'печь, камин, чугунная, дровяная, дровах, чугунная, со стеклом, купить, цена, официальный, сайт, jotul, morso, йотул, морсо';
    }
    public function getDecripAttribute()
    {
        return (!$this->meta_description==NULL) ? $this->meta_description : $this->name.'От офоицального представителя производителя Jotul и Morso в Москве, печи, камины и каминые топки. Официальный сайт представителя';
    }
    public function getNamedAttribute()
    {
        return (!$this->h1==NULL) ? $this->h1 : $this->name;
    }

}
