<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

use App\Models\ProductVarient;

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


    public function product_categories()
    {
        return $this->hasMany(ProductCategory::class, 'product_id', 'id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories', 'product_id', 'category_id');
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

    public function get_varient_product_list($params = array())
    { 
        //dd($params);
        //check conditions for limit
        $limit = (is_array($params) && array_key_exists('limit', $params) && !empty($params['limit'])) ? $params['limit'] : "";
        //Search with attribute value id
        $attribute_value_ids = []; //[2, 12, 6, 5]
        $category_ids = (is_array($params) && array_key_exists('category_ids', $params) && !empty($params['category_ids'])) ? $params['category_ids'] : []; //[1, 3]

        $products =  ProductVarient::with(['attributesWithValues', 'productImages.attributeValue', 'products.categories', 'products'])
            ->where('stock_qty', '>', '0')
            ->where('status', '=', '1')
            ->whereHas('products', function($query){
                $query->where('status', 1);
            })
            ->when($attribute_value_ids, function ($query) use ($attribute_value_ids) {
                $query->whereHas('attributesWithValues', function ($query) use ($attribute_value_ids) {
                    $query->whereIn('attribute_value_id', $attribute_value_ids);
                });
            })
            ->when($category_ids, function ($query) use ($category_ids) {
                $query->whereHas('products', function ($query) use ($category_ids) {
                    $query->whereHas('categories', function ($query) use ($category_ids) {
                        $query->whereIn('category_id', $category_ids);
                    });
                });
            })
            ->when($limit, function($query, $limit){
                return $query->take($limit);
            })           
            ->orderBy('id', 'DESC')
            ->get()->toArray();
            

        return $products;
    }


    // public function get_varient_products($params = array() )
    // {
    //     $productVariants = DB::table('product_varients AS PV')
    //     ->selectRaw("
    //         PV.id,
    //         PV.variant_name, 
    //         PV.product_id, 
    //         PV.stock_qty, 
    //         PV.price, 
    //         GROUP_CONCAT(DISTINCT AV.value_name ORDER BY AV.id ASC) AS value_name, 
    //         GROUP_CONCAT(DISTINCT VA.attribute_value_id ORDER BY AV.id ASC) AS attribute_value_ids 
    //     ")
    //     ->leftJoin('products AS P', 'PV.product_id', '=', 'P.id')
    //     ->leftJoin('varient_attributes AS VA', 'VA.product_varient_id', '=', 'PV.id')
    //     ->leftJoin('attribute_values AS AV', 'VA.attribute_value_id', '=', 'AV.id')
    //     ->leftJoin('attributes AS A', 'AV.attribute_id', '=', 'A.id')
    //     ->groupBy('PV.id', 'PV.variant_name', 'PV.product_id', 'PV.stock_qty', 'PV.price') // Include all PV columns from SELECT
    //     ->get()->toArray();

    //     $result = [];
    //     if(!empty($productVariants))
    //     {
    //         foreach($productVariants as $key => $varient)
    //         {
    //             $result[$key] = (array) $varient;
    //             $attribute_value_id = $varient->attribute_value_ids;
    //             $result[$key]['images'] = DB::select('SELECT attribute_value_id, GROUP_CONCAT(image_name) AS images FROM `product_images` WHERE product_id=1 GROUP BY (attribute_value_id) HAVING attribute_value_id IN ('.$varient->attribute_value_ids.')');
    //         }
    //     }

    //     return $result;
    // }



}
