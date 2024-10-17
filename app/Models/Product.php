<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia, HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'category_id',
        'star_rating',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image');
    }
}
