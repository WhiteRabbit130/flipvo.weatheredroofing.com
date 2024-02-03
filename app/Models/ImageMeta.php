<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageMeta extends Model
{
    use HasFactory;

    protected $fillable = [
        'page',
        'primary',
        'alt',
        'title',
        'caption',
        'description',
        'filename',
        'path',
        'url',
        'imageable_id',
        'imageable_type',
    ];

    public function imageable()
    {
        return $this->morphTo();
    }
}
