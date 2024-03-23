<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    use HasFactory;
    protected $fillable=['title', 'slug','description','published','inStock','price','created_by','updated_by','deleted_by'];
    use HasSlug;

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
    function product_images(){
        return $this->hasMany(ProductImage::class);
    }
    function category(){
        return $this->belongsTo(Categories::class);
    }
    function brand(){
        return $this->belongsTo(Brand::class);
    }
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
