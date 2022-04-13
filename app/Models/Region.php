<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Region extends Model
{
    use HasSlug;

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

    protected $appends = ['quantity'];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('item')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function dealers()
    {
        return $this->hasMany(Dealer::class);
    }

    public function getQuantityAttribute()
    {
        return $this->dealers->count();
    }

}
