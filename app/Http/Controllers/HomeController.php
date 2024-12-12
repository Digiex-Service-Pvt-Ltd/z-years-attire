<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVarient;
use App\Models\VarientAttribute;
use App\Models\AttributeValue;
use DB;

class HomeController extends Controller
{
    public function index()
    {
        $data = array();
        $data['featured_categories'] = Category::where('is_featured', 1)->get();
        // $data["latest_products"] = Product::with('product_varients.varient_attributes.attribute_values.attributes')
        // ->where(['product_type'=>'varient', 'status'=>1])->orderBy('id', 'DESC')->take(12)->get();
        
        $variants = ProductVarient::with(['attributesWithValues', 'images.attributeValue'])->get()->toArray();

        echo "<pre>"; print_r($variants); die();
        //dd($latest_products);
        // foreach($latest_products as $p){
        //     echo "Product_id: ".$p->id."<br>";
        //     foreach($p->product_varients as $pv){
        //         echo "Varient_id: ".$pv->id."<br>";
        //         foreach($pv->varient_attributes as $va){
        //         echo $va->attribute_value_id."<br>";
        //         echo $va->attribute_values->value_name."<br>";
                       
        //         }
        //     }
        //     die();
        // }
        $prodObj = new Product;
        $data["latest_products"] = $prodObj->get_varient_products();
        dd($data["latest_products"]);
        return view('maincontents/home', $data);
    }
    
}
