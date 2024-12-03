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
                            'stock_qty'
                        ];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    public function varient_attributes()
    {
        return $this->hasMany(VarientAttribute::class, 'product_varient_id', 'id');
    }

}
