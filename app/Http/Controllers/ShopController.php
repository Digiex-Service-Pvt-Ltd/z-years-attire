<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Attribute;
use DB;

class ShopController extends Controller
{

    public function __construct()
    {  
        $this->prodMdlObj = new Product;
    }

    public function index(Request $request, $category_slug)
    {   
        $data = array();
        $data['category'] = Category::where('slug', $category_slug)->first(); //get category details
        $data['child_categories'] = Category::where('parent_id', $data['category']->id)->get(); //get its child's category

        //get filtering attributes
        $search_attributes = $data['category']->filtering_attribute_search;
        $data['attributes'] = array();
        if($search_attributes !=""){
            $attr_arr = json_decode($search_attributes);
            $data['attributes'] = Attribute::with('attribute_values')->whereIn('id', $attr_arr)->get();
        }
        // -------------------------- //

        $category_arr = [$data['category']->id];
        if($request->has('c') ){
            $category = explode(",", $request->get('c'));
            $category_arr = array_merge($category, $category_arr);
        }
        $data['selected_category'] = $category_arr;        

        //If color attribute found in search
        $color_attr_arr = [];
        if($request->has('color'))
        {
            $color_attr_arr = explode(",", $request->get('color'));
        }
        $data['selected_color'] = $color_attr_arr;

        //If size attribute found in search
        $size_attr_arr = [];
        if($request->has('size'))
        {
            $size_attr_arr = explode(",", $request->get('size'));
        }
        $data['selected_size'] = $size_attr_arr;

        //If price range is found in search
        $data['price_search_enable'] = 0; 
        $price_range = [];
        $min_price = 100;
        $max_price = 5000;
        if($request->has('min_price') && $request->has('max_price')){
            $price_range = [$request->get('min_price'), $request->get('max_price')];
            $min_price = $request->get('min_price');
            $max_price = $request->get('max_price');
            $data['price_search_enable'] = 1;
        }
        $data['price_range'] = $price_range;
        $data['min_price'] = $min_price;
        $data['max_price'] = $max_price;
        /********************************************************** */

        /********************************************************** */
        $params = array(
                            'category_ids' =>$category_arr, 
                            'color_ids' =>$color_attr_arr,
                            'size_ids' =>$size_attr_arr,
                            'price_range_arr' => $price_range
                    );
        $products = $this->prodMdlObj->get_products_with_filter($params);
        $data['products'] =  $products['result'];             
        $data['total_record'] =  $products['total_record'];             

        /********************************************************** */

        return view('maincontents/product/shop', $data);
            
    }

    
    
}
