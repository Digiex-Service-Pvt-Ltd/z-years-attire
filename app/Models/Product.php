<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'products';
    protected $primaryKey = 'id';

    protected $fillable = ['product_type', 
                            'parent_id', 
                            'product_name', 
                            'sku_code',
                            'slug',
                            'description',
                            'image', 
                            'price', 
                            'discount_type', 
                            'discount_value', 
                            'discounted_price', 
                            'status' 
                            ];

    // public function product_categories()
    // {
    //     return $this->belongsToMany(ProductCategory::class);
    // }

    public function product_categories()
    {
        return $this->hasMany(ProductCategory::class);
    }

    public function product_varients()
    {
        return $this->hasMany(ProductVarient::class, 'product_id', 'id');
    }

    protected static function booted(){
        static::deleting(function ($product){
            $product->product_varients()->each(function ($variant) {
                $variant->delete();
            });
        });

        static::restoring(function($product){
            $product->product_varients()->withTrashed()->each(function ($variant) {
                $variant->restore();
            });
        });
    }

    public function product_images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

}
