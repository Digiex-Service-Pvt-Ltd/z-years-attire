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
    public function __construct()
    {  
        $this->prodMdlObj = new Product;
    }

    public function index()
    {
        $data = array();
        $data['featured_categories'] = Category::where('is_featured', 1)->get();

        $params = array('limit'=>'16');
        $data['products'] = $this->prodMdlObj->get_varient_product_list($params);
        //dd($data["products"]);

        return view('maincontents/home', $data);
    }
    
}
