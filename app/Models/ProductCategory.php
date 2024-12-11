<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    protected $table = 'product_categories';
    //protected $primaryKey = 'id';

    protected $fillable = ['product_id', 'category_id'];

    public function products()
    {
        return $this->belongsTo(Product::Class);
    }
    
    public function categories(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    
}
