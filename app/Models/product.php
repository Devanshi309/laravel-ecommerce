<?php

namespace App\Models;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory,Softdeletes;

   protected $fillable = [
     'image',
        'name',
        'slug',
        'price',
        'description',
        'category_id',
        
];

  public function categories()
{
    return $this->belongsToMany(
        Category::class,
        'product_category'
    );
}

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}