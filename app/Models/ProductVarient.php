<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVarient extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'product_varients';
    protected $primaryKey = 'id';

    protected $fillable = ['product_id',
                            'variant_name',
                            'sku_code',
                            'price',
                            'stock_qty',
                            'status'
                        ];

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function varient_attributes()
    {
        return $this->hasMany(VarientAttribute::class, 'product_varient_id', 'id');
    }

    public function attributesWithValues()
    {
        return $this->hasManyThrough(
            AttributeValue::class,
            VarientAttribute::class,
            'product_varient_id',    // Foreign key on `variant_attributes` table
            'id',                    // Foreign key on `attribute_values` table
            'id',                    // Local key on `product_variants` table
            'attribute_value_id'     // Local key on `variant_attributes` table
        )->with('attributes');
    }

    public function singleColor()
    {
        return $this->hasOneThrough(
            AttributeValue::class,
            VarientAttribute::class,
            'product_varient_id', // Foreign key on variant_attributes
            'id',                 // Foreign key on attribute_values
            'id',                 // Local key on product_variants
            'attribute_value_id'  // Local key on variant_attributes
        )
        ->whereHas('attributes', function ($query) {
            $query->where('id', 1);
        });
    }

    
    // public function images()
    // {
    //     return $this->hasManyThrough(
    //         ProductImage::class,
    //         Product::class,
    //         'id',        // Foreign key on `products` table
    //         'product_id', // Foreign key on `product_images` table
    //         'product_id', // Local key on `product_variants` table
    //         'id'          // Local key on `products` table
    //     )->with('attributeValue');
    // }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_varient_id');
    }

    protected static function booted()
    {
        static::deleting(function($variant){
            $variant->varient_attributes()->each(function ($attribute) {
                $attribute->delete();
            });
        });

        static::restoring(function($variant){
            $variant->varient_attributes()->withTrashed()->each(function ($attribute) {
                $attribute->restore();
            });
        });
    }

}
