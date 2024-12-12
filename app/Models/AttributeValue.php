<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;
    protected $table = 'attribute_values';
    protected $primaryKey = 'id';

    protected $fillable = ['attribute_id',
                            'value_name',
                            'hexa_color_code'
                        ];

    
    public function attributes()
    {
        return $this->belongsTo(Attribute::Class, 'attribute_id');
    }

    public function varient_attributes()
    {
        return $this->hasMany(VarientAttribute::Class, 'attribute_value_id', 'id');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'attribute_value_id');
    }
    
    // public function varient_attributes()
    // {
    //     return $this->hasMany(VarientAttribute::class, 'attribute_value_id', 'id');
    // }
}
