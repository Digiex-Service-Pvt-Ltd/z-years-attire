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
        return $this->belongsTo(Product::class);
    }

    public function varient_attributes()
    {
        return $this->hasMany(VarientAttribute::class, 'product_varient_id', 'id');
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
