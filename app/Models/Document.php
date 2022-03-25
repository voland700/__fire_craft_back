<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Document extends Model
{
    protected $table = 'documents';
    protected $fillable = [
        'file',
        'name'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    //Accessors
    public function getSizeAttribute()
    {
        $size = Storage::disk('public')->size(str_replace('storage', '', $this->file));
        $a = array('b', 'kb', 'mb', 'gb', 'tb', 'pb');
        $pos = 0;
        while ($size >= 1024) {
            $size /= 1024;
            $pos++;
        }
        return round($size, 2) . ' ' . $a[$pos];
    }
}
