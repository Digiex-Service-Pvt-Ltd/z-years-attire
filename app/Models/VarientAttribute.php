<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VarientAttribute extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'varient_attributes';
    protected $primaryKey = 'id';

    protected $fillable = ['product_varient_id',
                    'attribute_value_id'
                ];

    public function product_varients()
    {
        return $this->belongsTo(ProductVarient::class);
    }

    public function attribute_values()
    {
        return $this->hasOne(AttributeValue::class, 'id', 'attribute_value_id');
    }

}
