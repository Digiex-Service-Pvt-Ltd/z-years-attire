<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

use App\Models\Product;
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

        //Search with color attribute value id
        $attribute_value_ids = (is_array($params) && array_key_exists('color_ids', $params) && !empty($params['color_ids'])) ? $params['color_ids'] : [];; //[2, 12, 6, 5]

        //Search with categories
        $category_ids = (is_array($params) && array_key_exists('category_ids', $params) && !empty($params['category_ids'])) ? $params['category_ids'] : []; //[1, 3]

        //print_r($params['color_ids']); die();


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

    public function get_products_with_filter($params)
    {
        $limit = (is_array($params) && array_key_exists('limit', $params) && !empty($params['limit'])) ? $params['limit'] : "";

        //Search with color attribute value id
        $color_attribute_value_ids = (is_array($params) && array_key_exists('color_ids', $params) && !empty($params['color_ids'])) ? $params['color_ids'] : [];; //[2, 12, 6, 5]

        //Search with color attribute value id
        $size_attribute_value_ids = (is_array($params) && array_key_exists('size_ids', $params) && !empty($params['size_ids'])) ? $params['size_ids'] : [];; //[2, 12, 6, 5]

        //Search with categories
        $category_ids = (is_array($params) && array_key_exists('category_ids', $params) && !empty($params['category_ids'])) ? $params['category_ids'] : []; //[1, 3]

        //Search with product price
        $product_price = (is_array($params) && array_key_exists('price_range_arr', $params) && !empty($params['price_range_arr'])) ? $params['price_range_arr'] : []; //[1, 3]
        
        if(!empty($size_attribute_value_ids))
        {
            
            $products =  ProductVarient::with(['attributesWithValues', 'productImages.attributeValue', 'products.categories', 'products'])
            ->where('stock_qty', '>', '0')
            ->where('status', '=', '1')
            ->whereHas('products', function($query){
                $query->where('status', 1);
            })
            ->when($color_attribute_value_ids, function($query) use ($color_attribute_value_ids){
                $query->whereHas('attributesWithValues', function ($query) use ($color_attribute_value_ids) {
                    $query->whereIn('attribute_value_id', $color_attribute_value_ids);
                });
            })
            ->when($size_attribute_value_ids, function ($query) use ($size_attribute_value_ids) {
                $query->whereHas('attributesWithValues', function ($query) use ($size_attribute_value_ids) {
                    $query->whereIn('attribute_value_id', $size_attribute_value_ids);
                });
            })
            ->when($product_price, function($query) use ($product_price){
                $query->whereBetween('product_varients.price', $product_price);
            })
            ->when($category_ids, function ($query) use ($category_ids) {
                $query->whereHas('products', function ($query) use ($category_ids) {
                    $query->whereHas('categories', function ($query) use ($category_ids) {
                        $query->whereIn('category_id', $category_ids);
                    });
                });
            })
            ->orderBy('id', 'DESC')
            ->when($limit, function($q) use ($limit){
                $q->take($limit);
            })
            ->get();
            
            
            $total_items = $products->count();
            
        }
        else
        {
                $products = Product::with([
                    'product_varients' => function ($query) use ($color_attribute_value_ids, $product_price){
                        $query->whereHas('attributesWithValues', function ($q) {
                            $q->whereHas('attributes', function ($subQuery) {
                                $subQuery->where('id', '1');
                            });
                        })
                        ->when($color_attribute_value_ids, function($query) use ($color_attribute_value_ids) {

                            $query->whereHas('attributesWithValues', function ($q) use ($color_attribute_value_ids) {
                                $q->whereIn('attribute_value_id', $color_attribute_value_ids);
                            });

                        })
                        ->addSelect(
                                    DB::raw('MIN(product_varients.id) AS id'),  
                                    DB::raw('MIN(product_varients.product_id) AS product_id'), 
                                    DB::raw('MIN(product_varients.variant_name) AS variant_name'), 
                                    DB::raw('MIN(product_varients.sku_code) AS sku_code'),
                                    DB::raw('MIN(product_varients.price) AS price'),
                                    DB::raw('MIN(product_varients.stock_qty) AS stock_qty'),
                                    DB::raw('MIN(product_varients.status) AS status'),
                                    DB::raw('MIN(varient_attributes.product_varient_id) AS product_varient_id'),
                                    DB::raw('MIN(varient_attributes.attribute_value_id) AS attribute_value_id'),
                                    DB::raw('MIN(attribute_values.attribute_id) AS attribute_id'),
                                    DB::raw('COUNT(*) AS total_varients')
                                    
                        )
                        ->addSelect(DB::raw('MIN(attribute_values.id) as color_id')) // Fetch the lowest color ID for grouping
                        ->join('varient_attributes', 'varient_attributes.product_varient_id', '=', 'product_varients.id')

                        ->join('attribute_values', function ($join) {
                            $join->on('varient_attributes.attribute_value_id', '=', 'attribute_values.id')
                                ->where('attribute_values.attribute_id', 1); // Only fetch Color attributes
                        })

                        ->join('attributes', 'attribute_values.attribute_id', '=', 'attributes.id')
                        ->when($product_price, function($query) use ($product_price){
                            $query->whereBetween('product_varients.price', $product_price);
                        })
                        ->groupBy(  
                                    'product_varients.product_id',
                                    'varient_attributes.attribute_value_id'
                        )
                        ->with(['attributesWithValues.attributes', 'productImages.attributeValue']);
                    },
                    'categories',
                    'product_varients.attributesWithValues'
                ])
                ->when($category_ids, function ($query) use ($category_ids) {
                    
                        $query->whereHas('categories', function ($query) use ($category_ids) {
                            $query->whereIn('category_id', $category_ids);
                        });
                
                })
                ->orderBy('id', 'DESC')
                ->when($limit, function($q) use ($limit){
                    $q->take($limit);
                })
                ->get();

                //get total items
                $total_items = 0;
                if(!empty($products))
                {
                    foreach($products as $product){
                        $total_items = $total_items + $product->product_varients->count();
                    }
                }

            }
        
        return array('result'=>$products, 'total_record'=>$total_items);

    }


    public function get_variants()
    {
        $products = DB::table('products as P')
            ->join('product_varients as PV', 'P.id', '=', 'PV.product_id')
            ->join('varient_attributes as VA', 'VA.product_varient_id', '=', 'PV.id')
            ->join('attribute_values as ATTRVAL', function ($join) {
                $join->on('VA.attribute_value_id', '=', 'ATTRVAL.id')
                    ->where('ATTRVAL.attribute_id', 1);
            })
            ->select(
                'P.id as product_id',
                'P.product_name',
                'PV.id as varient_id',
                'PV.sku_code',
                'VA.attribute_value_id',
                'ATTRVAL.value_name'
            )
            ->groupBy('VA.attribute_value_id')
            ->get();
            
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
