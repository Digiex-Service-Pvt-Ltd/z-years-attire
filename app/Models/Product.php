<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

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
        return $this->hasMany(ProductCategory::class, 'product_id', 'id');
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


    public function get_varient_products($params = array() )
    {
        // $sql = "SELECT PV.*, GROUP_CONCAT(DISTINCT AV.value_name ORDER BY AV.id ASC) AS value_name, GROUP_CONCAT(DISTINCT VA.attribute_value_id ORDER BY AV.id ASC) AS attribute_value_ids, PI.image_name, PI.image_name
        //         FROM `product_varients` AS PV 
        //         LEFT JOIN `products` AS P 
        //             ON PV.product_id = P.id
        //         LEFT JOIN `varient_attributes` AS VA 
        //             ON VA.product_varient_id = PV.id
        //         LEFT JOIN `attribute_values` AS AV 
        //             ON VA.attribute_value_id = AV.id
        //         LEFT JOIN `attributes` AS A 
        //             ON AV.attribute_id = A.id
        //         LEFT JOIN (SELECT product_id, attribute_value_id, image_name FROM `product_images` GROUP BY attribute_value_id ORDER BY rand()) AS PI 
        //         	ON PI.product_id = PV.product_id
        //         GROUP BY VA.product_varient_id
        // ";

        $productVariants = DB::table('product_varients AS PV')
        ->selectRaw("
            PV.id,
            PV.variant_name, 
            PV.product_id, 
            PV.stock_qty, 
            PV.price, 
            GROUP_CONCAT(DISTINCT AV.value_name ORDER BY AV.id ASC) AS value_name, 
            GROUP_CONCAT(DISTINCT VA.attribute_value_id ORDER BY AV.id ASC) AS attribute_value_ids 
        ")
        ->leftJoin('products AS P', 'PV.product_id', '=', 'P.id')
        ->leftJoin('varient_attributes AS VA', 'VA.product_varient_id', '=', 'PV.id')
        ->leftJoin('attribute_values AS AV', 'VA.attribute_value_id', '=', 'AV.id')
        ->leftJoin('attributes AS A', 'AV.attribute_id', '=', 'A.id')
        ->groupBy('PV.id', 'PV.variant_name', 'PV.product_id', 'PV.stock_qty', 'PV.price') // Include all PV columns from SELECT
        ->get()->toArray();

        $result = [];
        if(!empty($productVariants))
        {
            foreach($productVariants as $key => $varient)
            {
                $result[$key] = (array) $varient;
                $attribute_value_id = $varient->attribute_value_ids;
                $result[$key]['images'] = DB::select('SELECT attribute_value_id, GROUP_CONCAT(image_name) AS images FROM `product_images` WHERE product_id=1 GROUP BY (attribute_value_id) HAVING attribute_value_id IN ('.$varient->attribute_value_ids.')');
            }
        }

        return $result;
    }

}
