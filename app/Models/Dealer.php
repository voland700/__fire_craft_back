<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Dealer extends Model
{
    use HasSlug;
    protected $table = 'dealers';
    protected $fillable = [
        'name',
        'slug',
        'sort',
        'active',
        'region_id',
        'mail',
        'address',
        'time',
        'site',
        'phone',
        'description',
        'h1',
        'meta_title',
        'meta_keywords',
        'meta_description'
    ];
    //protected $appends = ['region'];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
    /*
    public function getRegionAttribute()
    {
        return $this->region->name;
    }
    */
}
