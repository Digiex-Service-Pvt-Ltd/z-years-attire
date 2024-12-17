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
        //print_r($category_arr); die();
        // $params = array('limit'=>'40', 'category_ids'=>$category_arr);
        // $data['products'] = $this->prodMdlObj->get_varient_product_list($params);

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
        /********************************************************** */

        /********************************************************** */
        $params = array(
                            'category_ids' =>$category_arr, 
                            'color_ids' =>$color_attr_arr,
                            'size_ids' =>$size_attr_arr 
                    );
        $data['products'] = $this->prodMdlObj->get_products_with_filter($params);


        /********************************************************** */

        // $params = array('category_ids'=>$category_arr);
        // $data['products'] = $this->prodMdlObj->get_variants($params);

        //echo "<pre>"; print_r($data['products']->toArray()); die();
        //dd($products);
        if(!empty($color_attr_arr || !empty($size_attr_arr)) ){
            return view('maincontents/product/shop', $data);
        }else{
            return view('maincontents/product/shop1', $data);
        }
            
    }

    
    
}
