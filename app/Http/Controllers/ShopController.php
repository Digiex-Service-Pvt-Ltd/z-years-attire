<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Attribute;
use DB;

class ShopController extends Controller
{
    public function index($category_slug)
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
        //get all products assigned with this category
        $products = DB::table('product_categories AS PC')
        ->leftjoin('products AS P', 'PC.product_id', '=', 'P.id')
        ->leftjoin('categories AS C', 'PC.category_id', '=', 'C.id')
        ->where(['PC.category_id'=>$data['category']->id, 'P.status'=>1, 'P.deleted_at'=>NULL])
        ->orderBy('P.id', 'DESC')
        ->select('P.*', 'PC.category_id', 'C.category_name')
        ->get();

        dd($products);
        
        return view('maincontents/product/search', $data);
    }

    
    
}
