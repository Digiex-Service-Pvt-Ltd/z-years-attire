<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ProductImage extends Model
{
    use HasFactory;

    protected $table = 'product_images';
    protected $primaryKey = 'id';

    protected $fillable = ['product_id',
                            'attribute_value_id',
                            'image_name',
                            'sort_order'
                        ];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    

}
